<?php
require_once ("php_scripts/connect.php");

$team = $_GET['team'];

if ($team < 1 || $team > 4) {
  header("Location: index_info.php?team=4");
}

$query = mysqli_query($mysqli, "SELECT Название FROM группы WHERE id = {$team}");
$row = mysqli_fetch_assoc($query);
$team_name = $row['Название'];

$logo = '';
$color = '';

if ($team_name == 'Рыси') {
  $logo = './images/team_risi.png';
  $color = 'rgb(224, 177, 140)';
} else if ($team_name == 'Барсы') {
  $logo = './images/team_barci.png';
  $color = 'rgb(129,224,253);';
} else if ($team_name == 'Медведи') {
  $logo = './images/team_bears.png';
  //$color = 'rgb(101,56,24)';
  $color = 'darkorange';
} else if ($team_name == 'Ястребы') {
  $logo = './images/team_yastrebi.png';
  $color = 'rgb(255, 219, 88)';
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
          <img class="main_logo" width="10%" src="images/logo_1-01.svg" onclick="window.location.href = 'index.php'">
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
        <p class="team_main"><?= $team_name ?></p>
        <img src="<?= $logo ?>" class="team_main_icon" />
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
        <table id="table" style="width:100%; padding-bottom: 20px; margin-top: 20px" class="rating_output">
          <tr>
            <th class="rate_name" style="width: 50%;">Имя</th>
            <th class="rate_num" style="width: 50%;">Рейтинг</th>
          </tr>
          <?php

          $team = $_GET['team'];

          $query = mysqli_query($mysqli, "SELECT Имя, Фамилия, Инд_рейтинг FROM курсанты WHERE id_группы = {$team} ORDER BY Инд_рейтинг DESC");
          $row = mysqli_fetch_all($query);
          $sum = 0;
          foreach ($row as $item) {
            ?>
            <tr>
              <th style="text-align: center; font-size: 20px; width: 50%;"><?= $item[0] . " " . $item[1] ?></th>
              <th style="text-align: center; font-size: 20px; width: 50%;"><?= $item[2] ?></th>
              <?php $sum = $sum + $item[2] ?>
            </tr>

            <?php

          }
          $tableSum = json_encode($sum); ?>
        </table>
      </div>
    </div>
  </main>

  <script src="main_scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php

  $team = $_GET['team'];

  $query = mysqli_query($mysqli, "SELECT * FROM груп_рейтинг WHERE id_группы = {$team}");
  $row = mysqli_fetch_assoc($query);
  $data[0] = $row['Разведчики'];
  $data[1] = $row['Спасатели'];
  $data[2] = $row['Защитники'];
  $data[3] = $row['Богатыри'];
  $data[4] = $row['Мероприятия'];
  $data[5] = $row['Чистота'];
  $data[6] = $row['Поведение'];

  $jsonSum = json_encode(array_sum($data));
  $jsonData = json_encode($data);
  ?>
  <script>
    var sumChart = <?php echo $jsonSum; ?>;
    var tableSum = <?php echo $tableSum; ?>;
    document.getElementById('rating').innerHTML = "Рейтинг: " + (sumChart + tableSum * 0.1);

    var chartData = <?php echo $jsonData; ?>;

    var ctx = document.getElementById('mychart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Разведчики', 'Спасатели', 'Защитники', 'Богатыри', 'Мероприятия', 'Чистота', 'Поведение'],
        datasets: [{
          label: 'График',
          data: chartData,
          backgroundColor: ['olive', 'orange', 'darkgreen', 'blue', 'red', 'white', 'purple'],
          borderWidth: 1,
          cutout: '60%',
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            display: false,
          },
          x: {
            display: false,
          }
        },
        plugins: {
          legend: {
            display: false,
            labels: {
              font: {
                size: 20
              }
            }

          },
        },
        animation: {
          duration: 1000,
        },
      }
    });

    function filterTable() {
      let search = document.getElementById('search').value.toUpperCase().trim();
      let rows = document.getElementById('table').getElementsByTagName("tr");

      for (let i = 1; i < rows.length; i++) {
        let firstColumnContent = rows[i].cells[0].textContent.toUpperCase();
        rows[i].style.display = firstColumnContent.includes(search) ? "" : "none";
      }
    }

    document.getElementById('search').addEventListener('keyup', filterTable);
  </script>
  <script>
    checkAfk();
  </script>
</body>

</html>