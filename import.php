<?php

$servername = "localhost";
$database = "u0860712_sandbox4";
$username = "u0860712_sand04";
$password = "U4k6U0j8";
  // Создаем соединение
$conn = mysqli_connect($servername, $username, $password, $database);
//$conn = mysqli_connect('localhost', 'root', '', 'whatasoft2');
//$loadfile = "otchet_" . date('Ymd') . ".xls";

//Указать кодировку выводимых данных
 // mysqli_query ($conn," SET 'cp1251' COLLATE 'cp1251_general_ci' ");
 //mysqli_query ($conn,"SET NAMES ''");

 mysqli_query($conn, "SET 'utf8' COLLATE 'utf8_general_ci'");

 $order   = array("&lt;b&gt;", "&lt;/b&gt;","&lt;u&gt;","&lt;/u&gt;","&lt;/br&gt;");
 $new_order = array("<b>","</b>","<u>","</u>","</br>");

 $filename = $_FILES["file"]["name"];
 $ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));
//var_dump($filename);
$filename2 = $_FILES["file"]['tmp_name'];
   if (move_uploaded_file($filename2,'export.csv'))
   {
      echo "файл загружен";
   }
   else{ 
   echo "файл не получилось загрузить";
   var_dump(move_uploaded_file($filename,'export.csv'));
   }
 if($ext==".csv"){
    $file = fopen($filename, "r");
    while (($emapData = fgetcsv($file, 10000, ";")) !== FALSE)

       {   $name =  mysqli_real_escape_string($conn,strip_tags($emapData[1]));
           $disc1 =  htmlspecialchars( $emapData[2],ENT_QUOTES);
           $disc = mysqli_real_escape_string($conn,str_replace($order, $new_order, $disc1));
            // var_dump($name);
            // echo "\n";
            // var_dump($disc);
            // echo "\n";
            
            settype($emapData[3], 'integer');
            
        if ($emapData[3]<6 and $emapData[3]>0 and strlen($name)<51)
        {
        // $name =  strip_tags($emapData[1]);
        $sql = "INSERT into forms(name,discription,hard) values('$name','$disc','$emapData[3]')";
        mysqli_query($conn, $sql);
       }
    }
    fclose($file);
    header('Location: index.php');
   // echo "CSV File has been successfully Imported.";
 }
 else{

  echo "<script>alert('Выберите файл с расширением csv')</script>";
  header('Location: index.php');
 }
?>