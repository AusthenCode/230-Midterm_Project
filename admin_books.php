<?php
session_start();

if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

$booksFile = __DIR__ . '/data/books.json';
$books = json_decode(file_get_contents($booksFile), true) ?? [];

// handle delete
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $books = array_filter($books, fn($book) => $book['id'] !== $id);
    file_put_contents($booksFile, json_encode(array_values($books), JSON_PRETTY_PRINT));
    header("Location: admin_books.php");
    exit;
}

include 'header.php';
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Manage Books</h2>
  <?php if (empty($books)): ?>
    <p class="text-center">No books found.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book): ?>
          <tr>
            <td><?= htmlspecialchars($book['title']) ?></td>
            <td><?= htmlspecialchars($book['author']) ?></td>
            <td><?= htmlspecialchars($book['genre']) ?></td>
            <td>
              <a href="?delete=<?= $book['id'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
