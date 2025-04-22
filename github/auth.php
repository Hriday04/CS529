<?php
session_start();

$conn = new mysqli("localhost", "root", "", "portfolio_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: login.php?error=missing");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        header("Location: /github/admin/dashboard.php");
        exit();
    } else {
        
        header("Location: login.php?error=wrong_password");
        exit();
    }
} else {
    header("Location: login.php?error=user_not_found");
    exit();
}
?>

