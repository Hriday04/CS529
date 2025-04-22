<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../db.php';

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    if ($delete_id != $_SESSION['user_id']) {
        $conn->query("DELETE FROM users WHERE id = $delete_id");
    }
    header("Location: manage_users.php");
    exit();
}

$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Manage Users</h1>

        <div class="admin-links">
            <a href="dashboard.php" class="admin-button">Back to Dashboard</a>
            <a href="register_user.php" class="admin-button">Add User</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr><th>ID</th><th>Username</th><th>Role</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php while ($user = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="manage_users.php?delete=<?= $user['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
