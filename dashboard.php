<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SESSION['role'] == 'student') {
    header("Location: student/dashboard.php");
} else {
    header("Location: teacher/dashboard.php");
}
exit();
?>
