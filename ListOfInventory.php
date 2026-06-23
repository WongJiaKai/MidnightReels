<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is the list of inventories page of Rental Tapes Website">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Tapes Website</title>
    <link rel = "stylesheet" href = "ListOfInventory.css"> 
</head>

<body>

<div id="editModal" class="modal-wrapper">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Invnentory Details</h3>
            <span class="close-btn" onclick="closeModal()">&times;</span>
        </div>
        <form action="Update_Inventory.php" method="POST">
            <input type="hidden" name="inventoryID" id="modalInventoryID">
            
            <div class="form-group">
                <label>Video ID</label>
                <input type="text" name="videoID" id="modalVideoID" required>
            </div>
            <div class="form-group">
                <label>Inventory Status</label>
                <select name="inventoryStatus" id="modalStatus">
                    <option value="AVAILABLE">available</option>
                    <option value="RENTED">Rented</option>
                    <option value="BROKEN">Broken</option>
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
            <h3>Add Invnentory Details</h3>
            <span class="close-btn" onclick="closeModal_Add()">&times;</span>
        </div>
        <form action="Add_Inventory.php" method="POST">
            <input type="hidden" name="inventoryID" id="modalInventoryID">
            
            <div class="form-group">
                <label>Video ID</label>
                <input type="text" name="videoID" id="modalVideoID" required>
            </div>
            <div class="form-group">
                <label>Inventory Status</label>
                <select name="inventoryStatus" id="modalStatus">
                    <option value="AVAILABLE">available</option>
                    <option value="RENTED">Rented</option>
                    <option value="BROKEN">Broken</option>
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
            <button type="button" class="toggle-btn inactive" id="userBtn" onclick="window.location.href='ListOfUser.php'">
                User
            </button>
            <button type="button" class="toggle-btn inactive" id="tapesBtn" onclick="window.location.href='ListOfTapes.php'">
                Tapes
            </button>
            <button type="button" class="toggle-btn inactive" id="rentalBtn" onclick="window.location.href='ListOfRental.php'">
                Rental
            </button>
            <button type="button" class="toggle-btn active" id="inventoryBtn">
                Inventory
            </button>
        </nav>
        <a href="index.php" class="profile_button" aria-label="Profile">
            <img src="img/HomeProfile.png" alt="Profile">
        </a>
    </header>
    <main class="content-container">
        <h2>System Inventory
            <button class="add-btn" id="addBtn" onclick="openModal()">
                +
            </button>
        </h2>
        <div class="data-table">
            <div class="table-header">
                <span onclick="sortTable(0, 'mixed')">Inventory ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(1, 'mixed')">Video ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(2, 'mixed')">Video Name<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(3, 'mixed')">Inventory Status<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
            </div>

            <?php
            require_once ("config.php");
            $sql = "SELECT 
                    Inventory.inventoryID, 
                    Inventory.videoID,
                    VideoTape.videoName,
                    Inventory.inventoryStatus  
                    FROM Inventory
                    LEFT JOIN VideoTape ON Inventory.videoID=VideoTape.videoID
                    WHERE Inventory.status = 'Active'";
            $result = mysqli_query($conn, $sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="table-row">';
                    echo '  <span>' . $row["inventoryID"] . '</span>';
                    echo '  <span>' . $row["videoID"] . '</span>';
                    echo '  <span>' . $row["videoName"] . '</span>';
                    echo '  <span>' . $row["inventoryStatus"] . '</span>';
                    
                    echo '  <div class="row-actions">';
                    echo '  <div class="action-card">';

                    echo '  <button class="action-btn edit-btn"
                            data-inventoryID="' . $row["inventoryID"] . '" 
                            data-videoID="' . $row["videoID"] . '" 
                            data-status="' . $row["inventoryStatus"] . '" 
                            onclick="Edit_Inventory(this)">Edit</button>';

                    echo '  <button class="action-btn delete-btn" 
                            data-inventoryID="' . $row["inventoryID"] . '" 
                            onclick="Delete_Inventory(this)">Delete</button>';

                    echo '  </div>';
                    echo '  </div>';

                    echo '  </div>';
                }
            }
            ?>
        </div>
    </main>
    <script src="List_Page.js"></script>
</body>
</html>