<?php
include 'db.php';

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete user from the database
    $sql = "DELETE FROM Users WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the user list page with a success message
        header("Location: admin_panel.php?success=User deleted successfully");
        exit();
    } else {
        // Redirect back to the user list page with an error message
        header("Location: admin_panel.php?error=Error deleting user: " . $conn->error);
        exit();
    }
} else {
    // Redirect back to the user list page with an error message
    header("Location: admin_panel.php?error=User ID not provided");
    exit();
}
?>
