<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['userID'];
    $name = $_POST['username'];
    $email = $_POST['emailAddress'];
    $phone = $_POST['phoneNumber'];
    $role = $_POST['role'];

    $sql = "INSERT INTO Users (userID, username, emailAddress, phoneNumber, role, status) 
            VALUES ('$id', '$name', '$email', '$phone', '$role', 'Active')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User details added successfully!'); window.location.href='ListOfUser.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>