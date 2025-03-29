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
            <p class="text-green-600"><?= $success_message ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="text-red-600"><?= $error_message ?></p>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <p class="text-lg font-medium">Student: <span class="text-blue-600"><?= $row['student_name'] ?></span></p>
            <p class="mt-2"><a href="<?= $row['file_path'] ?>" target="_blank" class="text-blue-500 hover:text-blue-700">📄 View Assignment</a></p>

            <form method="POST" class="mt-4">
                <input type="hidden" name="assignment_id" value="<?= $row['id'] ?>">
                <label class="block text-gray-700">Enter Marks:</label>
                <input type="number" name="marks" class="w-full p-2 border rounded-md mt-1 focus:ring-2 focus:ring-blue-400" required>
                <button type="submit" class="w-full mt-3 bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit</button>
            </form>
        <?php else: ?>
            <p class="text-gray-600">Invalid assignment.</p>
        <?php endif; ?>

        <div class="mt-6">
            <a href="dashboard.php" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
