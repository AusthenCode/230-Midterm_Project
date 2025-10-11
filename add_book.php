<?php include 'header.php'; ?>

<?php
// Make sure the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

$booksFile = __DIR__ . '/data/books.json'; // make sure it's inside /data folder

// Load existing books
$books = [];
if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true) ?? [];
}

// Handle form submission
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

        header('Location: browse.php');
        exit;
    }
}
?>

<div class="col-md-6 mx-auto card p-4 shadow-sm">
  <h3 class="mb-3 text-center">Add a Book</h3>
  <form method="POST">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="author" class="form-label">Author</label>
      <input type="text" name="author" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="genre" class="form-label">Genre</label>
      <input type="text" name="genre" class="form-control">
    </div>
    <button class="btn btn-primary w-100">Add Book</button>
  </form>
</div>

<?php include 'footer.php'; ?>