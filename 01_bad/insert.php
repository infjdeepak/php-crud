<?php
//database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "products_db";
$conn = mysqli_connect($servername, $username, $password, $dbName);

$errors = [];
$title = $description = null;

if (isset($_POST["add_product"])) {
  $title = htmlspecialchars($_POST["title"]);
  $description = htmlspecialchars($_POST["desc"]);

  //errors
  if (!$title) {
    $errors[] = "Title is required";
  }

  if (empty($errors)) {
    $fileName = $_FILES["image"]["name"] ?? null;
    $fileTempPath = $_FILES["image"]["tmp_name"] ?? null;

    if ($fileName) {
      //image
      if (!is_dir("images")) {
        mkdir("images");
      }
      $pathForUploading = "images/" . uniqid() . "/" . $fileName;
      mkdir(dirname($pathForUploading));
      move_uploaded_file($fileTempPath, $pathForUploading);
    }

    $sql = "INSERT INTO `products` (`title`, `description`, `image`) 
    VALUES ('$title', '$description', '$pathForUploading');";
    mysqli_query($conn, $sql);
    header("location: ./");
    exit;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <section class="container mt-5">
    <h1>Add a product</h1>
    <div class="py-4">
      <a href="./" class="btn btn-info">Back to products page</a>
    </div>
    <?php foreach ($errors as $error) { ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error . "</br>"; ?>
      </div>
    <?php } ?>
    <form action="./insert.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="desc" name="desc"><?php echo $description; ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary" name="add_product" value="true">Submit</button>
    </form>
  </section>
</body>

</html>