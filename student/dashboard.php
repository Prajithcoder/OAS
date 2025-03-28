<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../dashboard.php");
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
<body class="bg-gray-100 min-h-screen">
    
    <!-- Navigation Bar -->
    <nav class="bg-blue-600 p-4 text-white shadow-md">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-semibold">Student Dashboard</h1>
            <div class="space-x-4">
                <a href="dashboard.php" class="hover:underline">🏠 Home</a>
                <a href="submit.php" class="hover:underline">📤 Submit Assignment</a>
                <a href="history.php" class="hover:underline">📜 Assignment History</a>
                <a href="../auth/logout.php" class="hover:underline text-red-300">🚪 Logout</a>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, Student!</h2>
        <p class="text-gray-600">You can submit assignments, check your assignment history, and manage your submissions.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <a href="submit.php" class="block p-4 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
                📤 Submit Assignment
            </a>
            <a href="history.php" class="block p-4 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600">
                📜 View Assignment History
            </a>
        </div>
    </div>
    
</body>
</html>
