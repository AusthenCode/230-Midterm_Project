<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $usersFile = __DIR__ . '/data/users.json';
    $users = json_decode(file_get_contents($usersFile), true) ?? [];

    $found = false;

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $email;
            $_SESSION['is_admin'] = ($email === 'a@email.com'); // <-- set admin here
            $found = true;
            header("Location: index.php");
            exit;
        }
    }

    if (!$found) {
        $error = "Invalid email or password.";
    }
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
    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
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
        Don't have an account? <a href="register.php">Sign up here</a>
      </p>
    </form>
  </div>
</div>
</body>
</html>
