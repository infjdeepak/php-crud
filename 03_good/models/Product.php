<?php

namespace app\models;

use app\Database;



class Product {

  public $id = null;
  public $title;
  public $description;
  public $imagePath = null;
  public $imageFile;

  public function load($data) {
    $this->id = $data["id"] ?? null;
    $this->title = $data["title"];
    $this->description = $data["description"];
    $this->imageFile = $data['imageFile'];
    $this->imagePath = $data["imagePath"] ?? null;
  }

  public function save() {
    // echo "data is saved";
    $errors = [];
    if (!is_dir(__DIR__ . "/../public/images")) {
      mkdir(__DIR__ . "/../public/images");
    }

    if (!$this->title) {
      $errors[] = "Product title is required.";
    }

    if (empty($errors)) {
      if ($this->imageFile && $this->imageFile["tmp_name"]) {
        if ($this->imagePath) {
          unlink(__DIR__ . '/../public/' . $this->imagePath);
          rmdir(__DIR__ . '/../public/' . dirname($this->imagePath));
        }
        $this->imagePath = "images/" . uniqid() . "/" . $this->imageFile["name"];
        mkdir(dirname(__DIR__ . '/../public/' . $this->imagePath));
        move_uploaded_file($this->imageFile["tmp_name"], __DIR__ . '/../public/' . $this->imagePath);
      }

      $db = new Database();

      if ($this->id) {
        $db->updateProduct($this);
      } else {
        $db->createProduct($this);
      }
    }
    return $errors;
  }
}
