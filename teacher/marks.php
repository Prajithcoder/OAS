<?php
session_start();
require '../config/db.php';

// Check if the user is a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch assignments that need grading
$sql = "SELECT * FROM assignments WHERE status = 'submitted'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);  // Debugging
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments to Grade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assignments to Grade</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border p-3">Assignment ID</th>
                    <th class="border p-3">Student Name</th>
                    <th class="border p-3">Submission Date</th>
                    <th class="border p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="text-center bg-gray-50 hover:bg-gray-100">
                    <td class="border p-3"><?= $row['id'] ?></td>
                    <td class="border p-3"><?= $row['student_name'] ?></td>
                    <td class="border p-3"><?= $row['submission_date'] ?></td>
                    <td class="border p-3">
                        <a href="grade.php?assignment_id=<?= $row['id'] ?>" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Grade</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
