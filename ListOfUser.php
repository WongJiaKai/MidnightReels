<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is the list of users page of Rental Tapes Website">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Tapes Website</title>
    <link rel = "stylesheet" href = "ListOfUser.css"> 
</head>

<body>
<div id="editModal" class="modal-wrapper">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit User Details</h3>
            <span class="close-btn" onclick="closeModal()">&times;</span>
        </div>
        <form action="Update_User.php" method="POST">
            <input type="hidden" name="userID" id="modalUserID">
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="modalUsername" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="emailAddress" id="modalEmail" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phoneNumber" id="modalPhone" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" id="modalRole">
                    <option value="Admin">Admin</option>
                    <option value="Customer">Customer</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button type="submit" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<div id="addModal" class="modal-wrapper">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit User Details</h3>
            <span class="close-btn" onclick="closeModal_Add()">&times;</span>
        </div>
        <form action="Add_User.php" method="POST">
            <input type="hidden" name="userID" id="modalUserID">
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="modalUsername" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="emailAddress" id="modalEmail" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phoneNumber" id="modalPhone" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" id="modalRole">
                    <option value="Admin">Admin</option>
                    <option value="Customer">Customer</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel-btn" onclick="closeModal_Add()">Cancel</button>
                <button type="submit" class="save-btn">Add</button>
            </div>
        </form>
    </div>
</div>

    <header>
        <div id="titleImg">
            <img class="logo" src="img/WebsiteLogo.png" alt="Midnight Reels">
        </div>

        <nav class="toggle-container">
            <button type="button" class="toggle-btn active" id="userBtn">
                User
            </button>
            <button type="button" class="toggle-btn inactive" id="tapesBtn" onclick="window.location.href='ListOfTapes.php'">
                Tapes
            </button>
            <button type="button" class="toggle-btn inactive" id="rentalBtn" onclick="window.location.href='ListOfRental.php'">
                Rental
            </button>
            <button type="button" class="toggle-btn inactive" id="inventoryBtn" onclick="window.location.href='ListOfInventory.php'">
                Inventory
            </button>
        </nav>
        <a href="index.php" class="profile_button" aria-label="Profile">
            <img src="img/HomeProfile.png" alt="Profile">
        </a>
    </header>
    <main class="content-container">
        <h2>System Users
            <button class="add-btn" id="addBtn" onclick="openModal()">
                +
            </button>
        </h2>
        <div class="data-table">
            <div class="table-header">
                <span onclick="sortTable(0, 'mixed')">ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(1, 'mixed')">Username<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(2, 'mixed')">Email<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(3, 'mixed')">Phone Number<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(4, 'mixed')">Role<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
            </div>

            <?php
            require_once ("config.php");

            $sql = "SELECT userID, username, emailAddress, phoneNumber, role FROM Users WHERE status = 'Active'";
            $result = mysqli_query($conn, $sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="table-row">';
                    echo '  <span>' . $row["userID"] . '</span>';
                    echo '  <span>' . $row["username"] . '</span>';
                    echo '  <span>' . $row["emailAddress"] . '</span>';
                    echo '  <span>+60-' . $row["phoneNumber"] . '</span>';
                    echo '  <span>' . $row["role"] . '</span>';

                    echo '  <div class="row-actions">';
                    echo '  <div class="action-card">';

                    echo '  <button class="action-btn edit-btn" 
                            data-id="' . $row["userID"] . '" 
                            data-name="' . $row["username"] . '"
                            data-email="'.$row["emailAddress"].'" 
                            data-phone="'.$row["phoneNumber"].'" 
                            data-role="'.$row["role"].'" 
                            onclick="Edit_Users(this)">Edit</button>';

                    echo '  <button class="action-btn delete-btn" 
                            data-id="' . $row["userID"] . '" 
                            onclick="Delete_Users(this)">Delete</button>';

                    echo '  </div>';
                    echo '  </div>';

                    echo '</div>';
                }
            }
            ?>
        </div>
    </main>
    <script src="List_Page.js"></script>
</body>
</html>