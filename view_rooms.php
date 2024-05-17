<?php
include 'db.php';

// Fetch rooms from the database
$sql = "SELECT * FROM Rooms";
$result = $conn->query($sql);
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Room ID</th>
            <th scope="col">Room Name</th>
            <th scope="col">Room Location</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <th scope="row"><?php echo $row['room_id']; ?></th>
                <td><?php echo $row['room_name']; ?></td>
                <td><?php echo $row['room_location']; ?></td>
                <td>
                    <!-- Edit Button -->
                    <a href="edit_room.php?id=<?php echo $row['room_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    
                    <!-- Delete Button -->
                    <form action="delete_room.php" method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $row['room_id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
