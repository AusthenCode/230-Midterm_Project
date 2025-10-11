<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === '' || $password === '') {
        $error = "Please fill in all fields.";
    } else {
        $usersFile = __DIR__ . '/data/users.json';
        $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

        // verifies if email is dup
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $error = "Email already registered.";
                break;
            }
        }

        // registers user
        if (!isset($error)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $users[] = [
                'id' => uniqid(),
                'email' => $email,
                'password' => $hashedPassword,
                'role' => 'user'
            ];
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
            
            $_SESSION['user'] = ['email' => $email, 'role' => 'user'];
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="col-md-6 mx-auto card p-4 shadow-sm">
    <h3 class="mb-3 text-center">Create an Account</h3>
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
      <button class="btn btn-primary w-100">Sign Up</button>
      <p class="mt-3 text-center">
        Already have an account? <a href="login.php">Log in here</a>
      </p>
    </form>
  </div>
</div>
</body>
</html>