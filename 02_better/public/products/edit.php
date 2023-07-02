<?php
$id = $_GET["id"] ?? null;

if (!$id) {
  $id = $_POST["id"];
  echo $id;
}
//database connection
include_once "../../database.php";
$errors = [];


//get data
$sql = "SELECT * FROM `products` WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

$title = $product["title"] ?? null;
$description = $product["description"] ?? null;
$image = $product["image"] ?? null;


if (isset($_POST["update_product"])) {
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
      //delete image
      unlink($image);
      rmdir(dirname($image));
      //image
      if (!is_dir("../images")) {
        mkdir("../images");
      }
      $pathForUploading = "../images/" . uniqid() . "/" . $fileName;
      mkdir(dirname($pathForUploading));
      move_uploaded_file($fileTempPath, $pathForUploading);
      $sql = "UPDATE `products` SET 
              `title`='$title',
              `description`='$description',
              `image`='$pathForUploading' WHERE `id`=$id";
    } else {
      $sql = "UPDATE `products` SET 
      `title`='$title',
      `description`='$description' WHERE `id`=$id";
    }
    mysqli_query($conn, $sql);
    header("location: ./");
    exit;
  }
}


?>

<?php include_once "../../views/partials/header.php"; ?>
<section class="container mt-5">
  <h1>Edit <?php echo $title ?></h1>
  <div class="py-4">
    <a href="./" class="btn btn-info">Back to products page</a>
  </div>
  <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error . "</br>"; ?>
    </div>
  <?php } ?>
  <form action="./edit.php" method="post" enctype="multipart/form-data">
    <img class="small-img" src="<?php echo $image; ?>" alt="">
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Description</label>
      <textarea type="text" class="form-control" id="desc" name="desc"><?php echo $description; ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-primary" name="update_product" value="true">Submit</button>
  </form>
</section>
</body>

</html>