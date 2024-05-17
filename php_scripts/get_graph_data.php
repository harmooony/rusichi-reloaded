<?php
require_once ("connect.php");

$id = $_POST['id'];

$query = mysqli_query($mysqli, "SELECT * FROM груп_рейтинг WHERE id_группы = {$id}");
$row = mysqli_fetch_assoc($query);
$data[0] = $row['Разведчики'];
$data[1] = $row['Спасатели'];
$data[2] = $row['Защитники'];
$data[3] = $row['Богатыри'];
$data[4] = $row['Мероприятия'];
$data[5] = $row['Чистота'];
$data[6] = $row['Поведение'];


echo json_encode($data);
?>
