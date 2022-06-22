<?php
  session_start();

  $servername = "localhost";
  $database = "u0860712_sandbox4";
  $username = "u0860712_sand04";
  $password = "U4k6U0j8";
    // Создаем соединение
   // $conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
  $conn = mysqli_connect($servername, $username, $password, $database);
  //SELECT name FROM users WHERE login='{$login}'
  if (isset($_POST['auth'])) {
    $login =  mysqli_real_escape_string($conn,$_POST['login']);
    $pass = md5( mysqli_real_escape_string($conn,$_POST['password']));
    $query = "SELECT * FROM users WHERE login = '{$login}' AND password = '{$pass}'";
    $result = mysqli_query($conn, $query);
    if ($user = mysqli_fetch_assoc($result)) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['nameP'];
      $_SESSION['auth'] = '1';
      header("location: index.php");
    }
    else {
      echo "<script>alert('Такого пользователя не существует.')</script>";
    }
  }
?>
<!-- login -->
<!DOCTYPE html>
<html>
  <head>
    <title>Справочник терминов</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="/frontend/www/img/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1"crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="row_p" style="font-weight: bold; float: left;
    margin-left: 20px;"><a name="login"></a>
      <div class="container">
        <form method="post">
          <label for="login">Имя пользователя</label> <br />
          <input type="text" name="login" id="login" required> <br />
          <label for="password">Пароль</label> <br />
          <input type="password" name="password" id="password" required> <br />
            </br>
          <input type="submit" name="auth" class="btn btn-dark" value="Войти">
        </form> 
        <a href="reg.php" style="font-weight: normal;">Зарегистрироваться <br /></a>
        <a href="index.php" style="font-weight: normal;"> Вернуться на сайт</a>
      </div>
    </div>
  </body>
</html>