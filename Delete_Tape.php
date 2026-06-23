<?php
require_once("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 👈 核心修改：不删数据，只改状态为 Deleted
    $sql = "UPDATE videoTape SET status = 'Deleted' WHERE videoID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Video [$id] has been removed from active list.'); window.location.href='ListOfTapes.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>