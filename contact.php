<?php
include "db.php"; // make sure this connects to your database

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO contact_messages (name, email, message) 
              VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $query)) {
        $success = "<div class='alert alert-success text-center'>✅ Message sent successfully!</div>";
    } else {
        $success = "<div class='alert alert-danger text-center'>❌ Failed: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact | TrandHive</title>
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

    .contact-container {
      max-width: 700px;
      background-color: #fff;
      border: 2px solid #e89ecb;
      border-radius: 15px;
      padding: 40px;
      margin: 60px auto;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    h2 {
      color: #b3006b;
      font-family: 'Playfair Display', serif;
      text-align: center;
      margin-bottom: 30px;
    }

    .btn-primary {
      background-color: #541a52;
      border: none;
    }

    .btn-primary:hover {
      background-color: #6f2d6e;
    }

    .contact-info {
      margin-top: 40px;
      text-align: center;
      font-size: 18px;
      color: #333;
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
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="connect.php">Connect</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contact Form -->
<div class="contact-container">
  <h2>Connect With Us</h2>
  <form method="post" action="">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Your Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Your Message</label>
      <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary w-100">Send Message</button>
  </form>

  <!-- ✅ Contact Info -->
  <div class="contact-info">
    <p><strong>📧 Email:</strong> trandhive@gmail.com</p>
    <p><strong>📞 Phone:</strong> 03037118215</p>
  </div>
</div>

<!-- Footer -->
<footer>
  <p>&copy; <?= date('Y') ?> TrandHive | Designed by Sundas Latif</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
