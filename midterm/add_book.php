<?php 
include 'include/header.php'; 
require 'include/db.php';  

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $genre = trim($_POST['genre']);
    $added_by = $_SESSION['user_id'];  // user who added

    $stmt = $conn->prepare("
        INSERT INTO books (title, author, genre, added_by)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("sssi", $title, $author, $genre, $added_by);

    if ($stmt->execute()) {
        header("Location: browse.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Database error: " . $conn->error . "</div>";
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

<?php include 'include/footer.php'; ?>
