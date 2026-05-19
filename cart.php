<?php
session_start();
include "db.php";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='text-center mt-5'>
            <h3 style='color: #b3006b;'>🛒 Your cart is empty!</h3>
            <a href='index.php' class='btn btn-primary mt-3' style='background-color:#541a52; border:none;'>Continue Shopping</a>
          </div>";
    exit;
}

$cart_items = $_SESSION['cart'];
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart - TrandHive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fdf5f9;
        }
        h2 {
            color: #b3006b;
            font-family: 'Playfair Display', serif;
        }
        .table {
            background-color: #fff;
            border: 2px solid #e89ecb;
            border-radius: 12px;
            overflow: hidden;
        }
        .table th {
            background-color: #541a52;
            color: #ffd1dc;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-success {
            background-color: #b3006b;
            border: none;
        }
        .btn-success:hover {
            background-color: #80004d;
        }
        .total-box {
            padding: 20px;
            background-color: #fff;
            border: 2px solid #e89ecb;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">👜 Your Shopping Cart</h2>

    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $product_id => $qty): 
                    $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
                    $row = mysqli_fetch_assoc($result);
                    $subtotal = $qty * $row['price'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $qty ?></td>
                    <td>Rs. <?= $row['price'] ?></td>
                    <td>Rs. <?= $subtotal ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-6">
            <div class="total-box">
                <h4 class="text-end">Total: <span style="color: #b3006b;">Rs. <?= $total ?></span></h4>
                <div class="text-end mt-3">
                    <a href="place_order.php" class="btn btn-success">Place Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
