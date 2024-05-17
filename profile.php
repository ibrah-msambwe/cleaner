<?php include 'header.php'; ?>

<?php
$user_id = $_SESSION['user_id'];

// Fetch user details
$sql_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

if ($user['role'] == 'admin') {
    // Display complaints for admin
    $sql_complaints = "SELECT * FROM complaints";
    $result_complaints = $conn->query($sql_complaints);
    ?>

    <div class="container mt-5">
        <h2 class="text-center">Welcome, <?php echo $user['full_name']; ?></h2>
        <h3>Complaints</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Complaint ID</th>
                        <th scope="col">Student Name</th> <!-- Updated from "Student ID" -->
                        <th scope="col">Room Name</th> <!-- Updated from "Room ID" -->
                        <th scope="col">Complaint Text</th>
                        <th scope="col">Date Filed</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_complaints->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['complaint_id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td> <!-- Updated from "student_id" -->
                            <td><?php echo $row['room_name']; ?></td> <!-- Updated from "room_id" -->
                            <td><?php echo $row['complaint_text']; ?></td>
                            <td><?php echo $row['date_filed']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php } elseif ($user['role'] == 'cleaner') {
    // Display duties for cleaner
    $sql_duties = "SELECT a.assignment_id, r.room_name, r.room_location, a.date_assigned, a.status 
                   FROM Assignments a 
                   JOIN Rooms r ON a.room_id = r.room_id 
                   WHERE a.cleaner_id = '$user_id' AND a.status = 'assigned'";
    $result_duties = $conn->query($sql_duties);
    ?>

    <div class="container mt-5">
        <h2 class="text-center">Welcome, <?php echo $user['full_name']; ?></h2>
        <h3>Your Duties</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Assignment ID</th>
                        <th scope="col">Room Name</th>
                        <th scope="col">Room Location</th>
                        <th scope="col">Date Assigned</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_duties->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['assignment_id']; ?></td>
                            <td><?php echo $row['room_name']; ?></td>
                            <td><?php echo $row['room_location']; ?></td>
                            <td><?php echo $row['date_assigned']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <form method="POST" action="complete_assignment.php">
                                    <input type="hidden" name="assignment_id" value="<?php echo $row['assignment_id']; ?>">
                                    <button type="submit" class="btn btn-success">Complete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php } ?>

<?php include 'footer.php'; ?>
