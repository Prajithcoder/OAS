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
            WHERE assignments.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $assignment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
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
            <p class="text-green-600 mb-4"> <?= $success_message ?> </p>
        <?php elseif (isset($error_message)): ?>
            <p class="text-red-600 mb-4"> <?= $error_message ?> </p>
        <?php endif; ?>

        <?php if ($row): ?>
            <p class="text-gray-700 mb-2"><strong>Student:</strong> <?= htmlspecialchars($row['student_name']) ?></p>
            <p class="text-gray-700 mb-4">
                <strong>Assignment:</strong> 
                <a href="<?= htmlspecialchars($row['file_path']) ?>" class="text-blue-500 underline" target="_blank">View Submission</a>
            </p>

            <form method="post" class="space-y-4">
                <input type="hidden" name="assignment_id" value="<?= $row['id'] ?>">
                <label class="block">
                    <span class="text-gray-700">Marks</span>
                    <input type="number" name="marks" class="mt-1 block w-full p-2 border rounded-md" required>
                </label>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                    Submit Marks
                </button>
            </form>
        <?php else: ?>
            <p class="text-red-600">Invalid assignment ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>
