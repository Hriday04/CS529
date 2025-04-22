<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require '../db.php';

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $company = $_POST['company'] ?? '';
    $location = $_POST['location'] ?? '';
    $start = $_POST['start'] ?? '';
    $end = $_POST['end'] ?? '';
    $desc = $_POST['description'] ?? '';

    $stmt = $conn->prepare("INSERT INTO experience (title, company, location, start_date, end_date, description) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        $error = "Prepare failed: " . $conn->error;
    } else {
        $stmt->bind_param("ssssss", $title, $company, $location, $start, $end, $desc);
        if ($stmt->execute()) {
            $success = "Experience added successfully!";
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
    <title>Add Experience</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <h1>Add Experience</h1>

        <?php if ($success): ?>
            <p class="success-msg"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="error-msg"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" class="admin-form">
            <label>Title:</label>
            <input name="title" required>

            <label>Company:</label>
            <input name="company" required>

            <label>Location:</label>
            <input name="location">

            <label>Start Date:</label>
            <input type="date" name="start">

            <label>End Date:</label>
            <input type="date" name="end">

            <label>Description:</label>
            <textarea name="description"></textarea>

            <button type="submit" class="admin-button">Add Experience</button>
        </form>

        <div class="admin-links" style="margin-top: 2rem;">
            <a href="/github/index.php" class="admin-button">View Webpage</a>
            <a href="experience.php" class="admin-button">Back to Experience</a>
            <a href="dashboard.php" class="admin-button">Admin Dashboard</a>
        </div>
    </div>
</body>
</html>
