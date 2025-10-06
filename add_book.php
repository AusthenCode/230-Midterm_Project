<?php
$booksFile = 'books.json';

//loads books already in file
$books = [];
if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true) ?? [];
}

//form for adding a book
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $genre = trim($_POST['genre'] ?? '');

    if ($title && $author) {
        $newBook = [
            'id' => count($books) + 1,
            'title' => $title,
            'author' => $author,
            'genre' => $genre
        ];

        $books[] = $newBook;
        file_put_contents($booksFile, json_encode($books, JSON_PRETTY_PRINT));

        // Redirect to browse page after saving your book
        header('Location: browse.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add a Book</title>

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
        <li class="nav-item"><a class="nav-link" href="browse.php">Browse</a></li>
        <li class="nav-item"><a class="nav-link active" href="add_book.php">Add Book</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--Page Content -->
<div class="container my-5">
  <h2 class="text-center mb-4">Add a New Book</h2>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
          <label for="title" class="form-label">Book Title</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" class="form-control" id="author" name="author" required>
        </div>

        <div class="mb-3">
          <label for="genre" class="form-label">Genre</label>
          <input type="text" class="form-control" id="genre" name="genre">
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Book</button>
      </form>
    </div>
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