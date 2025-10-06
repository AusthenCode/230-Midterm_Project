<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Book Collection - MyShelf</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .hero {
      background: url('images/library-banner.jpg') center/cover no-repeat;
      color: white;
      text-shadow: 1px 1px 3px black;
      padding: 100px 0;
      text-align: center;
    }
  </style>
</head>
<body>

<!--Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">My Library</a>
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

<!--Hero -->
<section class="hero">
  <div class="container">
    <h1 class="display-5 fw-bold">Welcome to MyShelf</h1>
    <p class="lead">Easily track and organize all the books you love to read.</p>
    <form action="browse.php" method="GET" class="d-flex justify-content-center mt-4">
      <input type="text" name="search" class="form-control w-50" placeholder="Search books by title or author...">
      <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>
  </div>
</section>

<!--Info -->
<div class="container text-center my-5">
  <h2>About This App</h2>
  <p class="text-muted">
    This online library helps you personalize your book shelf.  
    Add, browse, and manage your favorite books all in one place.
  </p>
  <div class="d-flex justify-content-center mt-4 gap-3">
    <a href="add_book.php" class="btn btn-success">Add a New Book</a>
    <a href="browse.php" class="btn btn-outline-primary">Browse your Library</a>
  </div>
</div>

<!--Footer -->
<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">&copy; <?php echo date("Y"); ?> My Book shelf</p>
  <a href="faq.php" class="text-white">FAQs</a> |
  <a href="contact.php" class="text-white">Contact</a>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>