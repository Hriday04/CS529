<?php
session_start();
if ($_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }
require '../db.php';

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM experience WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: experience.php");
exit();
?>
