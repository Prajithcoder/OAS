<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch pending assignments count
$sql = "SELECT COUNT(*) AS pending_count FROM assignments WHERE status = 'pending'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$pending_count = $row['pending_count'];
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        }
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
    <nav class="bg-white dark:bg-gray-800 shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold">Teacher Dashboard</h1>
        <div>
            <button onclick="toggleDarkMode()" class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600">🌙 Toggle Dark Mode</button>
        </div>
    </nav>
    
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Welcome, Teacher!</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="review.php" class="p-4 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
                📄 Review Assignments (<?= $pending_count ?> Pending)
            </a>
            <a href="history.php" class="p-4 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600">
                📜 Reviewed Assignments
            </a>
            <a href="../auth/logout.php" class="p-4 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600">
                🚪 Logout
            </a>
        </div>
    </div>
</body>
</html>
