<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assignment_id = $_POST['assignment_id'];
    $marks = $_POST['marks'];

    $stmt = $conn->prepare("UPDATE assignments SET marks = ?, reviewed = 1 WHERE id = ?");
    $stmt->bind_param("ii", $marks, $assignment_id);
    $stmt->execute();
    $stmt->close();

    header("Location: marks.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Assignment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md text-center max-w-md">
        <h2 class="text-2xl font-semibold mb-4">🏆 Grade Assignment</h2>
        <form method="POST">
            <input type="hidden" name="assignment_id" value="<?= $_GET['assignment_id'] ?>">
            <input type="number" name="marks" min="0" max="100" required placeholder="Enter marks" class="w-full p-3 border rounded-lg mb-4">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Submit Marks</button>
        </form>
    </div>
</body>
</html>
