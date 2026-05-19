<?php
include "db.php";

$success = "";
$error = "";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $role = "user";

  $sql = "INSERT INTO user(name,email,password,phone,address,role)
          VALUES('$name','$email','$password','$phone','$address','$role')";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    $error = "Registration failed: {$conn->error}";
  } else {
    $success = "Registered successfully!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register | TrandHive</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Roboto&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fdf5f9;
    }

    .container {
      margin-top: 80px;
      max-width: 600px;
    }

    h2 {
      font-family: 'Playfair Display', serif;
      color: #541a52;
    }

    form {
      background-color: white;
      border: 1px solid #ffcce0;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    .btn-primary {
      background-color: #541a52;
      border: none;
    }

    .btn-primary:hover {
      background-color: #6f2d6e;
    }

    footer {
      margin-top: 60px;
      text-align: center;
      color: #999;
    }

    .back-link {
      display: inline-block;
      margin-top: 15px;
      color: #b3006b;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .form-label {
      font-weight: 500;
      color: #541a52;
    }

    .alert {
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">Create Your TrandHive Account</h2>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php elseif ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form action="register.php" method="post" onsubmit="return validateForm();">
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Create a password" required>
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="text" class="form-control" name="phone" id="phone" placeholder="03xx-xxxxxxx" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter your address" required></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
    </div>

    <a href="index.php" class="back-link">← Back to Shop</a>
  </form>
</div>

<footer>
  <p>© <?= date('Y') ?> TrandHive | Designed by WebTech Knowledge</p>
</footer>

<script>
  function validateForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    const phonePattern = /^03\d{2}-\d{7}$/;

    if (name === "" || email === "" || password === "" || phone === "" || address === "") {
      alert("All fields are required.");
      return false;
    }

    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    if (!phonePattern.test(phone)) {
      alert("Please enter a valid Pakistani phone number (e.g., 0300-1234567).");
      return false;
    }

    if (password.length < 6) {
      alert("Password must be at least 6 characters long.");
      return false;
    }

    return true;
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
