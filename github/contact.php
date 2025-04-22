<?php
session_start();

$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "portfolio_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        header("Location: index.php?message=sent#contact");
        exit();
    } else {
        error_log("Contact form error: " . $stmt->error);
        header("Location: index.php?message=error#contact");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
