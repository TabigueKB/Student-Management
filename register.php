<?php
session_start();
require_once("config/database.php");

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $pass = $_POST['pass'];
    $confirmPass = $_POST['confirmPass'];
}
if (empty($fullname)|| empty($email) || empty($pass) || empty($confirmPass)) {
    $message = "All fields are required. ";
    $messageType = "danger";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Invalid email address. ";
    $messageType = "danger";
}
elseif ($pass != $confirmPass) {
    $message = "Passwords do not match. ";
    $messageType = "danger";
}
elseif (strlen($pass) < 8) {
    $message = "Password must be at least 8 characters. ";
    $messageType = "danger";
}
else {
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Email already exists. ";
        $messageType = "warning";

    } else {
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $insert = $conn->prepare("
        INSERT INTO users(fullname, email, pass) VALUES(?,?,?)");
        $insert->bind_param("sss",
        $fullname,
        $email,
        $hashedPass
    );
    if ($insert->execute()) {
    $_SESSION['success'] = "Registration successful. Please Login in";
    header("Location: login.php");
    exit();

    } else {
        $message = "Registration failed. ";
        $messageType = "danger";
    }

    }
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content"width=device-width, initial-scaled=1">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    
    </head>
    <body>
        <div class="auth-container">
            <div class ="auth-card">
                <h2 class="auth-title">Student Management</h2>
                <h5 class="text-center mb-4">Create Account</h5>
                <?php if($message!= "") { ?> 
                <div class = "alert alert-<?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div>
                <?php } ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class ="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="pass" name="pass" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="pass" name="confirmPass" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-custom">Register</button>
                </form>
                <div class="auth-link">
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </body>
</html>  