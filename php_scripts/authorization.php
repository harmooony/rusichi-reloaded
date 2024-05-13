<?php

session_start();
require_once ("connect.php");

$login = $_POST['login'];
$password = $_POST['password'];
$hash_password = md5($password);

if (empty(trim($login)) || empty(trim($password))) {
    $_SESSION['message'] = 'Все поля должны быть заполнены!';
    header("Location: ../login.php");
    exit;
}

$result = mysqli_query($mysqli, "SELECT * FROM курсанты WHERE login='$login' AND password='$hash_password'");


if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['id'];
    $isFill = $row['isFill'];

    $_SESSION['user'] = [
        "id" => $id,
        "type" => "kursant"
    ];

    if ($isFill == 0) {
        header("Location: ../fill.php");
    } else if ($isFill == 1) {
        header("Location: ../profile.php");
    }
} else {
    $sql = "SELECT * FROM админы WHERE login='$login' AND password='$hash_password'";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $id = $row['id'];
        if ($row['lvl'] == 1) {
            $_SESSION['user'] = [
                "id" => $id,
                "type" => "admin1"
            ];
            header("Location: ../admin_profile_first.php");
        } else {
            $_SESSION['user'] = [
                "id" => $id,
                "type" => "admin2"
            ];
            header("Location: ../admin_profile_second.php");
        }
        print_r($_SESSION);
    }
}
?>