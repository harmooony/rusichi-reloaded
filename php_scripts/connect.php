<?php

$mysqli = mysqli_connect('localhost', 'root', 'root', 'rusichi');
if ($mysqli->connect_errno) {
    echo "Проблема с подключением!";
    exit;
}

?>