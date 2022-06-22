<?php
  session_start();
  $servername = "localhost";
  $database = "u0860712_sandbox4";
  $username = "u0860712_sand04";
  $password = "U4k6U0j8";
    // Создаем соединение
  $conn = mysqli_connect($servername, $username, $password, $database);
  //$conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
  //  $discr1 =  htmlspecialchars( $_POST['discription'],ENT_QUOTES);
  if (isset($_POST['reg'])) {
    $login =  mysqli_real_escape_string($conn,htmlspecialchars($_POST['login'],ENT_QUOTES));
    $pass = md5(  mysqli_real_escape_string($conn,$_POST['password']));
    $name =  mysqli_real_escape_string($conn,htmlspecialchars($_POST['nameP'],ENT_QUOTES));
    $surname =  mysqli_real_escape_string($conn,htmlspecialchars($_POST['surnameP'],ENT_QUOTES));
    $email =  mysqli_real_escape_string($conn,htmlspecialchars($_POST['emailP'],ENT_QUOTES));
    $email2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['emailP'],ENT_QUOTES));
    $query1 = "SELECT login FROM users WHERE login = '{$login}'";
    $query2 = "SELECT emailP FROM users WHERE emailP = '{$email}'";
    $res1 = mysqli_query($conn, $query1);
    $res2 = mysqli_query($conn,$query2);
    if ($user = mysqli_fetch_assoc($res1)) {
      echo "<script> alert('Пользователь с таким логином уже есть');</script>";
    }
    else if($email2 = mysqli_fetch_assoc($res2)){
        echo "<script> alert('Пользователь с таким email уже есть');</script>";
    }
    else {
      $query = "INSERT INTO users (id, login, password, nameP, surnameP,  emailP)" .
        "VALUES('', '{$login}', '{$pass}', '{$name}', '{$surname}', '{$email}');";
      $res = mysqli_query($conn, $query);  
      header("location: login.php");
    }
    
    // if (strlen($_POST['password'])<6) 
    // {
    //   echo "<script> alert('Пароль должен быть больше 6 символов');</script>";
    //   header("location: login.php");
    // }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Справочник терминов</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="  sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <link rel="stylesheet" type="text/css" href="style.css">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"   crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>
  <div class="row_p" style="font-weight: bold; float: left;
    margin-left: 20px;"><a name="feedBack"></a>
      <div class="container">
        <form class="reg" method="post">
          <label for="login">Логин</label> <br />
          <input type="text" name="login" id="login" required> <br />
          <label for="password">Пароль</label> <br />
          <input type="password" name="password" id="password" minlength="6" required> <br />
          <label for="name">Ваше имя</label> <br />
          <input type="text" name="nameP" id="name" placeholder="Имя" required> <br />
          <label for="surname">Ваша Фамилия</label> <br />
          <input type="text" name="surnameP" id="surname" placeholder="Фамилия" required> <br />
          <label for="email">Ваш электронный адрес</label> <br />
          <input type="text" name="emailP" id="emailU" placeholder="Электронный адрес"  required> <br />
            <script src="inputmask.js"></script>
            <script> 
            $(document).ready(function(){   
                $("#emailU").inputmask("email")
            });
            </script> </br>
          <input class="btn btn-dark" type="submit" name="reg" value="Зарегистрироваться">
        </form>
      </div>
    </div>
</body>
</html>