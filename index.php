
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Book Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php include 'header.php'; ?>

<!-- Page content -->
<div class="container mt-5">
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="mb-4">Welcome to MyShelf</h1>
      <?php if (isset($_SESSION['user_email'])): ?>
          <p class="lead">Hello, <?= htmlspecialchars($_SESSION['user_email']); ?>! You’re logged in.</p>
      <?php else: ?>
          <p class="lead">Welcome! Please <a href="login.php">log in</a> or <a href="signup.php">create an account</a> to manage your books.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<p>Session email: <?= $_SESSION['user_email'] ?? 'none'; ?></p>


<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
