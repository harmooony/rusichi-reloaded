<?php
session_start();
require_once ("connect.php");

$admin_id = $_SESSION['user']['id'];

$name = $_GET['name'];
$krit = $_GET['krit'];
$kol = $_GET['kol'];

$query = mysqli_query($mysqli, "SELECT * FROM курсанты WHERE login = '{$name}'");
$row = mysqli_fetch_assoc($query);
$id = $row['id'];

$sql = "UPDATE инд_рейтинг SET {$krit} = {$krit} + {$kol} WHERE id_курсанта = $id";
$result = mysqli_query($mysqli, $sql);

$query = mysqli_query($mysqli, "SELECT * FROM инд_рейтинг WHERE id_курсанта = $id");
$row = mysqli_fetch_assoc($query);

array_shift($row);
$id = array_pop($row);
$sum = array_sum($row);

$query = mysqli_query($mysqli, "UPDATE курсанты SET инд_рейтинг = {$sum} WHERE login = '{$name}'");

$admin_lvl;
if (isset($_SESSION['user']['type'])) {
    if ($_SESSION['user']['type'] == "admin1") {
        $admin_lvl = 1;
    } else if ($_SESSION['user']['type'] == "admin2") {
        $admin_lvl = 2;
    }
}

$query = mysqli_query($mysqli, "INSERT INTO логи(admin, admin_lvl, action, type_reciever, reciever, krit, reason) VALUES ({$admin_id}, {$admin_lvl}, 'Выдача', 'Курсант', {$id}, '{$krit}(+{$kol})', 'Выдача баллов за прохождение модуля')");
header("Location: ../admin_profile_first.php");

?>