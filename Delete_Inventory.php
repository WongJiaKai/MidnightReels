<?php
require_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE Inventory SET status = 'Deleted' WHERE inventoryID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Inventory [$id] has been removed from active list.'); window.location.href='ListOfInventory.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>