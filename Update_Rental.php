<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rentalID = $_POST['rentalID'];
    $beginDate = $_POST['rentalBeginDate'];
    $userID = $_POST['userID'];
    $inventoryID = $_POST['inventoryID'];
    $payment = $_POST['paymentAmount'];
    $status = $_POST['paymentStatus'];

    mysqli_begin_transaction($conn);

    try {
        $sql1 = "UPDATE Rental SET 
                 rentalBeginDate = '$beginDate', 
                 userID = '$userID'
                 WHERE rentalID = '$rentalID'";
        mysqli_query($conn, $sql1);

    
        $sql2 = "UPDATE RentalItem SET
                 inventoryID = '$inventoryID'
                 WHERE rentalID = '$rentalID'";
        mysqli_query($conn, $sql2);

        $sql3 = "UPDATE Payment SET 
                 paymentAmount = '$payment', 
                 paymentStatus = '$status' 
                 WHERE rentalID = '$rentalID'";
        mysqli_query($conn, $sql3);

        mysqli_commit($conn);
        echo "<script>alert('Rental & Payment details updated successfully!'); window.location.href='ListOfRental.php';</script>";

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>