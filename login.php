<?php
include "db.php";
session_start();

$login_error = "";

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] == $password) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_role'] = $row['role'];

      if ($_SESSION['user_role'] == "admin") {
        header("Location: admin/dashboard.php");
      } else {
        header("Location: index.php");
      }
      exit();
    } else {
      $login_error = "Incorrect password. Please try again.";
    }
  } else {
    $login_error = "No account found. Please register first.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | TrandHive</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Roboto&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fdf5f9;
    }

    .container {
      max-width: 400px;
      margin-top: 100px;
    }

    h2 {
      font-family: 'Playfair Display', serif;
      color: #541a52;
      text-align: center;
      margin-bottom: 30px;
    }

    form {
      background-color: white;
      border: 1px solid #ffcce0;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    .form-label {
      font-weight: 500;
      color: #541a52;
    }

    .form-control {
      border-radius: 12px;
    }

    .btn-primary {
      background-color: #541a52;
      border: none;
    }

    .btn-primary:hover {
      background-color: #6f2d6e;
    }

    .signup-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #b3006b;
      text-decoration: none;
    }

    .signup-link:hover {
      text-decoration: underline;
    }

    footer {
      margin-top: 80px;
      text-align: center;
      color: #999;
    }

    .alert {
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Welcome Back to TrandHive</h2>

    <?php if ($login_error): ?>
      <div class="alert alert-danger"><?= $login_error ?></div>
    <?php endif; ?>

    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
      </div>

      <div class="d-grid">
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
      </div>

      <a class="signup-link" href="register.php">Don't have an account? Sign up here</a>
    </form>
  </div>

  <footer>
    <p>© <?= date('Y') ?> TrandHive | Designed by WebTech Knowledge</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
