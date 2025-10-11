<?php
session_start();

// restrict access
if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

include 'header.php';
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Admin Dashboard</h2>

  <div class="row">
    <div class="col-md-6">
      <div class="card p-3 mb-3 shadow-sm">
        <h4>Manage Books</h4>
        <a href="admin_books.php" class="btn btn-primary mt-2">View All Books</a>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-3 mb-3 shadow-sm">
        <h4>Manage Users</h4>
        <a href="admin_users.php" class="btn btn-primary mt-2">View All Users</a>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
