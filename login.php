<?php
session_start();
require_once "config/database.php";

if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $pass = $_POST['pass'];
    
    if (empty($email) || empty($pass)) {
        $message = "Please enter your email and password. ";
        $messageType = "danger";
    } else {
        $stmt = $conn->prepare("SELECT id, fullname, email, pass FROM users WHERE email = ?");
        $stmt ->bind_param("s",$email);
        $stmt ->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($pass, $user['pass'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];

                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Incorrect Password. ";
                $messageType = "danger";
            }

        } else {
            $message = "Email does not exist. ";
            $messageType = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-card">
                <h2 class ="auth-title">Student Management</h2>
                <h5 class="text-center mb-4">Login</h5>

                <?php
                if (isset($_SESSION['success'])){
                    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div';
                    unset($_SESSION['success']);
                }
                ?>
                <?php if ($message != "") { ?>
                <div class="alert alert-<?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div> 
                <?php } ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="pass" name="pass" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="auth-link mt-3">Don't have an account?</div>
                <a href="register.php">Register</a>
            </div>
        </div>
    </body>
</html>