<?php

namespace app;

class Database {
  public $conn;

  public function __construct() {
    //database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "products_db";
    $this->conn = mysqli_connect($servername, $username, $password, $dbName);
  }

  public function getProducts() {
    //get all data
    $sql = "SELECT * FROM `products`";
    $result = mysqli_query($this->conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $products;
  }
}
