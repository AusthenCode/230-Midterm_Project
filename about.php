<?php
$content = file_get_contents("data/about.txt");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About - My Book Collection</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4 text-center">About</h1>
    <div class="card shadow-sm p-4">
      <p><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
  </div>
</body>
</html>
