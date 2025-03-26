<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$sql = "SELECT file_path, status, marks, created_at FROM assignments WHERE student_id = $student_id ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-3xl w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assignment History</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="space-y-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                        <p class="text-lg font-medium">
                            📄 <a href="<?= htmlspecialchars($row['file_path']) ?>" target="_blank" class="text-blue-500 hover:text-blue-700">View Assignment</a>
                        </p>
                        <p class="text-gray-700 mt-1">
                            <strong>Status:</strong> 
                            <span class="<?= $row['status'] === 'reviewed' ? 'text-green-600' : 'text-yellow-600' ?>">
                                <?= ucfirst(htmlspecialchars($row['status'])) ?>
                            </span>
                        </p>
                        <p class="text-gray-700">
                            <strong>Marks:</strong> 
                            <?= $row['marks'] !== null ? "<span class='text-blue-600 font-semibold'>" . htmlspecialchars($row['marks']) . "</span>" : "Not yet graded" ?>
                        </p>
                        <p class="text-sm text-gray-500">📅 Submitted on: <?= date("F j, Y, g:i a", strtotime($row['created_at'])) ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600">No assignments submitted yet.</p>
        <?php endif; ?>

        <div class="mt-6">
            <a href="dashboard.php" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
