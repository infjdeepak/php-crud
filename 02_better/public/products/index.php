<?php
//database connection
include_once "../../database.php";


//get all data
$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<?php
include_once "../../views/partials/header.php";
include_once "../../views/products/table.php";
?>

</body>

</html>