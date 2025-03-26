<?php
session_start();
require '../config/db.php';

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
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "File upload failed!";
    }
}

$conn->close();
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="assignment" required>
    <button type="submit">Submit</button>
</form>
