<?php

namespace app;

use app\Database;

class Router {
  public array $getRoutes = [];
  public $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function get($url, $fn) {
    $this->getRoutes[$url] = $fn;
  }

  public function resolve() {
    $currentUrl = $_SERVER["PATH_INFO"] ?? "/";
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method === "GET") {
      $fn = $this->getRoutes[$currentUrl] ?? null;
    }
    if ($fn) {
      call_user_func($fn, $this);
    } else {
      echo "page not found";
    }
  }

  public function renderView($view) {
    ob_start();
    include_once __DIR__ . "/views/$view.php";
    $content = ob_get_clean();
    include_once __DIR__ . "/views/_layout.php";
  }
}
