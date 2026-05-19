<?php
session_start();
include "db.php";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] == "user") {
        $user_id = $_SESSION['user_id'];  
        $sql = "SELECT * FROM payments WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error!: " . $conn->error;
            exit;
        }
    } else {
        header("Location: admin/dashboard.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Orders | TrandHive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #fffafc;
      font-family: 'Roboto', sans-serif;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 230px;
      height: 100vh;
      background-color: #fff;
      border-right: 2px solid #eee;
      padding-top: 50px;
      text-align: center;
    }

    .sidebar h4 {
      font-family: 'Playfair Display', serif;
      color: #b3006b;
      margin-bottom: 20px;
    }

    .sidebar .card-link {
      background-color: #ffd1dc;
      color: #541a52;
      padding: 15px;
      border-radius: 10px;
      margin: 10px 20px;
      text-decoration: none;
      display: block;
      font-weight: bold;
      transition: 0.3s;
    }

    .sidebar .card-link:hover {
      background-color: #eec1d6;
      transform: scale(1.05);
    }

    .sidebar img {
      width: 80px;
      margin-top: 40px;
    }

    .main-content {
      margin-left: 230px;
      padding: 40px;
    }

    .main-content h2 {
      color: #b3006b;
      font-family: 'Playfair Display', serif;
      margin-bottom: 30px;
    }

    .table {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.06);
      overflow: hidden;
    }

    .table th {
      background-color: #d63384;
      color: white;
    }

    footer {
      text-align: center;
      padding: 20px;
      color: #999;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4>TrandHive</h4>
  <a href="index.php" class="card-link">🏬 Shop</a>
  <a href="myorders.php" class="card-link">📦 My Orders</a>
  <a href="logout.php" class="card-link">🚪 Logout</a>
  
</div>

<!-- Main content -->
<div class="main-content">
  <h2>📦 My Orders</h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Total Amount</th>
            <th>Payment Method</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $row['order_id']; ?></td>
            <td><?= $row['user_id']; ?></td>
            <td>Rs. <?= $row['total_amount']; ?></td>
            <td><?= ucfirst($row['payment_method']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">No orders found!</div>
  <?php endif; ?>
</div>

</body>
</html>
