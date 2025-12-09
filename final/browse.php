<?php
include 'include/header.php';
require 'include/db.php';

// default search
$search = $_GET['search'] ?? '';

$sql = "SELECT b.*, u.username 
        FROM books b
        LEFT JOIN users u ON b.added_by = u.user_id";

// apply search
if ($search) {
    $sql .= " WHERE b.title LIKE ? OR b.author LIKE ?";
}

$stmt = $conn->prepare($sql);

// bind search values if needed
if ($search) {
    $term = "%$search%";
    $stmt->bind_param("ss", $term, $term);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <h2 class="text-center mb-4">Browse Book Collection</h2>

  <!-- Search Form -->
  <form method="GET" class="d-flex justify-content-center mb-4">
    <input type="text" name="search" class="form-control w-50" placeholder="Search by title or author..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit" class="btn btn-primary ms-2">Search</button>
  </form>

  <div class="row">
    <?php while ($book = $result->fetch_assoc()): ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($book['author']) ?></h6>

            <?php if (!empty($book['genre'])): ?>
              <p><strong>Genre:</strong> <?= htmlspecialchars($book['genre']) ?></p>
            <?php endif; ?>

            <p class="text-muted"><small>Added by: <?= htmlspecialchars($book['username']) ?></small></p>

            <a href="book_detail.php?id=<?= $book['book_id'] ?>" class="btn btn-outline-primary btn-sm">View Details</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'include/footer.php'; ?>
</body>
</html>
