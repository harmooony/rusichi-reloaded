<?php
require_once ("connect.php");

$id = $_POST['id'];

if ($id == 4) {
    $id = 1;
} else if ($id == 1) {
    $id = 4;
}
/*
if ($team_name == 'Рыси') {
    $logo = './images/team_risi.png';
} else if ($team_name == 'Барсы') {
    $logo = './images/team_barci.png';
} else if ($team_name == 'Медведи') {
    $logo = './images/team_bears.png';
} else if ($team_name == 'Ястребы') {
    $logo = './images/team_yastrebi.png';
}*/

$query = mysqli_query($mysqli, "SELECT Имя, Фамилия, Инд_рейтинг FROM курсанты WHERE id_группы = {$id} ORDER BY Инд_рейтинг DESC");
$rows = array();

while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
}

echo json_encode($rows);
?>