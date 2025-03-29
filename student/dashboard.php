<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center">
        <h1 class="text-xl font-semibold">Student Dashboard</h1>
        <ul class="flex space-x-6">
            <li><a href="dashboard.php" class="hover:text-gray-300">🏠 Home</a></li>
            <li><a href="submit.php" class="hover:text-gray-300">📤 Submit Assignment</a></li>
            <li><a href="history.php" class="hover:text-gray-300">📜 Assignment History</a></li>
            <li><a href="../auth/logout.php" class="hover:text-gray-300">🚪 Logout</a></li>
        </ul>
    </nav>
    
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, Student!</h2>
        <p class="text-gray-600">Select an option below:</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Submit Assignment -->
            <a href="submit.php" class="block p-6 bg-blue-500 text-white text-center rounded-lg shadow-md hover:bg-blue-600">
                📤 Submit Assignment
            </a>
            
            <!-- Assignment History -->
            <a href="history.php" class="block p-6 bg-green-500 text-white text-center rounded-lg shadow-md hover:bg-green-600">
                📜 View Assignment History
            </a>
        </div>
    </div>
</body>
</html>
