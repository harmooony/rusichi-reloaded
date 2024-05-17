<?php 
session_start();
require_once ("connect.php");

$admin_id = $_SESSION['user']['id'];

$team_id;
$name = $_GET['name'];
$krit = $_GET['krit'];
$kol = $_GET['kol'];

if ($name == 'Рыси') {
    $team_id = 1;
} else if ($name == 'Барсы') {
    $team_id = 2;
} else if ($name == 'Медведи') {
    $team_id = 3;
} else if ($name == 'Ястребы') {
    $team_id = 4;
}

$sql = "UPDATE груп_рейтинг SET {$krit} = {$krit} + {$kol} WHERE id_группы = $team_id;";
$result = mysqli_query($mysqli, $sql);

$admin_lvl;
if (isset($_SESSION['user']['type'])) {
    if ($_SESSION['user']['type'] == "admin1") {
        $admin_lvl = 1;
    } else if ($_SESSION['user']['type'] == "admin2") {
        $admin_lvl = 2;
    }
}

$query = mysqli_query($mysqli, "INSERT INTO логи(admin, admin_lvl, action, type_reciever, reciever, krit, reason) VALUES ({$admin_id}, {$admin_lvl}, 'Выдача', 'Группа', {$team_id}, '{$krit}(+{$kol})', 'Выдача баллов за прохождение модуля')");

header("Location: ../admin_profile_first.php");

?>