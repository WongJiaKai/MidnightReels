<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is the list of tapes page of Rental Tapes Website">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Tapes Website</title>
    <link rel = "stylesheet" href = "ListOfTapes.css"> 
</head>

<body>
<div id="editModal" class="modal-wrapper">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Tape Details</h3>
            <span class="close-btn" onclick="closeModal()">&times;</span>
        </div>
        <form action="Update_Tape.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="videoID" id="modalVideoID">
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="videoName" id="modalName" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="videoDescription" id="modalDescription" required>
            </div>
            <div class="form-group">
                <label>Genre</label>
                <select name="videoGenre" id="modalGenre">
                    <option value="ACTION">Action</option>
                    <option value="COMEDY">Comedy</option>
                    <option value="SCI-FI">Sci-Fi</option>
                    <option value="HORROR">Horror</option>
                    <option value="ROMANCE">Romance</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duration</label>
                <input type="number" name="videoDuration" id="modalDuration" required>
            </div>
            <div class="form-group">
                <label>Release Date</label>
                <input type="date" name="videoReleaseDate" id="modalReleaseDate" required>
            </div>
            <div class="form-group">
                <label>Rental Price</label>
                <input type="number" name="videoRentalPrice" id="modalPrice" required>
            </div>
            <div class="form-group">
                <label>Current Image</label>
                    <img id="modalImagePreview" src="" alt="Tape Poster" style="width: 100px; height: 130px; object-fit: cover; border-radius: 6px; border: 1px solid #444; margin-bottom: 8px;">
                    <input type="hidden" name="oldVideoImage" id="modalOldImagePath">
                <label>Choose New Image (Optional)</label>
                    <input type="file" name="videoImage" id="modalImageInput" accept="image/*" onchange="previewNewImage(this)">
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
            <h3>Add Tape Details</h3>
            <span class="close-btn" onclick="closeModal_Add()">&times;</span>
        </div>
        
        <form action="Add_Tapes.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="videoID" id="modalVideoID">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="videoName" id="modalName" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="videoDescription" id="modalDescription" required>
            </div>
            <div class="form-group">
                <label>Genre</label>
                <select name="videoGenre" id="modalGenre">
                    <option value="ACTION">Action</option>
                    <option value="COMEDY">Comedy</option>
                    <option value="SCI-FI">Sci-Fi</option>
                    <option value="HORROR">Horror</option>
                    <option value="ROMANCE">Romance</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duration</label>
                <input type="number" name="videoDuration" id="modalDuration" required>
            </div>
            <div class="form-group">
                <label>Release Date</label>
                <input type="date" name="videoReleaseDate" id="modalReleaseDate" required>
            </div>
            <div class="form-group">
                <label>Rental Price</label>
                <input type="number" name="videoRentalPrice" id="modalPrice" required>
            </div>
            <div class="form-group">
                <label>Choose New Image</label>
                    <input type="file" name="videoImage" id="modalImageInput" accept="image/*" onchange="previewNewImage(this)">
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
            <button type="button" class="toggle-btn active" id="tapesBtn">
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
        <h2>Required Tapes
            <button class="add-btn" id="addBtn" onclick="openModal()">
                +
            </button>
        </h2>
        <div class="data-table">
            <div class="table-header">
                <span onclick="sortTable(0, 'mixed')">ID<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 5px; position: relative; bottom: 2px;"></span>
                <span onclick="sortTable(1, 'mixed')">Name<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 5px; position: relative; bottom: 2px;"></span>
                <span>Description</span>
                <span onclick="sortTable(2, 'mixed')">Genre<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 5px; position: relative; bottom: 2px;"></span>
                <span onclick="sortTable(3, 'mixed')">Duration<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 5px; position: relative; bottom: 2px;"></span>
                <span onclick="sortTable(4, 'mixed')">Release Date<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 5px; position: relative; bottom: 2px;"></span>
                <span onclick="sortTable(5, 'mixed')">Price<img src="img/arrow.png" style="width: 20px; height: 20px; margin-left: 5px; position: relative; bottom: 2px;"></span>
                <span>Image</span>
            </div>

            <?php
            require_once ("config.php");

            $sql = "SELECT videoID, videoName, videoDescription, videoGenre, videoDuration, videoReleaseDate, videoRentalPrice, videoImage FROM VideoTape WHERE status = 'Active'";
            $result = mysqli_query($conn, $sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="table-row">';
                    echo '  <span>' . $row["videoID"] . '</span>';
                    echo '  <span>' . $row["videoName"] . '</span>';
                    echo '  <span>' . $row["videoDescription"] . '</span>';
                    echo '  <span>' . $row["videoGenre"] . '</span>';
                    echo '  <span>' . $row["videoDuration"] . ' minutes' . '</span>';
                    echo '  <span>' . $row["videoReleaseDate"] . '</span>';
                    echo '  <span>RM ' . $row["videoRentalPrice"] . '</span>';
                    echo '  <span class="tape-img-cell"><img src="' . $row["videoImage"] . '"></span>';

                    echo '  <div class="row-actions">';
                    echo '  <div class="action-card">';

                    echo '  <button class="action-btn edit-btn" 
                            data-id="' . $row["videoID"] . '" 
                            data-name="'.$row["videoName"].'" 
                            data-desc="'.$row["videoDescription"].'" 
                            data-genre="'.$row["videoGenre"].'" 
                            data-duration="'.$row["videoDuration"].'"
                            data-releaseDate="'.$row["videoReleaseDate"].'"
                            data-price="'.$row["videoRentalPrice"].'"
                            data-image="'.$row["videoImage"].'"   
                            onclick="Edit_Tapes(this)">Edit</button>';

                    echo '  <button class="action-btn delete-btn" 
                            data-id="' . $row["videoID"] . '" 
                            onclick="Delete_Tapes(this)">Delete</button>';

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