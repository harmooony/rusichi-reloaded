<?php
session_start();
require_once ("php_scripts/connect.php");

if (isset($_SESSION['user']['type'])) {
  if ($_SESSION['user']['type'] == "admin1") {
    header("Location: admin_profile_first.php");
  } else if ($_SESSION['user']['type'] == "kursant") {
    header("Location: profile.php");
  }
} else {
  header("Location: login.php");
}

$id = $_SESSION['user']['id'];

$query = mysqli_query($mysqli, "SELECT * FROM админы WHERE id={$id}");
$row = mysqli_fetch_assoc($query);
$name = $row['Имя'];
$surname = $row['Фамилия'];
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
          <a href="">
            <img src="images/Ellipse 1.png" class="profile_mini" />
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <datalist id="login">
      <?php

      $query = mysqli_query($mysqli, "SELECT login FROM курсанты");
      $row = mysqli_fetch_all($query);
      foreach ($row as $item) {
        ?>
        <option> <?= $item[0] ?></option>
      <? } ?>
    </datalist>
    <datalist id="teams">
      <option>Медведи</option>
      <option>Рыси</option>
      <option>Барсы</option>
      <option>Ястребы</option>
    </datalist>
    <datalist id="do_choose">
      <option>Команда</option>
      <option>Курсант</option>
    </datalist>
    <datalist id="kriterii_grup">
      <option>Разведчики</option>
      <option>Спасатели</option>
      <option>Защитники</option>
      <option>Богатыри</option>
      <option>Мероприятия</option>
      <option>Чистота</option>
      <option>Поведение</option>
    </datalist>
    <datalist id="kriterii_ind">
      <option>Разведчик</option>
      <option>Спасатель</option>
      <option>Защитник</option>
      <option>Богатырь</option>
      <option>Мероприятия</option>
      <option>Поведения</option>
    </datalist>
    <div class="container">
      <div class="profile_container">
        <div class="profile_green">
          <div class="profile_card">
            <img src="images/Ellipse 1.png" class="profile_photo" />
            <div class="profile_card_names">
              <p class="profile_rank">Администратор 2-го уровня</p>
              <p class="profile_name"><?= $name ?></p>
              <p class="profile_surname"><?= $surname ?></p>
            </div>
          </div>
        </div>

        <div>
          <p class="admin_label notlast">Заполнение личных данных о курсанте</p>
          <div class="admin_create_container">
            <form action="php_scripts/send_fill.php" method="post" class="admin_create">
              <p class="admin_p">Логин</p>
              <input name="login" type="text" class="admin_input" list="login">
              <p class="admin_p">Достижения</p>
              <input name="achiev" type="text" class="admin_input">
              <p class="admin_p">Увлечения</p>
              <input name="uvlech" type="text" class="admin_input">
              <p class="admin_p">Имя</p>
              <input name="name" type="text" class="admin_input">
              <p class="admin_p">Фамилия</p>
              <input name="surname" type="text" class="admin_input">
              <p class="admin_p">Возраст</p>
              <input name="age" type="number" min="0" max="15" class="admin_input">
              <input type="submit" value="Добавить информацию" class="admin_button"></input>
            </form>
          </div>
        </div>

        <div>
          <p class="admin_label notlast">Начисление баллов</p>
          <div class="admin_create_container">
            <form id="form" action="php_scripts/add_points_ind.php" method="get" class="admin_create">
              <p class="admin_p">Команда или курсант</p>
              <input id="choose" type="text" class="admin_input" list="do_choose" onchange="update()"
                onkeydown="blockInput(event)" onpaste="blockInput(event)">

              <p class="admin_p">Логин/название</p>
              <input name="name" id="name" type="text" class="admin_input" onkeydown="blockInput(event)"
                onpaste="blockInput(event)">

              <p class="admin_p">Критерий</p>
              <input name="krit" id="krit" type="text" class="admin_input" onchange="checkNumber()"
                onkeydown="blockInput(event)" onpaste="blockInput(event)">

              <p class="admin_p">Количество баллов</p>
              <input name="kol" id="number" type="number" max="10" min="0" class="admin_input">

              <button class="admin_button">Начислить баллы</button>
            </form>
          </div>
        </div>
        <button onclick="window.location.href = 'php_scripts/logout.php'" class="admin_exitbutton">Выйти</button>

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

  <script>
    function update() {
      var chooseField = document.getElementById("choose");
      var nameField = document.getElementById("name");
      var kritField = document.getElementById("krit");
      var numberField = document.getElementById("number");
      var form = document.getElementById("form");

      if (chooseField.value === "Команда") {
        form.action = 'php_scripts/add_points_team.php';
        nameField.setAttribute("list", "teams");
        kritField.setAttribute("list", "kriterii_grup");
        nameField.disabled = false;
        kritField.disabled = false;
        numberField.disabled = false;
      } else if (chooseField.value == "Курсант") {
        form.action = 'php_scripts/add_points_ind.php';
        nameField.setAttribute("list", "login");
        kritField.setAttribute("list", "kriterii_ind");
        nameField.disabled = false;
        kritField.disabled = false;
        numberField.disabled = false;

      }
    }

    function checkNumber() {
      var kritField = document.getElementById("krit");
      var numberField = document.getElementById("number");

      if (kritField.value === "Чистота" || kritField.value === "Поведения" || kritField.value === "Поведения") {
        numberField.value = 0
        numberField.max = 1;
        numberField.min = -1;
      } else {
        numberField.value = 0
        numberField.max = 10;
        numberField.min = 0;
      }
    }
  </script>
  <script src="main_scripts.js"></script>
  <script>
    checkAfk();
  </script>

</body>

</html>