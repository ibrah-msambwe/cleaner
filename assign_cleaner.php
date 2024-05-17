<?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2>Assign Cleaner to Room</h2>
        <form method="POST" action="process_assign_cleaner.php">
            <div class="mb-3">
                <label for="cleaner_id" class="form-label">Select Cleaner</label>
                <select class="form-select" name="cleaner_id" required>
                    <option value="">Select Cleaner</option>
                    <?php
                        // Fetch cleaners from the database where role is equal to cleaner
                        $sql_cleaners = "SELECT * FROM users WHERE role = 'cleaner'";
                        $result_cleaners = $conn->query($sql_cleaners);
                        while ($row = $result_cleaners->fetch_assoc()) {
                            echo "<option value='{$row['user_id']}'>{$row['username']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="room_id" class="form-label">Select Room</label>
                <select class="form-select" name="room_id" required>
                    <option value="">Select Room</option>
                    <?php
                    // Fetch rooms from the database
                    $sql_rooms = "SELECT * FROM rooms";
                    $result_rooms = $conn->query($sql_rooms);
                    while ($row = $result_rooms->fetch_assoc()) {
                        echo "<option value='{$row['room_id']}'>{$row['room_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb_3">
            <label for="date_assigned">Date Assigned</label>
            <input id="date_assigned" class="form-control" type="date" />
            </div>
            
            <button type="submit" class="btn btn-primary">Assign Cleaner to Room</button>
        </form>
    </div>

    <!-- Error Modal -->
    <?php if(isset($_SESSION['error'])): ?>
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo $_SESSION['error']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    </script>
    <?php
        unset($_SESSION['error']);
        endif;
    ?>

<?php include 'footer.php'; ?>
