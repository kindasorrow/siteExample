<?php //changes for git
session_start();
if (!isset($_SESSION['auth'])) {
  header("Location: http://sandbox4.whatasoft.net/login.php");
}
?>
<html>
  <head>
    <title>Справочник терминов</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <link rel="shortcut icon" href="logo.png" type="image/png"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="sort.js"></script>
  </head>
  <body>
    <div class="header_p">
      <!-- <img src="img/logo.png" class="logo_p"> -->
      <p class = "text">Справочник терминов</p>
      <!-- <a href="#aboutFlowers">Наши букеты</a> -->
      <!-- <a href="#feedBack">Оставить заявление</a> -->
      <?php if (!isset($_SESSION['auth'])) {
        //header('Location : login.php');
        echo "<button onclick=\"window.location.href='login.php'\" type=\"button\" class=\"btn btn-primary btn-lg\" >Войти</button>
             <button onclick=\"window.location.href='reg.php'\" type=\"button\" class=\"btn btn-secondary btn-lg\" href='reg.php'>Зарегестрироваться</button>";
      } else {
        echo "<i style = \"float: left;  margin-left: 20px;\"f> Здравствуйте, " . $_SESSION['user_name'] . "!</i>
        <button onclick=\"window.location.href='change.php'\" type=\"button\" class=\"btn btn-secondary btn-md\" href='reg.php'>Изменить данные</button>
        <button onclick=\"window.location.href='logup.php'\" type=\"button\" class=\"btn btn-secondary btn-md\" href='reg.php'>Выйти</button>";
      }?>
  </div>
  </br>
  </br>
<?php
 //$servername = "31.31.198.41";
 //$database = "u0860712_sandbox4";
// $username = "u0860712_sand4";
 //$password = "U4k6U0j8";
//$conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
$conn = mysqli_connect('localhost', 'u0860712_sand04', 'U4k6U0j8', 'u0860712_sandbox4');
if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
}
$sql = "SELECT * FROM forms";
if($result = mysqli_query($conn, $sql)){
     
    $rowsCount = mysqli_num_rows($result); // количество полученных строк
    echo "<table class=\"table table-striped table_sort\"><thead class=\"thead-dark\"><tr> <th scope=\"col\">Номер</th><th scope=\"col\" id = \"click\">Название</th><th scope=\"col\">Описание</th><th scope=\"col\">Сложность</th></tr> </thead>";
    echo "<tbody>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" ."<b>". $row["id"] ."</b>". "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["discription"] . "</td>";
            echo "<td>" . $row["hard"] . "</td>";
            echo "<td><form action='delete.php' method='post'>
                <input type='hidden' name='id' value='" . $row["id"] . "'>
                <input class=\"btn btn-dark\" type='submit' value='Удалить'  onclick=\"return confirm ('Точно удалить запись?'); \">
            </form></td>";
            echo "<td><form method='post' action='update.php'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <input class=\"btn btn-dark\" type='submit' name='update' value='Изменить'>
                        </form></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    mysqli_free_result($result);
    echo " <button  style = \"float: left; margin-left: 20px;\" type=\"submit\" class=\"btn btn-primary \" onclick=\"window.location.href='excel.php'\">Экспорт в Exel</button>";

} else{
    echo "Ошибка: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
<form  enctype="multipart/form-data" method="post" action="import.php">
<table style = "float: right; margin-right: 14%;" border="1">
<tr >
<td colspan="2" align="center"><strong>Import CSV file</strong></td>
</tr>
<tr>
<td align="center">CSV File:</td><td><input type="file" name="file" id="file"></td></tr>
<tr >
</tr>
<tr >
<td colspan="2" align="center"><input type="submit" value="Отправить"></td>
</tr>
</table>
</form>

<div  style = "margin-left: 20px;"class="input-group mb-3"><a name="feedBack"></a>
      <div class="container">
        <form action="form.php" class="form" method="post">
        </br>
                <div class="form-group">
            <label for="exampleFormControlInput1" class="font-weight-bold text">Название</label>
            <input name = "name"  class="form-control" id="exampleFormControlInput1" placeholder="название" maxlength="50" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="font-weight-bold text">Описание</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "discription" placeholder="описание" required></textarea>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1" class="font-weight-bold text">Сложность</label>
            <select class="form-control" id="exampleFormControlSelect1" name = "hard" default=3 required>
            <option>1</option>
            <option>2</option>
            <option selected="selected">3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
 </br>
        <button type="submit" class="btn btn-dark">Отправить</button>
        </form>
      </div>
  </body>
</html>