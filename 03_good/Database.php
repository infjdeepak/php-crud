<?php

namespace app;

use mysqli_sql_exception;

class Database {
  public $conn;

  public function __construct() {
    //database connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbName = "products_db";
    try {
      $this->conn = mysqli_connect($servername, $username, $password, $dbName);
    } catch (mysqli_sql_exception) {
      echo mysqli_connect_error() . " end </br>";
      exit;
    }
  }

  public function getProducts() {
    //get all data
    $sql = "SELECT * FROM `products`";
    $result = mysqli_query($this->conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $products;
  }

  public function getProductById($id) {
    $sql = "SELECT * FROM `products` WHERE `id`=$id";
    $result = mysqli_query($this->conn, $sql);
    $product = mysqli_fetch_assoc($result);
    return $product;
  }

  public function createProduct($product) {
    // print_r($product);
    $sql = "INSERT INTO `products` (`title`, `description`, `image`) 
            VALUES ('$product->title', '$product->description', '$product->imagePath')";
    try {
      mysqli_query($this->conn, $sql);
    } catch (mysqli_sql_exception) {
      echo mysqli_error($this->conn) . " end </br>";
      exit;
    }
  }
  public function updateProduct($product) {
    $sql = "UPDATE `products` SET 
    `title`='$product->title',
    `description`='$product->description',
    `image`='$product->imagePath' WHERE `id`=$product->id";
    try {
      mysqli_query($this->conn, $sql);
      header("location: /");
      exit;
    } catch (mysqli_sql_exception) {
      echo mysqli_error($this->conn) . " end </br>";
      exit;
    }
  }
  public function deleteProduct($id) {
    $sql = "DELETE FROM `products` WHERE `id`=$id";
    try {
      mysqli_query($this->conn, $sql);
      header("location: /");
      exit;
    } catch (mysqli_sql_exception) {
      echo mysqli_error($this->conn) . " end </br>";
      exit;
    }
  }
}
