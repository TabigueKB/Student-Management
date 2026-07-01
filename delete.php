<?php
session_start();
require_once "config/database.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid student ID.";
    header("Location: students.php");
    exit();
}

$id = (int) $_GET['id'];

// Check if student exists
$check = $conn->prepare("SELECT id FROM students WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Student not found.";
    header("Location: students.php");
    exit();
}

// Delete student
$delete = $conn->prepare("DELETE FROM students WHERE id = ?");
$delete->bind_param("i", $id);

if ($delete->execute()) {
    $_SESSION['success'] = "Student deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete student.";
}

header("Location: students.php");
exit();
?>