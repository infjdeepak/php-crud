<section class="container mt-5">
  <h1>Add a product</h1>
  <div class="py-4">
    <a href="/" class="btn btn-info">Back to products page</a>
  </div>
  <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error . "</br>"; ?>
    </div>
  <?php } ?>
  <form action="/products/create" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value=<?php echo $product["title"]; ?>>
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Description</label>
      <textarea type="text" class="form-control" id="desc" name="description"><?php echo $product["description"]; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="add_product" value="true">Submit</button>
  </form>
</section>