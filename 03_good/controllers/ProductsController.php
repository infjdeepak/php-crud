<?php

namespace app\controllers;

// use app\Router;

class ProductsController {
  public function index($router) {
    $router->renderView("/products/index");
  }
}
