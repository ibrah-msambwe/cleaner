<?php
include 'db.php';

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th> <!-- New column for edit and delete buttons -->
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <th scope="row"><?php echo $row['user_id']; ?></th>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <!-- Edit Button -->
                <a href="edit_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <!-- Delete Button -->
                <a href="delete_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
