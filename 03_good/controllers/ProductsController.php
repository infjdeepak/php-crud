<?php

namespace app\controllers;

// use app\Router;

class ProductsController {
  public function index($router) {
    print_r($router);
    $router->renderView("/products/index");
  }
}
