<?php
session_start();
require_once ("php_scripts/connect.php");

if (isset($_SESSION['user']['type'])) {
  if ($_SESSION['user']['type'] == "admin1") {
    header("Location: admin_profile_first.php");
  } else if ($_SESSION['user']['type'] == "admin2") {
    header("Location: admin_profile_second.php");
  }
} else {
  header("Location: login.php");
}

$id = $_SESSION['user']['id'];

$query = mysqli_query($mysqli, "SELECT * FROM курсанты WHERE id={$id}");
$row = mysqli_fetch_assoc($query);
$name = $row['Имя'];
$surname = $row['Фамилия'];
$rating = $row['инд_рейтинг'];
$id_group = $row['id_группы'];

if (!isset($id_group)) {
  $team = "Без команды";
} else {
  $query = mysqli_query($mysqli, "SELECT * FROM группы WHERE id={$id_group}");
  $row = mysqli_fetch_assoc($query);
  $team = $row['Название'];
}

$id = $_SESSION['user']['id'];

$query = mysqli_query($mysqli, "SELECT * FROM инд_рейтинг WHERE id_курсанта = {$id}");
$row = mysqli_fetch_assoc($query);
$data[0] = $row['Разведчик'];
$data[1] = $row['Спасатель'];
$data[2] = $row['Защитник'];
$data[3] = $row['Богатырь'];
$data[4] = $row['Мероприятия'];
$data[5] = $row['Поведение'];

$jsonData = json_encode($data);
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
            <a href="contest.php" class="contest_btn"> Сравнение </a>
          </div>
        </div>
        <div class="header_menu">
          <a href="login.php">
            <img src="images/Ellipse 1.png" class="profile_mini" />
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="profile_container">
        <div class="profile_green">
          <div class="profile_card">
            <img src="images/Ellipse 1.png" class="profile_photo" />
            <div class="profile_card_names">
              <p class="profile_rank">Без звания</p>
              <p class="profile_name"><?= $name ?></p>
              <p class="profile_surname"><?= $surname ?></p>
              <p class="profile_rank"><?= $team ?></p>
            </div>
          </div>
        </div>
        <p class="profile_indrate">Твой индивидуальный рейтинг</p>
        <div class="profile_rating">
          <p class="profile_modules">Модули и баллы:</p>
          <div class="profile_card">
            <div style="display: flex; flex-direction: column; justify-content: end;">
              <p class="profile_categories" style="color: olive">Разведчик: <?= $data[0] ?></p>
              <p class="profile_categories" style="color: orange">Спасатель: <?= $data[1] ?></p>
              <p class="profile_categories" style="color: darkgreen">Защитник: <?= $data[2] ?></p>
              <p class="profile_categories" style="color: blue">Богатырь: <?= $data[3] ?></p>
              <p class="profile_categories" style="color: red">Мероприятия: <?= $data[4] ?></p>
              <p class="profile_categories last" style="color: purple">Поведения: <?= $data[5] ?></p>
            </div>
            <div class="profile_graph">
              <canvas id="mychart"></canvas>
            </div>
          </div>
        </div>
        <button onclick="window.location.href = 'php_scripts/logout.php'" class="admin_exitbutton">Выйти</button>
      </div>
    </div>
  </main>

  <script src="main_scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    var chartData = <?php echo $jsonData; ?>;
    console.log(chartData);


    var ctx = document.getElementById('mychart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Разведчик', 'Спасатель', 'Защитник', 'Богатырь', 'Мероприятия', 'Поведение'],
        datasets: [{
          label: 'График',
          data: chartData,
          backgroundColor: ['olive', 'orange', 'darkgreen', 'blue', 'red', 'white', 'purple'],
          borderWidth: .1,
          borderColor: 'black',
          cutout: '70%',
          hoverOffset: 4,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        }
      }
    });

  </script>

</body>

</html>