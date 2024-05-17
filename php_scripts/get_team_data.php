<?php
require_once ("connect.php");

$id = $_POST['id'];

$query = mysqli_query($mysqli, "SELECT * FROM груп_рейтинг WHERE id = {$id}");
$row = mysqli_fetch_assoc($query);
$id_group = $row['id_группы'];

$query = mysqli_query($mysqli, "SELECT * FROM группы WHERE id = {$id}");
$row = mysqli_fetch_assoc($query);
$team_name = $row['Название'];

$logo;

if ($team_name == 'Рыси') {
    $logo = './images/team_risi.png';
} else if ($team_name == 'Барсы') {
    $logo = './images/team_barci.png';
} else if ($team_name == 'Медведи') {
    $logo = './images/team_bears.png';
} else if ($team_name == 'Ястребы') {
    $logo = './images/team_yastrebi.png';
}

$itog = [$team_name, $logo];

echo json_encode($itog);

?>