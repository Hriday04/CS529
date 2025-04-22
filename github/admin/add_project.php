<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized: You are not logged in as admin.");
}

require '../db.php';

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $desc = $_POST['description'] ?? '';
    $tech = $_POST['tech'] ?? '';
    $code = $_POST['code'] ?? '';
    $demo = $_POST['demo'] ?? '';

    $stmt = $conn->prepare("INSERT INTO projects (title, description, tech_stack, link_code, link_demo) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        $error = "Prepare failed: " . $conn->error;
    } else {
        $stmt->bind_param("sssss", $title, $desc, $tech, $code, $demo);
        if ($stmt->execute()) {
            $success = "Project added successfully!";
        } else {
            $error = "Execute failed: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Add a New Project</h1>

        <?php if ($success): ?>
            <p class="success-msg"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="error-msg"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" class="admin-form">
            <label>Title:</label>
            <input name="title" required>

            <label>Description:</label>
            <textarea name="description"></textarea>

            <label>Tech Stack:</label>
            <input name="tech">

            <label>GitHub Link:</label>
            <input name="code">

            <label>Live Demo Link:</label>
            <input name="demo">

            <button type="submit" class="admin-button">Submit</button>
        </form>

        <div class="admin-links" style="margin-top: 2rem;">
            <a href="/github/index.php" class="admin-button">View Webpage</a>
            <a href="dashboard.php" class="admin-button">Back to Admin</a>
            <a href="projects.php" class="admin-button">Back to Projects</a>
        </div>
    </div>
</body>
</html>
