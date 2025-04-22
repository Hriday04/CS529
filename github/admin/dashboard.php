<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Hriday Raj</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Admin Dashboard</h1>
        <p class="welcome-msg">Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

        <div class="admin-links">
            <a href="/github/index.php" class="admin-button">Home</a>
            <a href="projects.php" class="admin-button">Manage Projects Section</a>
            <a href="experience.php" class="admin-button">Manage Experience Section</a>
            <a href="manage_users.php" class="admin-button">Manage Users</a>
            <a href="../logout.php" class="admin-button logout">Logout</a>
            <a href="view_messages.php" class="admin-button">View Messages</a>
        </div>
    </div>
</body>
</html>
