<?php
//books from .json
$booksFile = 'books.json';
$books = [];

if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true) ?? [];
}

//grabs book id
$id = $_GET['id'] ?? null;
$book = null;

//Matched book
if ($id !== null) {
    foreach ($books as $b) {
        if ($b['id'] == $id) {
            $book = $b;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details</title>

  <!--Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!--Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="browse.php">Browse</a></li>
        <li class="nav-item"><a class="nav-link" href="add_book.php">Add Book</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--Page Content -->
<div class="container my-5">
  <?php if ($book): ?>
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
      <div class="card-body">
        <h3 class="card-title mb-3"><?php echo htmlspecialchars($book['title']); ?></h3>
        <h5 class="card-subtitle mb-3 text-muted"><?php echo htmlspecialchars($book['author']); ?></h5>

        <?php if (!empty($book['genre'])): ?>
          <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
        <?php endif; ?>

        <a href="browse.php" class="btn btn-secondary mt-3">Back to Browse</a>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-danger text-center">
      Book not found. <a href="browse.php" class="alert-link">Return to Browse</a>
    </div>
  <?php endif; ?>
</div>

<!--Footer -->
<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">&copy; <?php echo date("Y"); ?> MyShelf</p>
</footer>

<!--Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>