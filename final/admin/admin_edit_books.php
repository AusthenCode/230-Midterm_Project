<?php
session_start();
require '../include/db.php';

// Admin check
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

// Get book ID from URL
$book_id = intval($_GET['id'] ?? 0);

// Fetch book info
$stmt = $conn->prepare("SELECT * FROM books WHERE book_id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "<div class='alert alert-danger text-center mt-5'>Book not found. <a href='admin_books.php'>Back to Books</a></div>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $genre = trim($_POST['genre']);

    $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, genre = ? WHERE book_id = ?");
    $stmt->bind_param("sssi", $title, $author, $genre, $book_id);

    if ($stmt->execute()) {
        header("Location: admin_books.php");
        exit;
    } else {
        $error = "Database error. Please try again.";
    }
}
?>

<?php include '../include/admin_header.php'; ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Edit Book</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="col-md-6 mx-auto card p-4 shadow-sm">
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" name="genre" class="form-control" value="<?= htmlspecialchars($book['genre']) ?>">
            </div>
            <button class="btn btn-primary w-100">Update Book</button>
        </form>
        <a href="admin_books.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
    </div>
</div>

<?php include '../include/footer.php'; ?>
