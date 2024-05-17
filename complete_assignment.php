<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['assignment_id'])) {
        $assignment_id = $_POST['assignment_id'];
        $date_completed = date('Y-m-d H:i:s');
        
        $sql = "UPDATE Assignments SET status='completed', date_completed='$date_completed' WHERE assignment_id='$assignment_id'";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Assignment marked as completed.";
        } else {
            $_SESSION['error'] = "Error updating record: " . $conn->error;
        }
    } else {
        $_SESSION['error'] = "Invalid assignment ID.";
    }
    header("Location: profile.php");
    exit();
} else {
    header("Location: profile.php");
    exit();
}
?>
