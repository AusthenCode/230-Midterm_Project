<?php
session_start();
require 'include/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // get user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // check if user exists + verify password
    if ($user && ($user['password'] === $password || password_verify($password, $user['password']))) {


        // set session values
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['is_admin'] = ($user['is_admin'] == 1);

        header("Location: index.php");
        exit;
    }

    $error = "Invalid email or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="col-md-6 mx-auto card p-4 shadow-sm">

    <h3 class="mb-3 text-center">Sign In</h3>

    <?php if(isset($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button class="btn btn-primary w-100">Login</button>

      <p class="mt-3 text-center">
        Don’t have an account? <a href="register.php">Sign up</a>
      </p>

    </form>

  </div>
</div>

</body>
</html>
