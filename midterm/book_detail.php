<?php
include 'include/header.php';
require 'include/db.php';

// Get book_id
$id = $_GET['id'] ?? null;

$book = null;

if ($id) {
    $stmt = $conn->prepare("
        SELECT b.*, u.username 
        FROM books b
        LEFT JOIN users u ON b.added_by = u.user_id
        WHERE b.book_id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $book = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
  <?php if ($book): ?>
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
      <div class="card-body">

        <h3 class="card-title mb-3"><?= htmlspecialchars($book['title']) ?></h3>
        <h5 class="card-subtitle mb-3 text-muted"><?= htmlspecialchars($book['author']) ?></h5>

        <?php if (!empty($book['genre'])): ?>
          <p><strong>Genre:</strong> <?= htmlspecialchars($book['genre']) ?></p>
        <?php endif; ?>

        <p class="text-muted">
          <small>Added by: <?= htmlspecialchars($book['username'] ?? 'Unknown') ?></small>
        </p>

        <a href="browse.php" class="btn btn-secondary mt-3">Back to Browse</a>

      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-danger text-center">
      Book not found. <a href="browse.php" class="alert-link">Return to Browse</a>
    </div>
  <?php endif; ?>
</div>

<?php include 'include/footer.php'; ?>

</body>
</html>
