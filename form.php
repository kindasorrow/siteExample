<?php 

  $servername = "localhost";
  $database = "u0860712_sandbox4";
  $username = "u0860712_sand04";
  
  $password = "U4k6U0j8";
    // Создаем соединение
   // $conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
  $conn = mysqli_connect($servername, $username, $password, $database);

  $order   = array("&lt;b&gt;", "&lt;/b&gt;","&lt;u&gt;","&lt;/u&gt;","&lt;/br&gt;");
  $new_order = array("<b>","</b>","<u>","</u>","</br>");
  $name =mysqli_real_escape_string($conn, strip_tags($_POST['name']));
  //$discr = str_replace($order, "", $_POST['discription']);
  $discr1 =  htmlspecialchars( $_POST['discription'],ENT_QUOTES);
  $discr = mysqli_real_escape_string($conn,str_replace($order, $new_order, $discr1));
  $hard = $_POST['hard'];
  settype($hard, 'integer');
  $insert_sql = "INSERT INTO forms (name, discription, hard)" .
  "VALUES('{$name}', '{$discr}', '{$hard}');";
  // mysqli_query($conn, " SET 'cp1251' COLLATE 'cp1251_general_ci' "); // SET cp1251 COLLATE cp1251_general_ci  charset=$dbChar
  mysqli_query($conn, $insert_sql);
  //echo "$discr";
  header('Location: index.php');
//  header('Location: /web/'); 
?>