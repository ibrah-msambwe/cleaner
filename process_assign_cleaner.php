<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get cleaner ID, room ID, and date assigned from the form
    $cleaner_id = $_POST['cleaner_id'];
    $room_id = $_POST['room_id'];
    $date_assigned = date("Y-m-d"); // Get the current date

    // Check if the assignment already exists
    $check_sql = "SELECT * FROM Assignments WHERE cleaner_id = '$cleaner_id' AND room_id = '$room_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Assignment already exists
        $_SESSION['error'] = "This cleaner is already assigned to the selected room.";
        header("Location: assign_cleaner.php");
        exit();
    } else {
        // Insert the assignment into the database
        $insert_sql = "INSERT INTO Assignments (cleaner_id, room_id, date_assigned) VALUES ('$cleaner_id', '$room_id', '$date_assigned')";
        if ($conn->query($insert_sql) === TRUE) {
            // Assignment successful
            $_SESSION['success'] = "Cleaner assigned to room successfully.";
            header("Location: assign_cleaner.php");
            exit();
        } else {
            // Error in SQL query
            $_SESSION['error'] = "Error assigning cleaner to room: " . $conn->error;
            header("Location: assign_cleaner.php");
            exit();
        }
    }
} else {
    // If the request method is not POST
    $_SESSION['error'] = "Invalid request method.";
    header("Location: assign_cleaner.php");
    exit();
}
?>
