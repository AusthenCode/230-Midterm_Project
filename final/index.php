<?php
include 'include/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Book Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: linear-gradient(135deg, #a83279, #d38312);
            color: white;
            padding: 80px 20px;
            border-radius: 15px;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-top: -50px;
            box-shadow: 0 10px 20px rgba(0,0,0,.1);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    
    <!-- Hero Section -->
    <div class="hero text-center shadow-sm">
        <h1>Welcome to MyShelf</h1>
        <p class="lead mt-3">
            Your personal book collection manager.
        </p>
    </div>

    <!-- Info Card -->
    <div class="info-card mx-auto text-center col-md-8">

      <?php if (isset($_SESSION['user_email'])): ?>
          <h4 class="mb-3">Hello, <?= htmlspecialchars($_SESSION['user_email']); ?></h4>
          <p class="text-muted">Stay tuned for more updates!</p>

          <div class="mt-4 d-flex justify-content-center gap-3">
              <a href="browse.php" class="btn btn-primary btn-lg">📚 Browse Books</a>
              <a href="add_book.php" class="btn btn-success btn-lg">➕ Add Book</a>

              <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                  <a href="admin/admin.php" class="btn btn-dark btn-lg">⚙️ Admin Dashboard</a>
              <?php endif; ?>
          </div>

      <?php else: ?>
          <h4 class="mb-3">Welcome!</h4>
          <p>Please log in or create an account to manage your bookshelf.</p>

          <div class="mt-4 d-flex justify-content-center gap-3">
              <a href="login.php" class="btn btn-primary btn-lg">Login</a>
              <a href="register.php" class="btn btn-outline-primary btn-lg">Sign Up</a>
          </div>

      <?php endif; ?>
    </div>

</div>

<?php include 'include/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
