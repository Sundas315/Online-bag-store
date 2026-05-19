<?php
session_start();
if(isset($_SESSION['user_id'])) {
    if($_SESSION['user_role'] !== "user") {
        header("Location: admin/dashboard.php");
    }
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Dashboard | TrandHive</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Roboto&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #fdf5f9;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 260px;
      height: 100vh;
      background-color: #fff;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
      padding: 30px 15px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border-right: 2px solid #eee;
    }

    .sidebar-header .user-greeting {
      font-size: 15px;
      color: #541a52;
      margin: 0 0 20px 0;
      text-align: center;
    }

    .sidebar-menu a {
      display: block;
      color: #541a52;
      padding: 10px 20px;
      font-weight: 500;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: background-color 0.3s, color 0.3s;
    }

    .sidebar-menu a:hover {
      background-color: #ffd1dc;
      color: #541a52;
    }

    .sidebar-img {
      text-align: center;
    }

    .sidebar-img img {
      width: 80px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .main-content {
      margin-left: 260px;
      padding: 50px;
    }

    .main-content h2 {
      font-family: 'Playfair Display', serif;
      color: #b3006b;
      margin-bottom: 20px;
    }

    .main-content p {
      font-size: 16px;
      color: #333;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 260px;
      width: calc(100% - 260px);
      background-color: #541a52;
      color: #ffd1dc;
      text-align: center;
      padding: 15px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <div class="sidebar-header">
        <p class="user-greeting">👋 Hello, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong></p>
      </div>
      <div class="sidebar-menu">
        <a href="index.php">🏬 Shop</a>
        <a href="myorders.php">📦 My Orders</a>
        <a href="logout.php">🚪 Logout</a>
      </div>
    </div>
    <div class="sidebar-img">
      <img src="assets/slice2.webp" alt="">
    </div>
  </div>

  <!-- Main content -->
  <div class="main-content">
    <h2>Welcome to Your Dashboard</h2>
    <p>Hello <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong>,</p>
    <p>This is your personalized space where you can manage your orders and explore new products from <strong>TrandHive</strong>.</p>
  </div>

  <!-- Footer -->
  <footer>
    &copy; <?= date('Y') ?> TrandHive | Designed by WebTech Knowledge
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
