<?php
session_start();

if (isset($_SESSION['user']['type'])) {
  if ($_SESSION['user']['type'] == "admin1") {
    header("Location: admin_profile_first.php");
  } else if ($_SESSION['user']['type'] == "admin2") {
    header("Location: admin_profile_second.php");
  } else if ($_SESSION['user']['type'] == "kursant") {
    header("Location: profile.php");
  }
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
      <div class="login_form">
        <p class="login_label">Вход в аккаунт</p>
        <form action="php_scripts/authorization.php" method="post" class="login_platform">
          <p class="admin_p">Логин</p>
          <input name="login" type="text" class="admin_input">
          <p class="admin_p">Пароль</p>
          <input name="password" type="password" class="admin_input">
          <input type="submit" class="admin_button" value="Войти"></input>
          <p>
            <?php
            if ($_SESSION['message']) {
              echo $_SESSION['message'];
            }
            unset($_SESSION['message']);
            ?>
          </p>

        </form>
      </div>
    </div>
  </main>

  <script src="main_scripts.js"></script>
  <script>
     checkAfk();
  </script>

</body>

</html>