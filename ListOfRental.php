<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is the list of rentals page of Rental Tapes Website">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Tapes Website</title>
    <link rel = "stylesheet" href = "ListOfRental.css"> 
</head>

<body>

<div id="editModal" class="modal-wrapper">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Rental Details</h3>
            <span class="close-btn" onclick="closeModal()">&times;</span>
        </div>
        <form action="Update_Rental.php" method="POST">
            <input type="hidden" name="rentalID" id="modalRentalID">
            
            <div class="form-group">
                <label>Rental Begin Date</label>
                <input type="date" name="rentalBeginDate" id="modalBeginDate" required>
            </div>
            <div class="form-group">
                <label>User ID</label>
                <input type="text" name="userID" id="modalUserID" required>
            </div>
            <div class="form-group">
                <label>Inventory ID</label>
                <input type="text" name="inventoryID" id="modalInventoryID" required>
            </div>
                <input type="hidden" name="videoName" id="modalName" required>
            <div class="form-group">
                <label>Payment Amount</label>
                <input type="number" name="paymentAmount" id="modalPayment" required>
            </div>
            <div class="form-group">
                <label>Payment Status</label>
                <select name="paymentStatus" id="modalStatus">
                    <option value="PAID">Paid</option>
                    <option value="NOT PAID">Not Paid</option>
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
            <h3>Add Rental Details</h3>
            <span class="close-btn" onclick="closeModal_Add()">&times;</span>
        </div>
        <form action="Add_Rental.php" method="POST">
            <input type="hidden" name="rentalID" id="modalRentalID">
            
            <div class="form-group">
                <label>Rental Begin Date</label>
                <input type="date" name="rentalBeginDate" id="modalBeginDate" required>
            </div>
            <div class="form-group">
                <label>User ID</label>
                <input type="text" name="userID" id="modalUserID" required>
            </div>
            <div class="form-group">
                <label>Inventory ID</label>
                <input type="text" name="inventoryID" id="modalInventoryID" required>
            </div>
                <input type="hidden" name="videoName" id="modalName" required>
            <div class="form-group">
                <label>Payment Amount</label>
                <input type="number" name="paymentAmount" id="modalPayment" required>
            </div>
            <div class="form-group">
                <label>Payment Status</label>
                <select name="paymentStatus" id="modalStatus">
                    <option value="PAID">Paid</option>
                    <option value="NOT PAID">Not Paid</option>
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
            <button type="button" class="toggle-btn active" id="rentalBtn">
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
        <h2>Rental System
            <button class="add-btn" id="addBtn" onclick="openModal()">
                +
            </button>
        </h2>
        <div class="data-table">
            <div class="table-header">
                <span onclick="sortTable(0, 'mixed')">Rental ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(1, 'mixed')">Rental Begin Date<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(2, 'mixed')">Due Begin Date<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(3, 'mixed')">User ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(4, 'mixed')">Inventory ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(5, 'mixed')">Video ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(6, 'mixed')">Video Name<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span onclick="sortTable(7, 'mixed')">Payment<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 10px; position: relative; top: 3px;"></span>
                <span>Status</span>
            </div>

            <?php
            require_once ("config.php");

            $nextUserID = "1";
            $idSql = "SELECT rentalID FROM Rental ORDER BY rentalID DESC LIMIT 1";
            $idResult = mysqli_query($conn, $idSql);

            if ($idResult && mysqli_num_rows($idResult) > 0) {
                $lastRow = mysqli_fetch_assoc($idResult);
                $lastID = $lastRow['rentalID'];
                $nextUserID = $lastID + 1;
            }

            $sql = "SELECT 
                    Rental.rentalID, 
                    Rental.rentalBeginDate, 
                    RentalItem.dueRentalDate,
                    Rental.userID, 
                    RentalItem.inventoryID,
                    VideoTape.videoID,
                    VideoTape.videoName,
                    Payment.paymentAmount,
                    Payment.paymentStatus
                    FROM Rental
                    LEFT JOIN RentalItem ON Rental.rentalID=RentalItem.rentalID
                    LEFT JOIN Inventory ON RentalItem.inventoryID=Inventory.inventoryID
                    LEFT JOIN VideoTape ON Inventory.videoID=VideoTape.videoID
                    LEFT JOIN Payment ON Rental.rentalID=Payment.rentalID
                    WHERE Rental.status = 'Active'";
            $result = mysqli_query($conn, $sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="table-row">';
                    echo '  <span>' . $row["rentalID"] . '</span>';
                    echo '  <span>' . $row["rentalBeginDate"] . '</span>';
                    echo '  <span>' . $row["dueRentalDate"] . '</span>';
                    echo '  <span>' . $row["userID"] . '</span>';
                    echo '  <span>' . $row["inventoryID"] . '</span>';
                    echo '  <span>' . $row["videoID"] . '</span>';
                    echo '  <span>' . $row["videoName"] . '</span>';
                    echo '  <span>RM ' . $row["paymentAmount"] . '</span>';
                    echo '  <span>' . $row["paymentStatus"] . '</span>';
                    
                    echo '  <div class="row-actions">';
                    echo '  <div class="action-card">';

                    echo '  <button class="action-btn edit-btn"
                            data-rentalID="' . $row["rentalID"] . '" 
                            data-beginDate="' . $row["rentalBeginDate"] . '" 
                            data-userID="' . $row["userID"] . '"
                            data-inventoryID="' . $row["inventoryID"] . '"  
                            data-videoID="' . $row["videoID"] . '" 
                            data-name="' . $row["videoName"] . '" 
                            data-payment="' . $row["paymentAmount"] . '"
                            data-status="' . $row["paymentStatus"] . '" 
                            onclick="Edit_Rental(this)">Edit</button>';

                    echo '  <button class="action-btn delete-btn" 
                            data-rentalID="' . $row["rentalID"] . '" 
                            onclick="Delete_Rental(this)">Delete</button>';

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