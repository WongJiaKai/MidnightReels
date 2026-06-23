<?php
require_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 👈 核心修改：不删数据，只改状态为 Deleted
    $sql = "UPDATE Users SET status = 'Deleted' WHERE userID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User [$id] has been removed from active list.'); window.location.href='ListOfUser.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>