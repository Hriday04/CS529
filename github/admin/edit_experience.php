<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../db.php';

$id = intval($_GET['id']);
$exp = $conn->query("SELECT * FROM experience WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE experience SET title=?, company=?, location=?, start_date=?, end_date=?, description=? WHERE id=?");
    $stmt->bind_param("ssssssi", $_POST['title'], $_POST['company'], $_POST['location'], $_POST['start'], $_POST['end'], $_POST['description'], $id);
    $stmt->execute();
    header("Location: experience.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Experience</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Edit Experience</h1>

        <form method="POST" class="admin-form">
            <label>Title:</label>
            <input name="title" value="<?= htmlspecialchars($exp['title']) ?>" required>

            <label>Company:</label>
            <input name="company" value="<?= htmlspecialchars($exp['company']) ?>" required>

            <label>Location:</label>
            <input name="location" value="<?= htmlspecialchars($exp['location']) ?>">

            <label>Start Date:</label>
            <input type="date" name="start" value="<?= htmlspecialchars($exp['start_date']) ?>">

            <label>End Date:</label>
            <input type="date" name="end" value="<?= htmlspecialchars($exp['end_date']) ?>">

            <label>Description:</label>
            <textarea name="description"><?= htmlspecialchars($exp['description']) ?></textarea>

            <button type="submit" class="admin-button">Update</button>
        </form>

        <div class="admin-links" style="margin-top: 2rem;">
            <a href="/github/index.php" class="admin-button">View Webpage</a>
            <a href="experience.php" class="admin-button">Back to Experience</a>
            <a href="dashboard.php" class="admin-button">Admin Dashboard</a>
        </div>
    </div>
</body>
</html>
