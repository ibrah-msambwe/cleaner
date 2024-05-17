<?php include 'header.php'; ?>
    <div class="container-main mt-5">
    <?php
        // Check for success or error message in URL parameters
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success" role="alert">User registered successfully!</div>';
        } elseif (isset($_GET['error'])) {
            echo '<div class="alert alert-danger" role="alert">Error: ' . urldecode($_GET['error']) . '</div>';
        }
    ?>
        <h2>Admin Registration</h2>

        <div class="buttons">
            <!-- Register New User Button -->
            <button class="btn btn-primary mb-3" type="button" id="btnUser">Register New User</button>

            <!-- View Users Table Button -->
            <button class="btn btn-primary mb-3" type="button" id="btnViewUsers">View Users Table</button>

            <!-- Register New Room Button -->
            <button class="btn btn-primary mb-3" type="button" id="btnRoom">Register New Room</button>

            <!-- Assign Cleaner to Room Button -->
            <button class="btn btn-primary mb-3" type="button" id="btnViewRooms">Rooms List</button>
        </div>

        <!-- Register New User Form (Initially Hidden) -->
        <div id="userForm" style="display: none;">
            <?php include 'user_register.php'; ?>
        </div>

        <!-- View Users Table Form (Initially Hidden) -->
        <div id="viewUsers" style="display: none;">
            <?php include 'view_users.php'; ?>
        </div>

        <!-- Register New Room Form (Initially Hidden) -->
        <div id="roomForm" style="display: none;">
            <?php include 'register_room.php'; ?>
        </div>

                <!-- Assign Cleaner to Room Form (Initially Hidden) -->
        <div id="viewRooms" style="display: none;">
            <?php include 'view_rooms.php'; ?>
        </div>
        <!-- Logout Button -->

    </div>
    <?php include 'footer.php'; ?>
    <script>
        // Function to hide all forms
        function hideAllForms() {
            var forms = document.querySelectorAll('.container > div:not(.buttons)');
            forms.forEach(function(form) {
                form.style.display = 'none';
            });
        }

        // Function to toggle visibility of form or table
        function toggleVisibility(id) {
            hideAllForms();
            var element = document.getElementById(id);
            element.style.display = (element.style.display === 'none') ? 'block' : 'none';
        }

        // Event listeners for button clicks
        document.getElementById("btnUser").addEventListener("click", function() {
            toggleVisibility("userForm");
        });

        document.getElementById("btnViewUsers").addEventListener("click", function() {
            toggleVisibility("viewUsers");
        });

        document.getElementById("btnRoom").addEventListener("click", function() {
            toggleVisibility("roomForm");
        });

        document.getElementById("btnViewRooms").addEventListener("click", function() {
            toggleVisibility("viewRooms");
        });
    </script>
<?php include 'footer.php'; ?>
