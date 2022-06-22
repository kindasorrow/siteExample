<?php
  session_start();
  $servername = "localhost";
  $database = "u0860712_sandbox4";
  $username = "u0860712_sand04";
  $password = "U4k6U0j8";
    // Создаем соединение
    //$conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
    $conn = mysqli_connect($servername, $username, $password, $database);

  $id =  $_SESSION['user_id'];
  settype($id, 'integer');
  $query = "SELECT * FROM users WHERE id = '{$id}'";
  $res = mysqli_query($conn, $query);

  $field = mysqli_fetch_assoc($res);
  $name = $field['nameP'];
  $surname = $field['surnameP'];

  //  $discr1 =  htmlspecialchars( $_POST['discription'],ENT_QUOTES);
  if (isset($_POST['updateField'])) {
    $name = mysqli_real_escape_string($conn,htmlspecialchars($_POST['nameP'],ENT_QUOTES));
    $surname =mysqli_real_escape_string($conn,htmlspecialchars( $_POST['surnameP'],ENT_QUOTES));
    $query = "UPDATE users SET id='{$id}',nameP='{$name}',surnameP='{$surname}' WHERE id='{$id}'";
    mysqli_query($conn, $query);
    $_SESSION['user_name'] = $name;
    header("location: index.php");
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Справочник терминов</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="  sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <link rel="stylesheet" type="text/css" href="styles/style.css">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.b  undle.min.js" integrity="sha384-ka7S  k0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"   crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>
  <h3>Обновление пользователя</h3>
            <form method='post'>
                <input type='hidden' name='id' value="<?php echo $id; ?>" required/>
                <p>Имя:
                <input type='text' name='nameP' value="<?php echo $name; ?>" required/></p>
                <p>Фамилия:
                <input type='text' name='surnameP' value="<?php echo $surname; ?>" required /></p>
                 <input type='submit' name='updateField' class="btn btn-dark" value='Сохранить'>
          </form>;

</body>
</html>