<?php
session_start();
require_once ("php_scripts/connect.php");

if (isset($_SESSION['user']['type'])) {
    if ($_SESSION['user']['type'] == "admin2") {
        header("Location: admin_profile_second.php");
    } else if ($_SESSION['user']['type'] == "kursant") {
        header("Location: profile.php");
    }
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    <title>Русичи - Главная страница</title>
</head>

<body>

    <div class="page_body">
        <img src="images/rfGerb 2.png" class="first_l" />
        <img src="images/rfGerb 1.png" class="second_l" />
        <img src="images/rfGerb 3.png" class="first_r" />
        <img src="images/rfGerb 4.png" class="second_r" />
    </div>
    <header>
        <div class="container">
            <div class="header_wrapper">
                <div class="header_logo">
                    <img class="main_logo" width="10%" src="images/logo_1-01.svg"
                        onclick="window.location.href = 'index.php'">
                    <div class="dropdown">
                        <button onclick="dropdown()" class="dropbtn">Команды</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="index_info.php?team=3">Медведи</a>
                            <a href="index_info.php?team=1">Рыси</a>
                            <a href="index_info.php?team=2">Барсы</a>
                            <a href="index_info.php?team=4">Ястребы</a>
                        </div>
                    </div>

                    <div>
                        <a href="contest.php" class="contest_btn"> Сравнение </a>
                    </div>
                </div>
                <div class="header_menu">
                    <a href="">
                        <img src="images/Ellipse 1.png" class="profile_mini" />
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main style="min-height: 100vh; display: flex; justify-content: center;">
        <div class="logs_table" style="display: flex; justify-content: center; align-items: center;">
            <table id="table_log" style="height: 70vh;">
                <tr>
                    <th class="rate_name">Дата</th>
                    <th class="rate_name">Админ</th>
                    <th class="rate_name">Действие</th>
                    <th class="rate_name">Получатель</th>
                    <th class="rate_name">Критерии</th>
                    <th class="rate_name">Причина</th>
                </tr>

                <?php
                $query = mysqli_query($mysqli, "SELECT * FROM логи");
                $row = mysqli_fetch_all($query);
                $array = array();
                foreach ($row as $item) {
                    ?>

                    <tr>
                        <th class="rate_num" style="text-align: center; width: 20%;"><?= $item[1] ?></th>
                        <?php
                        $query_temp = mysqli_query($mysqli, "SELECT concat(Имя, ' ', Фамилия) as ФИО FROM админы WHERE id = {$item[2]}");
                        $row_temp = mysqli_fetch_assoc($query_temp);
                        $fio = $row_temp['ФИО'] . "\n({$item[3]} lvl)";
                        ?>
                        <th class="rate_num" style="text-align: center; width: 10%;"><?= $fio ?></th>
                        <th class="rate_num" style="text-align: center;"><?= $item[4] ?></th>
                        <?php
                        if ($item[5] == 'Курсант') {
                            $query_temp = mysqli_query($mysqli, "SELECT concat(Имя, ' ', Фамилия) as ФИО FROM курсанты WHERE id = {$item[6]}");
                            $row_temp = mysqli_fetch_assoc($query_temp);
                            $item[5] = $row_temp['ФИО'];
                        } else if ($item[5] == 'Группа') {
                            $query_temp = mysqli_query($mysqli, "SELECT Название FROM группы WHERE id = {$item[6]}");
                            $row_temp = mysqli_fetch_assoc($query_temp);
                            $item[5] = $row_temp['Название'];
                        }
                        ?>
                        <th class="rate_num" style="text-align: center;"><?= $item[5] ?></th>
                        <th class="rate_num" style="text-align: center;"><?= $item[7] ?></th>
                        <th class="rate_num" style="text-align: center;"><?= $item[8] ?></th>
                    </tr>

                    <?php

                } ?>

            </table>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer_wrapper">
                <div class="footer_left">
                    <p class="footer_text">Центр военно-спортивной подготовки «РУСИЧИ»</p>
                </div>
                <div class="footer_right">
                    <a href="https://vk.com/cvsprus">
                        <img src="images/vk.png" class="footer_vk">
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script src="main_scripts.js"></script>
    <script>
        checkAfk()
    </script>


</html>