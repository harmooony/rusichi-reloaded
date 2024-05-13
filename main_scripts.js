function dropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function dropdown_team1() {
  document.getElementById("myDropdown_t1").classList.toggle("show");
}

function dropdown_team2() {
  document.getElementById("myDropdown_t2").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

function blockInput(event) {
  if (event.key === "Delete" || event.key === "Backspace") {
    event.target.value = "";
  } else {
    event.preventDefault();
  }
}

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

  } else if (chooseField.value === "Курсант") {
    form.action = 'php_scripts/add_points_ind.php';
    nameField.setAttribute("list", "login");
    kritField.setAttribute("list", "kriterii_ind");
    nameField.disabled = false;
    kritField.disabled = false;

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



let seconds = 30;

function checkAfk() {
  if (seconds > 0) {
    console.log(seconds, document.URL);
    seconds--;
    setTimeout(checkAfk, 1000);
  }
  else {
    window.location.href = 'index.php'
  }
}

if (document.URL != 'http://rusichi-reloaded/') {
  if (document.URL != 'http://rusichi-reloaded/index.php') {
    // Получаем ссылку на элемент, к которому хотим привязать функцию
    document.addEventListener('click', function () {
      seconds = 30;
    });
    document.addEventListener('scroll', function () {
      seconds = 30;
    });
    document.addEventListener('keypress', function () {
      seconds = 30;
    });
    document.addEventListener('mousemove', function () {
      seconds = 30;
    });
    //checkAfk();
  }
}