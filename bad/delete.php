<?php
$id = $_POST["id"] ?? null;
if (!$id) {
  header("location: ./");
  exit;
}

//database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "products_db";
$conn = mysqli_connect($servername, $username, $password, $dbName);



$sql = "DELETE FROM `products` WHERE `id`=$id";
mysqli_query($conn, $sql);
header("location: ./");
exit;
