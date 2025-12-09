<?php
session_start();
require '../include/db.php';
include '../include/admin_header.php';

// must be admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

// promote user
if (isset($_GET['promote'])) {
    $id = intval($_GET['promote']);
    $stmt = $conn->prepare("UPDATE users SET is_admin = 1 WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_users.php");
    exit;
}

// delete user 
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    if ($id != $_SESSION['user_id']) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: admin_users.php");
    exit;
}

// get all users
$result = $conn->query("SELECT * FROM users ORDER BY user_id DESC");
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Users</h2>

    <table class="table table-striped table-hover shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Admin?</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($u = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $u['user_id'] ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= $u['is_admin'] ? "Yes" : "No" ?></td>

                    <td>
                        <?php if (!$u['is_admin']): ?>
                            <a href="admin_users.php?promote=<?= $u['user_id'] ?>" 
                               class="btn btn-sm btn-primary">Promote</a>
                        <?php endif; ?>

                        <?php if ($u['user_id'] != $_SESSION['user_id']): ?>
                            <a href="admin_users.php?delete=<?= $u['user_id'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this user?')">Delete</a>
                        <?php else: ?>
                            <span class="text-muted">You</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>

<?php include '../include/footer.php'; ?>
