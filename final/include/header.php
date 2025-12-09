<?php
// Start session if it hasn't started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Book Collection</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex: 1;
    }
  </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">MyShelf</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="browse.php">Browse Books</a></li>
      </ul>

      <ul class="navbar-nav">
        <?php if (isset($_SESSION['user_email'])): ?>
            <li class="nav-item"><a class="nav-link" href="add_book.php">Add Book</a></li>

            <!-- Admin Dashboard link -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <li class="nav-item"><a class="nav-link" href="admin/admin.php">Admin Dashboard</a></li>
            <?php endif; ?>

            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<main class="container mt-5">
