<?php
$content = file_get_contents("data/contact.txt");

// Simple contact form handler (non-functional for now)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);
  $status = "Thank you, $name! Your message has been received.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact - My Book Collection</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4 text-center">Contact</h1>
    <div class="card shadow-sm p-4 mb-4">
      <p><?= nl2br(htmlspecialchars($content)) ?></p>
    </div>
    
    <form method="post" class="card shadow-sm p-4">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>

    <?php if (isset($status)): ?>
      <div class="alert alert-success mt-3"><?= $status ?></div>
    <?php endif; ?>

    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </div>
  </div>
</body>
</html>