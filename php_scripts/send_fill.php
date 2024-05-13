<?php
session_start();
require_once ("connect.php");

$login = $_POST['login'];

$name = $_POST['name'];
$surname = $_POST['surname'];
$achiev = $_POST['achiev'];
$uvlech = $_POST['uvlech'];
$age = $_POST['age'];

$result = mysqli_query($mysqli, "SELECT * FROM курсанты WHERE login = '{$login}'");
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

$sql = "UPDATE курсанты SET Имя = '{$name}', Фамилия = '{$surname}', Достижения = '{$achiev}', Увлечения = '{$uvlech}', Возраст = '{$age}', isFill = 1 WHERE id = {$id}";
mysqli_query($mysqli, $sql);

header("Location: ../admin_profile_first.php");
?>