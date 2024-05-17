<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <?php
        include 'db.php';
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        // Check if the user role is set in the session
        if (!isset($_SESSION['role'])) {
            // Handle if role is not set
            $_SESSION['error'] = "User role not found.";
            header("Location: login.php");
            exit();
        }




        // Check if user ID is provided in the URL
        if(isset($_GET['id'])) {
            $user_id = $_GET['id'];

            // Fetch user details from the database
            $sql = "SELECT * FROM Users WHERE user_id = $user_id";
            $result = $conn->query($sql);

            // Check if user exists
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display the form to edit user details
        ?>
        <form method="POST" action="update_user.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="admin" <?php if($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="cleaner" <?php if($row['role'] == 'cleaner') echo 'selected'; ?>>Cleaner</option>
                    <option value="student" <?php if($row['role'] == 'student') echo 'selected'; ?>>Student</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        <?php
            } else {
                echo "User not found.";
            }
        } else {
            echo "User ID not provided.";
        }
        ?>
    </div>
</body>
</html>
