<?php
include '../include/admin_header.php';
require '../include/db.php';

// Only admins
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php");
    exit;
}
?>

<div class="container my-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Admin Dashboard</h2>
    <p class="text-muted">Manage users, books, and system content</p>
  </div>

  <div class="row g-4">

    <!-- USERS -->
    <div class="col-md-4">
      <div class="card shadow-lg border-0">
        <div class="card-body text-center">
          <h4 class="card-title mb-3">Manage Users</h4>
          <p class="text-muted">View and control user accounts</p>
          <a href="admin_users.php" class="btn btn-danger w-100">Open Users</a>
        </div>
      </div>
    </div>

    <!-- BOOKS -->
    <div class="col-md-4">
      <div class="card shadow-lg border-0">
        <div class="card-body text-center">
          <h4 class="card-title mb-3">Manage Books</h4>
          <p class="text-muted">Review and edit the book collection</p>
          <a href="admin_books.php" class="btn btn-danger w-100">Open Books</a>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include '../include/footer.php'; ?>
