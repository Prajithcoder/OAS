<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'student') {
        header("Location: student/dashboard.php");
    } else {
        header("Location: teacher/dashboard.php");
    }
    exit();
}
?>

<h1>Welcome to Assignment Submission Portal</h1>
<a href="auth/register.php">Register</a>
<a href="auth/login.php">Login</a>
