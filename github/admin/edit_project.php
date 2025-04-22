<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../db.php';

$id = intval($_GET['id']);
$project = $conn->query("SELECT * FROM projects WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, tech_stack=?, link_code=?, link_demo=? WHERE id=?");
    $stmt->bind_param("sssssi", $_POST['title'], $_POST['description'], $_POST['tech'], $_POST['code'], $_POST['demo'], $id);
    $stmt->execute();
    header("Location: projects.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Edit Project</h1>

        <form method="POST" class="admin-form">
            <label>Title:</label>
            <input name="title" value="<?= htmlspecialchars($project['title']) ?>" required>

            <label>Description:</label>
            <textarea name="description"><?= htmlspecialchars($project['description']) ?></textarea>

            <label>Tech Stack:</label>
            <input name="tech" value="<?= htmlspecialchars($project['tech_stack']) ?>">

            <label>GitHub Link:</label>
            <input name="code" value="<?= htmlspecialchars($project['link_code']) ?>">

            <label>Live Demo Link:</label>
            <input name="demo" value="<?= htmlspecialchars($project['link_demo']) ?>">

            <button type="submit" class="admin-button">Update</button>
        </form>

        <div class="admin-links" style="margin-top: 2rem;">
            <a href="/github/index.php" class="admin-button">View Webpage</a>
            <a href="projects.php" class="admin-button">Back to Projects</a>
            <a href="/github/admin/dashboard.php" class="admin-button">Admin Dashboard</a>
        </div>
    </div>
</body>
</html>
