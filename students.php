<?php
session_start();
require_once "config/database.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Search
$search = "";

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {

    $search = trim($_GET['search']);

    $stmt = $conn->prepare("
        SELECT * FROM students
        WHERE fullname LIKE ?
        OR course LIKE ?
        OR email LIKE ?
        ORDER BY id DESC
    ");

    $keyword = "%".$search."%";

    $stmt->bind_param("sss", $keyword, $keyword, $keyword);

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $result = $conn->query("
        SELECT *
        FROM students
        ORDER BY id DESC
    ");

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Students</title>

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

<!-- Main Content -->

<div class="content">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>

Student List

</h2>

<a href="create.php" class="btn btn-primary">

<i class="fa-solid fa-plus"></i>

Add Student

</a>

</div>

<?php

if(isset($_SESSION['success'])){

?>

<div class="alert alert-success alert-dismissible fade show">

<?= $_SESSION['success']; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php

unset($_SESSION['success']);

}

if(isset($_SESSION['error'])){

?>

<div class="alert alert-danger alert-dismissible fade show">

<?= $_SESSION['error']; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php

unset($_SESSION['error']);

}

?>

<form method="GET" class="mb-4">

<div class="input-group">

<input
type="text"
name="search"
class="form-control"
placeholder="Search student..."
value="<?= htmlspecialchars($search) ?>">

<button class="btn btn-primary">

Search

</button>

</div>

</form>

<div class="card shadow">

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>ID</th>

<th>Full Name</th>

<th>Course</th>

<th>Year</th>

<th>Email</th>

<th>Phone</th>

<th width="180">Actions</th>

</tr>

</thead>

<tbody>

<?php

if($result->num_rows>0){

while($row=$result->fetch_assoc()){

?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= htmlspecialchars($row['fullname']); ?></td>

<td><?= htmlspecialchars($row['course']); ?></td>

<td><?= htmlspecialchars($row['year_level']); ?></td>

<td><?= htmlspecialchars($row['email']); ?></td>

<td><?= htmlspecialchars($row['phone']); ?></td>

<td>

<a
href="edit.php?id=<?= $row['id']; ?>"
class="btn btn-warning btn-sm">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="delete.php?id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this student?');">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" class="text-center">

No students found.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>