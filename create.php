<?php
session_start();
require_once "config/database.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname   = trim($_POST['fullname']);
    $course     = trim($_POST['course']);
    $year_level = trim($_POST['year_level']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);

    if (
        empty($fullname) ||
        empty($course) ||
        empty($year_level) ||
        empty($email) ||
        empty($phone)
    ) {

        $message = "Please fill in all fields.";
        $messageType = "danger";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Invalid email address.";
        $messageType = "danger";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO students
            (fullname, course, year_level, email, phone)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssss",
            $fullname,
            $course,
            $year_level,
            $email,
            $phone
        );

        if ($stmt->execute()) {

            $_SESSION['success'] = "Student added successfully.";

            header("Location: students.php");
            exit();

        } else {

            $message = "Failed to save student.";
            $messageType = "danger";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<!-- Sidebar -->

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

<!-- Content -->

<div class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>

<i class="fa-solid fa-user-plus"></i>

Add Student

</h3>

</div>

<div class="card-body">

<?php if($message!=""){ ?>

<div class="alert alert-<?= $messageType ?>">

<?= $message ?>

</div>

<?php } ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Full Name</label>

<input
type="text"
name="fullname"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Course</label>

<input
type="text"
name="course"
class="form-control"
placeholder="BSIT"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Year Level</label>

<select
name="year_level"
class="form-select"
required>

<option value="">Select Year</option>

<option>1st Year</option>

<option>2nd Year</option>

<option>3rd Year</option>

<option>4th Year</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Phone Number</label>

<input
type="text"
name="phone"
class="form-control"
required>

</div>

</div>

<div class="mt-4">

<button
type="submit"
class="btn btn-success">

<i class="fa-solid fa-floppy-disk"></i>

Save Student

</button>

<a
href="students.php"
class="btn btn-secondary">

Cancel

</a>

</div>

</form>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>