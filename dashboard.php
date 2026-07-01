<?php
session_start();
require_once "config/database.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Count students
$studentQuery = $conn->query("SELECT COUNT(*) AS total FROM students");
$studentCount = $studentQuery->fetch_assoc()['total'];

// Count users
$userQuery = $conn->query("SELECT COUNT(*) AS total FROM users");
$userCount = $userQuery->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

<h2 class="text-center mb-4">

<i class="fa-solid fa-graduation-cap"></i><br>

Student MS

</h2>

<hr>

<a href="dashboard.php" class="text-white d-block mb-3 text-decoration-none">
<i class="fa-solid fa-house"></i>
 Dashboard
</a>

<a href="students.php" class="text-white d-block mb-3 text-decoration-none">
<i class="fa-solid fa-users"></i>
 Students
</a>

<a href="create.php" class="text-white d-block mb-3 text-decoration-none">
<i class="fa-solid fa-user-plus"></i>
 Add Student
</a>

<a href="logout.php" class="text-white d-block text-decoration-none">
<i class="fa-solid fa-right-from-bracket"></i>
 Logout
</a>

</div>

<div class="content">

<div class="container-fluid">

<h2 class="mb-4">

Welcome,

<?= htmlspecialchars($_SESSION['fullname']) ?>

👋

</h2>

<div class="row">

<div class="col-md-6">

<div class="card bg-primary text-white mb-4 shadow">

<div class="card-body">

<h5>Total Students</h5>

<h1><?= $studentCount ?></h1>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card bg-success text-white mb-4 shadow">

<div class="card-body">

<h5>Registered Users</h5>

<h1><?= $userCount ?></h1>

</div>

</div>

</div>

</div>

<div class="card shadow">

<div class="card-body">

<h3>Student Management System</h3>

<hr>

<p>

Welcome to your dashboard.

Use the sidebar to manage student records.

</p>

<a href="students.php" class="btn btn-primary">

Manage Students

</a>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>