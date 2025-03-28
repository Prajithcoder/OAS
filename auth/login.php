<?php
session_start();
require '../config/db.php'; // Ensure this points to your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Validate user credentials (Replace this with your actual DB query)
    $stmt = $conn->prepare("SELECT id, role, password FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password (assuming passwords are hashed)
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // 🔹 Redirect user based on role
            if ($user['role'] == "student") {
                header("Location: ../student/dashboard.php");
                exit();
            } elseif ($user['role'] == "teacher") {
                header("Location: ../teacher/dashboard.php");
                exit();
            } else {
                echo "Invalid user role!";
            }
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
