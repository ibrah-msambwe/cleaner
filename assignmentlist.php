<?php include 'header.php'; ?>
<?php


// Fetch all assignments from the database
$sql = "SELECT a.assignment_id, u.full_name AS cleaner_name, r.room_name, r.room_location, a.date_assigned, a.date_completed, a.status 
        FROM Assignments a 
        JOIN Users u ON a.cleaner_id = u.user_id 
        JOIN Rooms r ON a.room_id = r.room_id";
$result = $conn->query($sql);
?>


    <div class="container mt-5">
        <h2 class="text-center">Assignment List</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Assignment ID</th>
                        <th scope="col">Cleaner Name</th>
                        <th scope="col">Room Name</th>
                        <th scope="col">Room Location</th>
                        <th scope="col">Date Assigned</th>
                        <th scope="col">Date Completed</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <th scope="row"><?php echo $row['assignment_id']; ?></th>
                        <td><?php echo $row['cleaner_name']; ?></td>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><?php echo $row['room_location']; ?></td>
                        <td><?php echo $row['date_assigned']; ?></td>
                        <td><?php echo $row['date_completed']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
