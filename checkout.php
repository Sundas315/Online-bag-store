<?php
session_start();
include "db.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='alert alert-warning text-center mt-5'>
            🛒 Your cart is empty. <a href='index.php' class='btn btn-sm btn-primary mt-2' style='background-color:#541a52;border:none;'>Shop Now</a>
          </div>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_items = $_SESSION['cart'];
$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout | TrandHive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fdf5f9;
    }

    .container {
      max-width: 800px;
      margin-top: 60px;
      background: #fff;
      border: 2px solid #e89ecb;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.05);
    }

    h2 {
      color: #b3006b;
      font-family: 'Playfair Display', serif;
    }

    .table {
      border-radius: 8px;
      overflow: hidden;
    }

    .table thead {
      background-color: #541a52;
      color: #ffd1dc;
    }

    .btn-primary {
      background-color: #541a52;
      border: none;
    }

    .btn-primary:hover {
      background-color: #6f2d6e;
    }

    .total-box {
      font-size: 18px;
      color: #b3006b;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">🛒 Checkout</h2>

  <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($cart_items as $product_id => $qty) {
          $sql = "SELECT * FROM products WHERE id = '$product_id'";
          $result = mysqli_query($conn, $sql);
          if ($product = mysqli_fetch_assoc($result)) {
              $price = $product['price'];
              $subtotal = $price * $qty;
              $total_amount += $subtotal;
              echo "<tr>
                      <td>{$product['name']}</td>
                      <td>Rs. {$price}</td>
                      <td>{$qty}</td>
                      <td>Rs. {$subtotal}</td>
                    </tr>";
          }
      }
      ?>
      <tr>
        <td colspan="3" class="text-end"><strong>Total:</strong></td>
        <td><strong class="text-success">Rs. <?= $total_amount ?></strong></td>
      </tr>
    </tbody>
  </table>

  <form method="post" action="place_order.php">
    <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary px-5 py-2">Place Order</button>
    </div>
  </form>
</div>

</body>
</html>
