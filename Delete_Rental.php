<?php
require_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE Rental SET status = 'Deleted' WHERE rentalID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Rental [$id] has been removed from active list.'); window.location.href='ListOfRental.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>