<?php
//database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "products_db";

$conn = mysqli_connect($servername, $username, $password, $dbName);


//gett alll data
$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <h1>Products Table</h1>
    <div class="table">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $i => $product) { ?>
            <tr>
              <td><?php echo $i + 1; ?></td>
              <td><?php echo $product["image"]; ?></td>
              <td><?php echo $product["title"]; ?></td>
              <td><?php echo $product["description"]; ?></td>
              <td><?php echo $product["created_at"]; ?></td>
              <td>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
              </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>
</body>

</html>