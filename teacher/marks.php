<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assignment_id = $_POST['assignment_id'];
    $marks = $_POST['marks'];
    $teacher_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE assignments SET marks = ?, status = 'reviewed', teacher_id = ? WHERE id = ?");
    $stmt->bind_param("iii", $marks, $teacher_id, $assignment_id);
    
    if ($stmt->execute()) {
        $success_message = "Marks assigned successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch assignment details
if (isset($_GET['id'])) {
    $assignment_id = $_GET['id'];
    $sql = "SELECT assignments.id, users.name AS student_name, assignments.file_path 
            FROM assignments 
            JOIN users ON assignments.student_id = users.id 
            WHERE assignments.id = $assignment_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Marks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-lg w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assign Marks</h2>

        <?php if (isset($success_message)): ?>
            <p class="text-green
