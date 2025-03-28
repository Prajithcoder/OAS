<?php
session_start();

// Debugging session values before redirection
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    echo "Session not set! Redirecting to login...";
    header("Refresh: 2; URL=./auth/login.php"); // Redirect after 2 seconds
    exit();
}

// Debugging output
echo "Session Role: " . $_SESSION['role'] . "<br>";
echo "Session User ID: " . $_SESSION['user_id'] . "<br>";

// Redirecting based on role
if ($_SESSION['role'] == 'student') {
    header("Location: ./student/dashboard.php");
} elseif ($_SESSION['role'] == 'teacher') {
    header("Location: ./teacher/dashboard.php");
} else {
    echo "Invalid role detected!";
}

exit();
?>
