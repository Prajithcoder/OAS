<?php
session_start();
require '../config/db.php';
require '../config/mail.php'; // Include email function

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['user_id'];
    $file_name = $_FILES['assignment']['name'];
    $file_tmp = $_FILES['assignment']['tmp_name'];
    $upload_dir = "../uploads/";

    if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
        $file_path = $upload_dir . $file_name;

        $stmt = $conn->prepare("INSERT INTO assignments (student_id, file_path) VALUES (?, ?)");
        $stmt->bind_param("is", $student_id, $file_path);

        if ($stmt->execute()) {
            echo "Assignment submitted!";

            // Notify teacher via email
            $teacher_email = "teacher-email@gmail.com"; // Replace with actual teacher's email
            $subject = "New Assignment Submission";
            $body = "A student has submitted an assignment. <br> <a href='http://yourwebsite.com/teacher/review.php'>Review Now</a>";
            sendEmail($teacher_email, $subject, $body);
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "File upload failed!";
    }
}

$conn->close();
?>
