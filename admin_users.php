<?php
session_start();

if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

$usersFile = __DIR__ . '/data/users.json';
$users = json_decode(file_get_contents($usersFile), true) ?? [];

include 'header.php';
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Manage Users</h2>
  <?php if (empty($users)): ?>
    <p class="text-center">No users found.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Email</th>
          <th>Registered</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['created_at'] ?? '—' ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
