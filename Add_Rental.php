<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. 接收前端传过来的所有数据
    $rentalID = $_POST['rentalID'];
    $beginDate = $_POST['rentalBeginDate'];
    $userID = $_POST['userID'];
    $inventoryID = $_POST['inventoryID'];
    $payment = $_POST['paymentAmount'];
    $status = $_POST['paymentStatus'];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_begin_transaction($conn);

    try {
        // 1. 插入主表时，不要手动传 rentalID
        $sql1 = "INSERT INTO Rental (rentalBeginDate, userID, status) 
                 VALUES ('$beginDate', '$userID', 'Active')";
        mysqli_query($conn, $sql1);

        // ✨ 核心：利用 PHP 抓取 MySQL 刚刚为这一行自动生成的那个真实 ID
        $realRentalID = mysqli_insert_id($conn); 

        // 2. 接下来后面两张表，全部改用这个刚出炉的 $realRentalID
        $sql2 = "INSERT INTO RentalItem (rentalID, inventoryID) 
                 VALUES ('$realRentalID', '$inventoryID')";
        mysqli_query($conn, $sql2);

        $sql3 = "INSERT INTO Payment (rentalID, paymentAmount, paymentStatus) 
                 VALUES ('$realRentalID', '$payment', '$status')";
        mysqli_query($conn, $sql3);

        mysqli_commit($conn);
        echo "<script>alert('New Rental record added successfully!'); window.location.href='ListOfRental.php';</script>";

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error adding record: " . $e->getMessage();
    }
}
?>