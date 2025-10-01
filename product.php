<?php
include '../config/config.php';
include '../includes/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();
?>

<h2><?= $product['name'] ?></h2>
<img src="../assets/images/<?= $product['image'] ?>" width="200">
<p><?= $product['description'] ?></p>
<p>Price: $<?= $product['price'] ?></p>

<form method="post" action="cart.php">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>

<?php include '../includes/footer.php'; ?>
