<?php
session_start();
include('../config/db.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check user credentials
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role']; // 'student' or 'teacher'

            // Redirect based on user role
            if ($user['role'] == "student") {
                header("Location: ../student/dashboard.php");
            } elseif ($user['role'] == "teacher") {
                header("Location: ../teacher/dashboard.php");
            } else {
                echo "Invalid user role!";
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
