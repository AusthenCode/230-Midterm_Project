<?php
//load books from the .json file
$booksFile = 'books.json';
$books = [];

if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true) ?? [];
}

//search capability
$search = $_GET['search'] ?? '';
if ($search) {
    $books = array_filter($books, function($book) use ($search) {
        return stripos($book['title'], $search) !== false ||
               stripos($book['author'], $search) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Books</title>

  <!--Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!--Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">My Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="browse.php">Browse</a></li>
        <li class="nav-item"><a class="nav-link" href="add_book.php">Add Book</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--Page Header -->
<div class="container my-5">
  <h2 class="text-center mb-4">Browse Book Collection</h2>

  <!--Search Form -->
  <form method="GET" class="d-flex justify-content-center mb-4">
    <input type="text" name="search" class="form-control w-50" placeholder="Search by title or author..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit" class="btn btn-primary ms-2">Search</button>
  </form>

  <!--Book List -->
  <div class="row">
    <?php foreach ($books as $book): ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($book['author']); ?></h6>
            <?php if (!empty($book['genre'])): ?>
              <p class="card-text"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
            <?php endif; ?>
            <a href="book_detail.php?id=<?php echo $book['id']; ?>" class="btn btn-outline-primary btn-sm">View Details</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!--Footer -->
<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">&copy; <?php echo date("Y"); ?> MyShelf</p>
</footer>

<!--Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>