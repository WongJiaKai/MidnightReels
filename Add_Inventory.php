<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoID = $_POST['videoID'];
    $status = $_POST['inventoryStatus'];

    // 执行 SQL 修改语句
    $sql = "INSERT INTO Inventory (videoID, inventoryStatus)
             VALUES ('$videoID', '$status')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Inventory details updated successfully!'); window.location.href='ListOfInventory.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>