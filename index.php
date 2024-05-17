<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM Users WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$sql = "SELECT a.assignment_id, r.room_name, r.room_location, a.date_assigned, a.status 
        FROM Assignments a 
        JOIN Rooms r ON a.room_id = r.room_id 
        WHERE a.cleaner_id = '$user_id' AND a.status = 'assigned'";
$duties = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleaner Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            width: 300px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
        }
        .card-body {
            padding: 20px;
        }
        .btn-icon {
            padding: 10px 20px;
            margin: 5px;
            font-size: 18px;
            border-radius: 8px;
        }
        .btn-suggestion {
            background-color: #007bff;
            color: #fff;
            border: 2px solid #007bff;
        }
        .btn-staff-login {
            background-color: #28a745;
            color: #fff;
            border: 2px solid #28a745;
        }
        .btn-suggestion:hover, .btn-staff-login:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container mt-5 d-flex justify-content-center">
    <div class="card">
        <div class="card-body">
            <!-- Suggestion Button -->
            <button class="btn btn-primary btn-icon btn-suggestion" id="suggestionBtn" data-bs-toggle="modal" data-bs-target="#suggestionModal"><i class="fas fa-lightbulb"></i> Suggestion</button>
            <!-- Staff Login Button -->
            <button class="btn btn-success btn-icon btn-staff-login" id="staffLoginBtn" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-user-lock"></i> Staff Login</button>
        </div>
    </div>
</div>

<!-- Suggestion Modal -->
<div class="modal" id="suggestionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">File a Suggestion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Suggestion Form -->
                <form action="complaints.php" method="POST">
                    <div class="mb-3">
                        <label for="complaint_text" class="form-label">Suggestion Text</label>
                        <textarea class="form-control" id="complaint_text" name="complaint_text" rows="3" required></textarea>
                    </div>
                    <!-- Dropdown for Room -->
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Select Room</label>
                        <select class="form-select" id="room_id" name="room_id" required>
                            <option value="">Select Room</option>
                            <?php
                            // Fetch rooms from the database
                            $sql = "SELECT * FROM Rooms";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['room_id']}'>{$row['room_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Dropdown for Student (if user role is student) -->
                    <?php if ($_SESSION['role'] == 'student'): ?>
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Select Student</label>
                        <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">Select Student</option>
                            <?php
                            // Fetch students from the database
                            $sql = "SELECT * FROM Users WHERE role = 'student'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['user_id']}'>{$row['full_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">Submit Suggestion</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1">
<?php include 'login.php'; ?>
    <!-- Login Modal content -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("staffLoginBtn").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById("loginModal"));
        modal.show();
    });
</script>

</body>
</html>
