<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch pending assignments
$sql = "SELECT assignments.id, users.name AS student_name, assignments.file_path 
        FROM assignments 
        JOIN users ON assignments.student_id = users.id 
        WHERE assignments.status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Assignments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pending Assignments</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="space-y-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-medium">Student: <span class="text-blue-600"><?= $row['student_name'] ?></span></p>
                        <div class="mt-2">
                            <a href="<?= $row['file_path'] ?>" target="_blank" class="text-blue-500 hover:text-blue-700">📄 View Assignment</a>
                            <a href="marks.php?id=<?= $row['id'] ?>" class="ml-4 text-green-500 hover:text-green-700">✏️ Assign Marks</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600">No pending assignments.</p>
        <?php endif; ?>

        <div class="mt-6">
            <a href="../auth/logout.php" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Logout</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
