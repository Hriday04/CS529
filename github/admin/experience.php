<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../db.php';

$result = $conn->query("SELECT * FROM experience ORDER BY start_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Experience</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Manage Experience</h1>

        <div class="admin-links">
            <a href="/github/index.php" class="admin-button">View Website</a>
            <a href="/github/admin/dashboard.php" class="admin-button">Back to Dashboard</a>
            <a href="add_experience.php" class="admin-button">Add Experience</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($exp = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($exp['title']) ?></td>
                    <td><?= htmlspecialchars($exp['company']) ?></td>
                    <td>
                        <a href="edit_experience.php?id=<?= $exp['id'] ?>">Edit</a>
                        <a href="delete_experience.php?id=<?= $exp['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
