<?php
require '../config/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notifications WHERE user_id = $user_id AND status = 'unread'";
$result = $conn->query($sql);

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// Mark notifications as read
$conn->query("UPDATE notifications SET status = 'read' WHERE user_id = $user_id");

$conn->close();

foreach ($notifications as $note) {
    echo "<p>" . $note['message'] . "</p>";
}
?>
