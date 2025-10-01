<?php
session_start();
include '../config/config.php';
include '../includes/header.php';

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

echo "<h2>Your Cart</h2>";

if (empty($_SESSION['cart'])) {
    echo "Cart is empty.";
} else {
    $ids = implode(",", array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $qty = $_SESSION['cart'][$row['id']];
        $subtotal = $qty * $row['price'];
        $total += $subtotal;
        echo "<p>{$row['name']} - Quantity: $qty - Subtotal: \$$subtotal</p>";
    }
    echo "<h3>Total: \$$total</h3>";
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
}
include '../includes/footer.php';
?>