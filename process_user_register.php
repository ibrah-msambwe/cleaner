<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password']; // Make sure to hash the password before storing it in the database
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role']; // Assuming the role is provided via the form

    // Hash the password using password_hash()
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert data into the 'users' table
    $sql = "INSERT INTO users (username, password, full_name, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $full_name, $email, $role);

    try {
        if ($stmt->execute()) {
            // Registration successful
            header("Location: admin_panel.php?success=1");
            exit();
        } else {
            // Error occurred
            header("Location: admin_panel.php?error=" . urlencode($conn->error));
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        // Duplicate entry error
        header("Location: admin_panel.php?error=Duplicate%20entry%20'".$username."'%20for%20key%20'username'");
        exit();
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
