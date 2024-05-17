<?php
include 'db.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update user details in the database
    $sql = "UPDATE Users SET username='$username', full_name='$full_name', email='$email', role='$role' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the admin panel page with a success message
        header("Location: admin_panel.php?success=User updated successfully");
        exit();
    } else {
        // Redirect back to the admin panel page with an error message
        header("Location: admin_panel.php?error=Error updating user: " . $conn->error);
        exit();
    }
} else {
    // Redirect back to the admin panel page with an error message
    header("Location: admin_panel.php?error=Form data not submitted");
    exit();
}
?>
