<?php
session_start();
include '../include/admin_header.php';
require '../include/db.php';

// must be admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

// Delete book
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_books.php");
    exit;
}

// Get all books
$result = mysqli_query($conn, "
    SELECT b.*, u.username 
    FROM books b 
    LEFT JOIN users u ON b.added_by = u.user_id 
    ORDER BY book_id DESC
");
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Books</h2>

    <table class="table table-striped table-hover shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Added By</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($book = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $book['book_id'] ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['genre']) ?></td>
                    <td><?= htmlspecialchars($book['username']) ?></td>
                    <td>
                        <a href="admin_edit_books.php?id=<?= $book['book_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="admin_books.php?delete=<?= $book['book_id'] ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../include/footer.php'; ?>
