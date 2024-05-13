<?php

session_start();
require_once ("connect.php");

$login = $_POST['login'];
$password = $_POST['password'];
$hash_password = md5($password);

if (empty(trim($login)) || empty(trim($password))) {
    $_SESSION['message'] = 'Все поля должны быть заполнены!';
    header("Location: ../admin_profile_first.php");
    exit;
}

$query = mysqli_query($mysqli, "SELECT * FROM курсанты WHERE login='{$login}'");

if (mysqli_num_rows($query) == 0) {
    mysqli_query($mysqli, "INSERT INTO курсанты (login, password) VALUES ('{$login}', '{$hash_password}')");
    $result = mysqli_query($mysqli, "SELECT id FROM курсанты WHERE login='{$login}' AND password = '{$hash_password}'");
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    mysqli_query($mysqli, "INSERT INTO инд_рейтинг (id_курсанта) VALUES ('{$id}')");
    header("Location: ../admin_profile_first.php");

} else {
    $_SESSION['message'] = 'Такой аккаунт уже существует!';
    header("Location: ../admin_profile_first.php");
}
?>