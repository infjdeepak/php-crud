<?php
$id = $_POST["id"] ?? null;
if (!$id) {
  header("location: ./");
  exit;
}

//database connection
include_once "../../database.php";



$sql = "DELETE FROM `products` WHERE `id`=$id";
mysqli_query($conn, $sql);
header("location: ./");
exit;
