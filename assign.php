<?php
include 'db.php';

// Fetch cleaners and rooms from the database
$sql_cleaners = "SELECT * FROM Cleaners";
$result_cleaners = $conn->query($sql_cleaners);

$sql_rooms = "SELECT * FROM Rooms";
$result_rooms = $conn->query($sql_rooms);

// Define variables to store notification message and type
$notification_message = '';
$notification_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cleaner_id = $_POST['cleaner_id'];
    $room_id = $_POST['room_id'];

    // Check if the assignment already exists
    $sql_check = "SELECT * FROM Assignments WHERE cleaner_id = '$cleaner_id' AND room_id = '$room_id'";
    $result_check = $conn->query($sql_check);

    // Set notification based on whether the assignment exists or not
    if ($result_check->num_rows > 0) {
        $notification_message = "Assignment already exists";
        $notification_type = "danger";
    } else {
        $sql = "INSERT INTO Assignments (cleaner_id, room_id) VALUES ('$cleaner_id', '$room_id')";
        $notification_message = ($conn->query($sql) === TRUE) ? "Cleaner assigned to room successfully" : "Error: " . $sql . "<br>" . $conn->error;
        $notification_type = ($conn->query($sql) === TRUE) ? "success" : "danger";
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
        <label for="cleaner_id" class="form-label">Cleaner</label>
        <select class="form-select" name="cleaner_id" required>
            <option value="">Select Cleaner</option>
            <?php while ($row = $result_cleaners->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="room_id" class="form-label">Room</label>
        <select class="form-select" name="room_id" required>
            <option value="">Select Room</option>
            <?php while ($row = $result_rooms->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Assign Cleaner to Room</button>
</form>
