<?php
// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN! РАБОТАЕТ УУААА
$servername = "localhost";
$database = "u0860712_sandbox4";
$username = "u0860712_sand04";
$password = "U4k6U0j8";
  // Создаем соединение
$conn = mysqli_connect($servername, $username, $password, $database);

//$conn = mysqli_connect('localhost', 'root', '', 'whatasoft');
mysqli_query($conn, "SET 'utf8' COLLATE 'utf8_general_ci'");
$sql = "SELECT * FROM `forms` ";
$q=mysqli_query($conn, $sql);

function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
  header('Content-Type: application/csv');
  header('Content-Disposition: attachment; filename="'.$filename.'";');

  // open the "output" stream
  // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
  $f = fopen('php://output', 'w');
  foreach ($array as $line) {
   // var_dump($line);
    // if($line != null)
      fputcsv($f, $line, $delimiter);
    //   else break;
  }
} 

array_to_csv_download($q);
?>