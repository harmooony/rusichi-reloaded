<?php
require_once ("connect.php");

$login = $_POST['login'];
$team_id;
$team = $_POST['team'];

if ($team == 'Рыси') {
    $team_id = 1;
} else if ($team == 'Барсы') {
    $team_id = 2;
} else if ($team == 'Медведи') {
    $team_id = 3;
} else if ($team == 'Ястребы') {
    $team_id = 4;
}

$query = mysqli_query($mysqli, "SELECT * FROM курсанты WHERE login='{$login}'");

if (mysqli_num_rows($query) > 0) {
    mysqli_query($mysqli, "UPDATE курсанты SET id_группы = {$team_id} WHERE login = '{$login}'");
    header("Location: ../admin_profile_first.php");
} else {
    echo ("Ошибка: Данный логин не найден");
}
?>