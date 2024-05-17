<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Submit a Complaint</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <select class="form-control" id="student_id" name="student_id" required>
                <?php
                // Include the database connection file
                include_once 'db.php';

                // Fetch students with role 'student'
                $sql_students = "SELECT * FROM users WHERE role = 'student'";
                $result_students = mysqli_query($conn, $sql_students);
                if (mysqli_num_rows($result_students) > 0) {
                    while ($row = mysqli_fetch_assoc($result_students)) {
                        echo "<option value='" . $row['user_id'] . "'>" . $row['username'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb_3">
            <label for="date_filed ">Date Assigned</label>
            <input id="date_filed " class="form-control" type="date" />
            </div>
        <div class="form-group">
            <label for="room_id">Room ID:</label>
            <select class="form-control" id="room_id" name="room_id" required>
                <?php
                // Fetch rooms from the database
                $sql_rooms = "SELECT * FROM rooms";
                $result_rooms = mysqli_query($conn, $sql_rooms);
                if (mysqli_num_rows($result_rooms) > 0) {
                    while ($row = mysqli_fetch_assoc($result_rooms)) {
                        echo "<option value='" . $row['room_id'] . "'>" . $row['room_name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="complaint_text">Complaint:</label>
            <textarea class="form-control" id="complaint_text" name="complaint_text" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Complaint</button>
    </form>
</div>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $room_id = mysqli_real_escape_string($conn, $_POST['room_id']);
    $complaint_text = mysqli_real_escape_string($conn, $_POST['complaint_text']);
    
    // Attempt to insert the complaint into the database
    $sql = "INSERT INTO complaints (student_id, room_id, complaint_text, date_filed, status) 
            VALUES ('$student_id', '$room_id', '$complaint_text', NOW(), 'Pending')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Complaint submitted successfully.'); window.location='complaint.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
</body>
</html>
