<?php
session_start();
include "db.php";

// Fetch categories
$sql_category = "SELECT * FROM categories";
$result_category = mysqli_query($conn, $sql_category);

// Fetch products by category if selected
if (isset($_GET['category_name'])) {
  $category_name = $_GET['category_name'];
  $sql_product_category = "SELECT * FROM products WHERE category_name = '$category_name' AND stock > 0";
} else {
  $sql_product_category = "SELECT * FROM products WHERE stock > 0";
}
$result_product_category = mysqli_query($conn, $sql_product_category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TrandHive | Online Bag Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fdf5f9;
    }

    .navbar {
      background-color: #541a52;
    }

    .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-size: 30px;
      color: #ffd1dc !important;
    }

    .navbar-brand img {
      margin-right: 10px;
    }

    .nav-link {
      color: #ffd1dc !important;
      font-weight: 500;
    }

    .dropdown-menu {
      min-width: 180px;
    }

    .sidebar-box {
      background-color: #fff;
      border: 2px solid #e89ecb;
      border-radius: 10px;
      padding: 20px;
      width: 100%;
      max-width: 250px;
    }

    .category-list li {
      margin-bottom: 10px;
    }

    .category-list li a {
      text-decoration: none;
      color: #b3006b;
      font-weight: 500;
    }

    .category-list li a:hover {
      color: #80004d;
      font-weight: bold;
    }

    .category-image {
      margin-top: 20px;
      width: 100%;
      border-radius: 10px;
    }

    .carousel-img {
      height: 480px;
      object-fit: cover;
      border-radius: 12px;
    }

    .product-card {
      border: 1px solid #ffcce0;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      background-color: white;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .product-card:hover {
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 10px 20px rgba(211, 33, 144, 0.2);
      border-color: #e89ecb;
    }

    .btn-primary {
      background-color: #541a52;
      border: none;
    }

    .btn-primary:hover {
      background-color: #6f2d6e;
    }

    .btn-success {
      background-color: #b3006b;
      border: none;
    }

    .btn-success:hover {
      background-color: #80004d;
    }

    footer {
      background-color: #541a52;
      color: #ffd1dc;
      padding: 20px;
      text-align: center;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="image/logo.png" alt="Logo" width="40" height="40">
      TrandHive
    </a>

    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navLinks">
      <ul class="navbar-nav ms-auto align-items-center">
         <li class="nav-item">
         <a class="nav-link position-relative" href="cart.php">
           🛒 
          <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= array_sum($_SESSION['cart']); ?>
              </span>
              <?php endif; ?>
              </a>
             </li>

        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="30" height="30" alt="User Icon" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="register.php">Signup</a></li>
            <?php if (isset($_SESSION['user_id'])) { ?>
              <?php if ($_SESSION['user_role'] === 'user') { ?>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <?php } elseif ($_SESSION['user_role'] === 'admin') { ?>
                <li><span class="dropdown-item text-muted">Admin Panel</span></li>
                <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <?php } ?>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php if (isset($_GET['added'])): ?>
<div class="alert alert-success text-center">✅ Product added to cart!</div>
<?php endif; ?>

<!-- Page Content -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 mb-3">
      <div class="sidebar-box">
        <h5>Categories</h5>
        <ul class="list-unstyled category-list">
          <?php while($row_category = mysqli_fetch_assoc($result_category)){ ?>
            <li><a href="index.php?category_name=<?= $row_category['name'] ?>"><?= $row_category['name'] ?></a></li>
          <?php } ?>
        </ul>
        <img src="image/product2.jpg" class="category-image" alt="Category Promo">
      </div>
    </div>

    <!-- Carousel + Products -->
    <div class="col-md-9">
      <div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="image/slice2.webp" class="d-block w-100 carousel-img" alt="...">
          </div>
          <div class="carousel-item">
            <img src="image/slice.webp" class="d-block w-100 carousel-img" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>

      <!-- Products -->
      <div class="row g-4">
        <?php while($row_product = mysqli_fetch_assoc($result_product_category)) { ?>
        <div class="col-md-4 col-sm-6 d-flex">
          <div class="product-card text-center w-100 h-100">
            <img src="image/<?= $row_product['image']; ?>" class="img-fluid mb-3" alt="Bag Image">
            <h5><?= $row_product['name']; ?></h5>
            <p class="text-muted"><?= $row_product['description']; ?></p>
            <p><strong>Quantity:</strong> <?= $row_product['stock']; ?></p>
            <p class="text-success"><strong>Rs. <?= $row_product['price']; ?></strong></p>

            <div class="mt-auto d-flex gap-2">
              <a href="add_to_cart.php?product_id=<?= $row_product['id'] ?>" class="btn btn-success w-100">Add to Cart</a>


              <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="singleorder.php?user_id=<?= $_SESSION['user_id']; ?>&product_id=<?= $row_product['id']; ?>&product_price=<?= $row_product['price']; ?>" class="btn btn-success w-100">Buy Now</a>
              <?php } else { ?>
                <a href="login.php" class="btn btn-success w-50">Buy Now</a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <p>&copy; <?= date('Y') ?> TrandHive | Designed by Sundas Latif</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
