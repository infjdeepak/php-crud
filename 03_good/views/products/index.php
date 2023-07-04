<section class="container mt-5">
  <h1>Products Table</h1>
  <div class="py-4">
    <a href="/products/create" class="btn btn-info">Add a product</a>
  </div>
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
            <td><img class="small-img" src="<?php echo $product["image"]; ?>" alt=""></td>
            <td><?php echo $product["title"]; ?></td>
            <td><?php echo $product["description"]; ?></td>
            <td><?php echo $product["created_at"]; ?></td>
            <td>
              <a class="btn btn-primary" href="/products/update?id=<?php echo $product["id"]; ?>">Edit</a>
              <form action="/products/delete" method="post" class="d-inline-block">
                <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
                <button class="btn btn-danger">Delete</button>
              </form>
            </td>

          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>