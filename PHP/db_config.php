<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
