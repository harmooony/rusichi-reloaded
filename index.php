<?php
require_once ("php_scripts/connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

  <title>Русичи</title>
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <div class="page_body">
    <img src="images/rfGerb 2.png" class="first_l">
    <img src="images/rfGerb 1.png" class="second_l">
    <img src="images/rfGerb 3.png" class="first_r">
    <img src="images/rfGerb 4.png" class="second_r">
  </div>
  <header>
    <div class="container">
      <div class="header_wrapper">
        <div class="header_logo">
          <img src="" />
          <div class="dropdown">
            <button onclick="dropdown()" class="dropbtn">Команды</button>
            <div id="myDropdown" class="dropdown-content">
              <a href="bears.php">Медведи</a>
              <a href="ryisi.php">Рыси</a>
              <a href="barsi.php">Барсы</a>
              <a href="eagles.php">Орлы</a>
            </div>
          </div>
          <div>
            <a href="" class="contest_btn">
              Сравнение
            </a>
          </div>
        </div>
        <div class="header_menu">
          <a href="">
            <img src="images/Ellipse 1.png" class="profile_mini">
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="contest_container">
        <div>
          <div class="dropdown">
            <button onclick="dropdown_team1()" id="team1" class="dropbtn dropbtn_contest">Барсы</button>
            <div id="myDropdown_t1" class="dropdown-content">
              <a onclick="update(3, 1)">Медведи</a>
              <a onclick="update(1, 1)">Рыси</a>
              <a onclick="update(2, 1)">Барсы</a>
              <a onclick="update(4, 1)">Орлы</a>
            </div>
          </div>
          <!-- 1 столбик -->

          <div class="contest_member">
            <img id="team_logo1" src="images/team_barci.png" class="contest_membimg">
            <div style="background-color: rgba(255, 255, 255, 0.4); border-radius: 20px; padding: 20px"
              class="contest_graph">
              <!-- Место для графика команды -->
              <canvas id="chart1"></canvas>

              <?php

              $query = mysqli_query($mysqli, "SELECT * FROM груп_рейтинг WHERE id = 1");
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
                var ctx1 = document.getElementById('chart1').getContext('2d');
                var existingChart1 = Chart.getChart(ctx1);
                if (existingChart1) {
                  existingChart.update();
                } else {
                  myChart1 = new Chart(ctx1, {
                    type: 'doughnut',
                    data: {
                      labels: ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'],
                      datasets: [{
                        label: 'График',
                        data: chartData,
                        backgroundColor: ['olive', 'orange', '#806b2a', 'blue', 'red', 'white', 'purple'],
                        borderWidth: .1,
                        cutout: '80%',
                        hoverOffset: 4
                      }]
                    },
                    options: {
                      plugins: {
                        legend: {
                          position: 'bottom'
                        },
                      },
                      animation: {
                        duration: 1000,
                      },
                    }
                  });

                }

                var total1 = 0;
                for (let i = 0; i < 7; i++) {
                  total1 += parseInt(chartData[i]);
                }
              </script>

            </div>

            <div class="contest_teamrate">
              <p id="grup1" class="contest_teamrate_text">Общий рейтинг команды: </p>
            </div>
            <div class="contest_indrate">
              <p class="contest_indrate_text">Индивидуальный рейтинг:</p>
              <table id="table1" style="width:100%; padding-bottom: 20px">
                <tr>
                  <th class="rate_name">Имя</th>
                  <th class="rate_num">Рейтинг</th>
                </tr>


                <?php
                $query = mysqli_query($mysqli, "SELECT Имя, Фамилия, Инд_рейтинг FROM курсанты WHERE id_группы = 2 ORDER BY Инд_рейтинг DESC");
                $row = mysqli_fetch_all($query);
                $sum = 0;
                foreach ($row as $item) {
                  ?>
                  <tr>
                    <th style="text-align: center; font-size: 20px"><?= $item[0] . " " . $item[1] ?></th>
                    <th style="text-align: center; font-size: 20px"><?= $item[2] ?></th>
                    <?php $sum = $sum + $item[2] ?>
                  </tr>

                  <?php

                }
                $jsonNumber = json_encode($sum); ?>

              </table>
            </div>

          </div>
        </div>
        <!-- 2 столбик -->
        <div>
          <div class="dropdown">
            <button onclick="dropdown_team2()" id="team2" class="dropbtn dropbtn_contest">Медведи</button>
            <div id="myDropdown_t2" class="dropdown-content">
              <a onclick="update(3, 2)">Медведи</a>
              <a onclick="update(1, 2)">Рыси</a>
              <a onclick="update(2, 2)">Барсы</a>
              <a onclick="update(4, 2)">Орлы</a>
            </div>
          </div>

          <div class="contest_member">
            <img id="team_logo2" src="images/team_bears.png" class="contest_membimg">
            <div style="background-color: rgba(255, 255, 255, 0.4); border-radius: 20px; padding: 20px"
              class="contest_graph">
              <!-- Место для графика команды -->
              <canvas id="chart2"></canvas>

              <?php

              $query = mysqli_query($mysqli, "SELECT * FROM груп_рейтинг WHERE id = 2");
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
                var ctx2 = document.getElementById('chart2').getContext('2d');
                var existingChart2 = Chart.getChart(ctx2);
                if (existingChart2) {
                  existingChart2.update();
                } else {
                  myChart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                      labels: ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'],
                      datasets: [{
                        label: 'График',
                        data: chartData,
                        backgroundColor: ['olive', 'orange', '#806b2a', 'blue', 'red', 'white', 'purple'],
                        borderWidth: .1,
                        cutout: '80%',
                        hoverOffset: 4
                      }]
                    },
                    options: {
                      plugins: {
                        legend: {
                          position: 'right'
                        },
                      },
                      animation: {
                        duration: 1000,
                      },
                    }
                  });

                }

                var total2 = 0;
                for (let i = 0; i < 7; i++) {
                  total2 += parseInt(chartData[i]);
                }
              </script>
            </div>
            <div class="contest_teamrate">
              <p id="grup2" class="contest_teamrate_text">Общий рейтинг команды: </p>
            </div>
            <div class="contest_indrate">
              <p class="contest_indrate_text">Индивидуальный рейтинг: </p>
              <table id="table2" style="width:100%; padding-bottom: 20px">
                <tr>
                  <th class="rate_name">Имя</th>
                  <th class="rate_num">Рейтинг</th>
                </tr>


                <?php
                $query = mysqli_query($mysqli, "SELECT Имя, Фамилия, Инд_рейтинг FROM курсанты WHERE id_группы = 3 ORDER BY Инд_рейтинг DESC");
                $row = mysqli_fetch_all($query);
                $sum = 0;
                foreach ($row as $item) {
                  ?>
                  <tr>
                    <th style="text-align: center; font-size: 20px"><?= $item[0] . " " . $item[1] ?></th>
                    <th style="text-align: center; font-size: 20px"><?= $item[2] ?></th>
                    <?php $sum = $sum + $item[2] ?>
                  </tr>

                  <?php

                }
                $jsonNumber = json_encode($sum); ?>

              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="main_scripts.js"></script>
  <script>
    document.getElementById('grup1').innerHTML = "Общий рейтинг команды: " + total1;
    document.getElementById('grup2').innerHTML = "Общий рейтинг команды: " + total2;

    function update(id, column) {
      var tekChart;
      var tekTable;
      if (column == 1) {
        tekChart = 'chart1'
        tekTable = '#table1'
      } else if (column == 2) {
        tekChart = 'chart2'
        tekTable = '#table2'
      }
      $.ajax({
        url: 'php_scripts/get_team_members_data.php',
        type: 'POST',
        data: { id: id },
        success: function (response) {
          response = JSON.parse(response);
          $(tekTable).empty();
          $(tekTable).append("<tr><th class='rate_name'>Курсант</th><th class='rate_num'>Рейтинг</th></tr>");
          $.each(response, function (i, item) {
            $(tekTable).append("<tr style='display: none;'><th style='text-align: center; font-size: 20px'>" + item.Имя + " " + item.Фамилия +
              "</th>" + "<th style='text-align: center; font-size: 20px'>" + item.Инд_рейтинг + "</th></tr>");
          });
          $(tekTable + ' tr').fadeIn(800);
        }
      });

      $.ajax({
        url: 'php_scripts/get_team_data.php',
        type: 'post',
        data: { id: id },
        success: function (response) {
          var team = JSON.parse(response);
          if (column == 1) {
            $('#team1').fadeOut(300, function () {
              $(this).html(team[0]).fadeIn(300);
            });
            $('#team_logo1').fadeOut(300, function () {
              $(this).attr('src', team[1]).fadeIn(300);
            });
          } else if (column == 2) {
            $('#team2').fadeOut(300, function () {
              $(this).html(team[0]).fadeIn(300);
            });
            $('#team_logo2').fadeOut(300, function () {
              $(this).attr('src', team[1]).fadeIn(300);
            });
          }
        }
      });

      
      let labels = ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'];
      let labels_main = ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'];
      setTimeout(function () {
        $.ajax({
          url: 'php_scripts/get_graph_data.php',
          type: 'post',
          data: { id: id },
          success: function (response) {
            var newData = JSON.parse(response);
            chartData = newData;
            if (tekChart == 'chart1') {
              myChart1.data.datasets[0].data = chartData;
            } else if (tekChart == 'chart2') {
              myChart2.data.datasets[0].data = chartData;
            }
            console.log(chartData);

            for (let i = 0; i < chartData.length; i++) {
              labels[i] = labels_main[i] + (" (" + chartData[i] + ")");
            }

            var ctx = document.getElementById(tekChart).getContext('2d');
            var existingChart = Chart.getChart(ctx);
            if (existingChart) {
              existingChart.update();
              console.log(chartData, "Изменено");
            }
          }
        });
      }, 300);

    }
  </script>
</body>

</html>