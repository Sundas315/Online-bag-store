<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_items = $_SESSION['cart'];
$total_amount = 0;

// Insert each item into multiple_orders
foreach ($cart_items as $product_id => $qty) {
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
    $product = mysqli_fetch_assoc($result);
    $price = $product['price'];
    $subtotal = $qty * $price;
    $total_amount += $subtotal;

    mysqli_query($conn, "INSERT INTO multiple_orders (user_id, product_id, quantity, subtotal) 
                         VALUES ('$user_id', '$product_id', '$qty', '$subtotal')");

    mysqli_query($conn, "UPDATE products SET stock = stock - $qty WHERE id = $product_id");
}

// Record payment
mysqli_query($conn, "INSERT INTO payments (user_id, total_amount, payment_method) 
                     VALUES ('$user_id', '$total_amount', 'cashon')");

// Clear cart
unset($_SESSION['cart']);

echo "<div class='text-center mt-5'>
        <h3>✅ Order Placed Successfully!</h3>
        <a href='index.php' class='btn btn-primary mt-3'>Continue Shopping</a>
      </div>";
?>
