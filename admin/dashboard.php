<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $desc  = $_POST['desc'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $desc, $price);
    $stmt->execute();
}

?>

<form method="POST">
  <input name="name" placeholder="Product Name" required />
  <textarea name="desc" placeholder="Description"></textarea>
  <input type="number" step="0.01" name="price" placeholder="Price" required />
  <button type="submit">Add Product</button>
</form>
