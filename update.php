<?php
  session_start();
  // $servername = "localhost";
  // $database = "whatasoft";
  // $username = "root";
  // $password = "";

  $servername = "localhost";
  $database = "u0860712_sandbox4";
  $username = "u0860712_sand04";
  $password = "U4k6U0j8";
    // Создаем соединение
  $conn = mysqli_connect($servername, $username, $password, $database);
  //$conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
  $id = $_POST['id'];
  $query = "SELECT * FROM forms WHERE id = '{$id}'";
  $res = mysqli_query($conn, $query);

  //$order   = array("<script>", "</script>","'");
  // $html = array("\"","'");
  $field = mysqli_fetch_assoc($res);
  $name = $field['name'];
  $discr = $field['discription'];
  $hard = $field['hard'];

$order   = array("&lt;b&gt;", "&lt;/b&gt;","&lt;u&gt;","&lt;/u&gt;","&lt;/br&gt;");
$new_order = array("<b>","</b>","<u>","</u>","</br>");

  if (isset($_POST['updateField'])) {
    $name =  mysqli_real_escape_string($conn,strip_tags($_POST['name']));
    $discr1 =  htmlspecialchars( $_POST['discription'],ENT_QUOTES);
    $discr =  mysqli_real_escape_string($conn,str_replace($order, $new_order, $discr1));
    $hard = $_POST['hard'];
    settype($id, 'integer');
    settype($hard, 'integer');
    $query = "UPDATE forms SET id='{$id}',name='{$name}',discription='{$discr}',hard='{$hard}' WHERE id='{$id}'";
    mysqli_query($conn, $query);
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
  <h3 style=" margin-left: 20px;">Обновление поля</h3>
            <form method='post'>
                <input type='hidden' name='id' value="<?php echo $id; ?>" required/>
                <p style=" margin-left: 20px;">Название:
                <input type='text' name='name' value="<?php echo $name; ?>" required/></p>
                <p style=" margin-left: 20px;">Описание:
                <textarea name='discription' required><?php echo $discr; ?> </textarea> </p>
                <!-- <input  type='text' name='discription' value='<?php echo $discr; ?>' required /></p> -->
                <p style=" margin-left: 20px;">Сложность:
                <input type = "number" name = "hard"  value="<?php echo $hard; ?>" min="1" max="5" required> </p>
                 <input style=" margin-left: 20px;" type='submit' name='updateField' class="btn btn-dark" value='Сохранить'>
          </form>;

</body>
</html>