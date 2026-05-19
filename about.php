<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us | TrandHive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Roboto&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fff4f7;
    }
    .about-section {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 20px;
    }
    .about-image {
      max-width: 100%;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .about-text h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      color: #d63384;
      margin-bottom: 20px;
    }
    .about-text p {
      font-size: 1.1rem;
      line-height: 1.6;
      color: #333;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #2d1e30;">
  <div class="container">
    <a class="navbar-brand text-light fw-bold" href="index.php">
      <img src="image/logo.png" width="40" class="me-2"> TrandHive
    </a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-light" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="about.php">About Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- About Section -->
<section class="about-section container">
  <div class="row align-items-center">
    <div class="col-md-6 mb-4 mb-md-0">
      <img src="image/slice.webp" alt="About Image" class="about-image">
    </div>
    <div class="col-md-6 about-text">
      <h2>Where Style Meets Elegance</h2>
      <p>
        Welcome to <strong>TrandHive</strong> — your ultimate destination for luxury bags that define personality, power, and poise.
        <br><br>
        Whether you're heading to the office, a weekend getaway, or a night out — we have the perfect bag crafted just for you.
        <br><br>
        With every product, we blend premium quality, modern aesthetics, and timeless trends to help you express your unique style.
        <br><br>
        <em>TrandHive — not just bags, but a statement.</em>
      </p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center p-3" style="background-color: #2d1e30; color: #f7caca;">
  &copy; <?= date('Y') ?> TrandHive. Designed by Sundas Latif.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
