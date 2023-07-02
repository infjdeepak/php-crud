<?php
//database connection
include_once "../../database.php";

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
      if (!is_dir("../images")) {
        mkdir("../images");
      }
      $pathForUploading = "../images/" . uniqid() . "/" . $fileName;
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

<?php include_once "../../views/partials/header.php"; ?>
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