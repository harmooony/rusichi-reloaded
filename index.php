<?php
require_once ("php_scripts/connect.php");
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a href="contest.php" class="contest_btn">
                            Сравнение
                        </a>

                    </div>
                </div>
                <div class="header_menu">
                    <a href="profile.php">
                        <img src="images/Ellipse 1.png" class="profile_mini" />
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="team_main_container">
                <p id="team" class="team_main"><?= $team_name ?></p>
                <img id="team_logo" src="<?= $logo ?>" class="team_main_icon" />
                <p id="rating" class="team_main_rate">Рейтинг:</p>
            </div>
        </div>

        <div class="container">
            <div class="team_main_graph_container">
                <div style="background-color: <?= $color ?>;" class="team_main_legend">
                    <h1 class="team_main_h">Легенда</h1>
                    <p class="team_main_p">Разведчики - оливковый</p>
                    <p class="team_main_p">Спасатели - оранжевый</p>
                    <p class="team_main_p">Защитники - хаки</p>
                    <p class="team_main_p">Богатыри - синий</p>
                    <p class="team_main_p">Мероприятия - красный</p>
                    <p class="team_main_p">Чистота - Белый</p>
                    <p class="team_main_p">Поведение - фиолетовый</p>
                </div>
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div style="display: flex; align-items: center; justify-content: center; width: 90%; height: 90%;">
                        <canvas id="mychart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="team_main_indrate_container">
                <h1 class="team_main_indrate_label">Рейтинг членов команды</h1>
                <input type="text" class="admin_input" id="search">
                <script>
                    var id = 2;
                    var id_rows = 2;
                    var tick = 10000;
                    var sum = 0;

                    function getRows() {
                        $.ajax({
                            url: 'php_scripts/get_team_members_data.php',
                            type: 'POST',
                            data: { id: id_rows },
                            success: function (response) {
                                response = JSON.parse(response);
                                $('#table').empty();
                                $('#table').append("<tr><th class='rate_name'>Курсант</th><th class='rate_num' style='width: 50%;'>Рейтинг</th></tr>");
                                sum = 0;
                                $.each(response, function (i, item) {
                                    $('#table').append("<tr style='display: none;'><th style='text-align: center; font-size: 20px'>" + item.Имя + " " + item.Фамилия +
                                        "</th>" + "<th style='text-align: center; font-size: 20px'>" + item.Инд_рейтинг + "</th></tr>");
                                    sum += parseInt(item.Инд_рейтинг);
                                });
                                console.log(sum);
                                $('#table tr').fadeIn(1100);
                            }
                        });
                        if (id_rows < 4) {
                            id_rows++;
                        } else if (id_rows === 4) {
                            id_rows = 1;
                        }
                    }
                </script>
                <table id="table" style="width:100%; padding-bottom: 20px; margin-top: 20px" class="rating_output">
                </table>
            </div>
        </div>
    </main>

    <script src="main_scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php


    $id = 1;

    $query = mysqli_query($mysqli, "SELECT * FROM груп_рейтинг WHERE id = {$id}");
    $row = mysqli_fetch_assoc($query);
    $data[0] = $row['Разведчики'];
    $data[1] = $row['Спасатели'];
    $data[2] = $row['Защитники'];
    $data[3] = $row['Богатыри'];
    $data[4] = $row['Мероприятия'];
    $data[5] = $row['Чистота'];
    $data[6] = $row['Поведение'];

    $jsonData = json_encode($data);
    ?>
    <script>
        var chartData = <?php echo $jsonData; ?>;
        var list = [1, 1];
        console.log(chartData, list);
        var myChart;
        var flag = true;
        let labels = ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'];
        let labels_main = ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'];

        function updateChart() {

            $.ajax({
                url: 'php_scripts/get_graph_data.php',
                type: 'post',
                data: { id: id },
                success: function (response) {
                    var newData = JSON.parse(response);
                    chartData = newData;
                    myChart.data.datasets[0].data = chartData;
                }
            });


            for (let i = 0; i < chartData.length; i++) {
                labels[i] = labels_main[i] + (" (" + chartData[i] + ")");
            }

            var ctx = document.getElementById('mychart').getContext('2d');
            let existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.update();
                existingChart.resize(600, 600);
                existingChart.resize(700, 700);

            } else {
                myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'График',
                            data: chartData,
                            backgroundColor: ['olive', 'orange', '#806b2a', 'blue', 'red', 'white', 'purple'],
                            borderWidth: .1,
                            borderColor: 'black'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                display: false
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        animation: {
                            duration: 1000,
                        },
                    }
                });

            }
            var total = 0;
            for (let i = 0; i < 7; i++) {
                total += parseInt(chartData[i]);
            }
            var result = total + (sum) * 0.1;
            console.log("result = ", sum, total);
            document.getElementById('rating').innerHTML = "Рейтинг: " + result;

            $.ajax({
                url: 'php_scripts/get_team_data.php',
                type: 'post',
                data: { id: id },
                success: function (response) {
                    var team = JSON.parse(response);
                    $('#team').fadeOut(300, function () {
                        $(this).html(team[0]).fadeIn(300);
                    });
                    $('#team_logo').fadeOut(300, function () {
                        $(this).attr('src', team[1]).fadeIn(300);
                    });
                }
            });
            if (id < 4) {
                id++;
            } else if (id === 4) {
                id = 1;
            }

        }

        getRows();

        setTimeout(updateChart, 100);

        setInterval(function () {
            getRows();
            setTimeout(updateChart, 100);
        }, tick);      
    </script>
</body>

</html>