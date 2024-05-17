<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['id'];

    $sql = "DELETE FROM Rooms WHERE room_id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        echo "<script>alert('Room deleted successfully'); window.location.href='admin_panel.php';</script>";
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
