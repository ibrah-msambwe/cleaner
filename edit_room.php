<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Room</h2>
        <?php
        include 'db.php';

        // Check if room ID is provided in the URL
        if (isset($_GET['id'])) {
            // Sanitize the room ID
            $room_id = mysqli_real_escape_string($conn, $_GET['id']);
            
            // Fetch room details from the database
            $sql = "SELECT * FROM Rooms WHERE room_id='$room_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $room_name = $row['room_name'];
                $room_location = $row['room_location'];
            } else {
                echo "Room not found";
                exit;
            }
        } else {
            echo "Room ID not provided";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize input to prevent SQL injection
            $room_id = mysqli_real_escape_string($conn, $_POST['room_id']);
            $room_name = mysqli_real_escape_string($conn, $_POST['room_name']);
            $room_location = mysqli_real_escape_string($conn, $_POST['room_location']);

            $sql = "UPDATE Rooms SET room_name='$room_name', room_location='$room_location' WHERE room_id='$room_id'";

            if ($conn->query($sql) === TRUE) {
                // Close the database connection
                $conn->close();
                // Redirect user to admin_panel.php after successful update
                header("Location: admin_panel.php");
                exit;
            } else {
                // Handle database error
                echo "Error updating record: " . $conn->error;
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="room_name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $room_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="room_location" class="form-label">Room Location</label>
                <input type="text" class="form-control" id="room_location" name="room_location" value="<?php echo $room_location; ?>" required>
            </div>
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>
    </div>
</body>
</html>
