<?php
include 'db.php';

// Define variables to store notification message and type
$notification_message = '';
$notification_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $room_location = $_POST['room_location'];

    $sql = "INSERT INTO Rooms (room_name, room_location) VALUES ('$room_name', '$room_location')";

    if ($conn->query($sql) === TRUE) {
        // Set success notification
        $notification_message = "New room created successfully";
        $notification_type = "success";
    } else {
        // Set error notification
        $notification_message = "Error: " . $sql . "<br>" . $conn->error;
        $notification_type = "danger";
    }
    $conn->close();
}
?>

<!-- Popup notification -->
<?php if (!empty($notification_message)): ?>
<div class="alert alert-<?php echo $notification_type; ?> alert-dismissible fade show" role="alert">
    <?php echo $notification_message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label for="room_name" class="form-label">Room Name</label>
        <input type="text" class="form-control" id="room_name" name="room_name" required>
    </div>
    <div class="mb-3">
        <label for="room_location" class="form-label">Room Location</label>
        <input type="text" class="form-control" id="room_location" name="room_location" required>
    </div>
    <button type="submit" class="btn btn-primary">Register Room</button>
</form>
