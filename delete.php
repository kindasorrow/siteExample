<?php
$servername = "localhost";
$database = "u0860712_sandbox4";
$username = "u0860712_sand04";
$password = "U4k6U0j8";
  if (isset($_POST["id"])) {
    $conn = new mysqli("localhost", $username, $password, $database);
        $userid = $_POST["id"];
        settype($userid, 'integer');
        $sql = "DELETE FROM forms WHERE id = '$userid'";


        mysqli_query($conn, $sql);
        header("Location: index.php");
  }
?>