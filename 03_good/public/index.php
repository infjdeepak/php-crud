<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\ProductsController;
use app\Router;

$router = new Router();


$router->get("/", [new ProductsController(), "index"]);
$router->get("/products", [new ProductsController(), "index"]);
$router->get("/products/", [new ProductsController(), "index"]);

$router->resolve();
