<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['userID'];
    $name = $_POST['username'];
    $email = $_POST['emailAddress'];
    $phone = $_POST['phoneNumber'];
    $role = $_POST['role'];

    // 执行 SQL 修改语句
    $sql = "UPDATE Users SET username='$name', emailAddress='$email', phoneNumber='$phone', role='$role' WHERE userID='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User details updated successfully!'); window.location.href='ListOfUser.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>