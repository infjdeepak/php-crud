<?php

namespace app\controllers;

// use app\Router;
use app\models\Product;

class ProductsController {

  public function index($router) {

    $products = $router->db->getproducts();
    $router->renderView("/products/index", [
      "products" => $products
    ]);
  }

  public function create($router) {
    $productData = [
      "title" => "",
      "description" => "",
      "image" => ""
    ];
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $productData["title"] = $_POST["title"];
      $productData["description"] = $_POST["description"];
      $productData['imageFile'] = $_FILES['image'] ?? null;

      // echo "<pre>";
      // print_r($productData);
      // echo "</pre>";

      $product = new Product();
      $product->load($productData);
      $errors =  $product->save($router);
      if (!$errors) {
        header("location: /products");
        exit;
      }
    }

    $router->renderView("/products/create", [
      "product" => $productData,
      "errors" => $errors
    ]);
  }

  public function update($router) {

    $errors = [];

    $id = $_GET["id"] ?? null;
    if (!$id) {
      header("location: /");
      exit;
    }
    $productData = $router->db->getProductByid($id);


    // echo "<pre>";
    // print_r($productData);
    // echo "</pre>";

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $productData["title"] = $_POST["title"];
      $productData["description"] = $_POST["description"];
      $productData['imageFile'] = $_FILES['image'] ?? null;

      $product = new Product();
      $product->load($productData);
      $errors =  $product->save($router);
      if (!$errors) {
        header("location: /products");
        exit;
      }
    }

    $router->renderView("/products/update", [
      "product" => $productData,
      "errors" => $errors
    ]);
  }
  public function delete($router) {
    //echo "delete page";
    $id = $_POST["id"] ?? null;

    if (!$id) {
      header("location: /products");
      exit;
    }
    $router->db->deleteProduct($id);
  }
}
