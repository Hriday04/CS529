<?php
session_start();
require '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$result = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Projects - Admin</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Manage Projects</h1>

        <div class="admin-links">
            <a href="/github/index.php" class="admin-button">View Website</a>
            <a href="/github/admin/dashboard.php" class="admin-button">Back to Dashboard</a>
            <a href="add_project.php" class="admin-button">Add Project</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr><th>Title</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td>
                        <a href="edit_project.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete_project.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this project?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
