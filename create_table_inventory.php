<?php
require_once("config.php");

$tableName = "Inventory";
$sql = "CREATE TABLE $tableName (
inventoryID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
videoID INT NOT NULL,
inventoryStatus ENUM('AVAILABLE','RENTED','BROKEN') NOT NULL,
status VARCHAR(30) DEFAULT 'Active',
FOREIGN KEY (videoID) REFERENCES VideoTape(videoID)
)";

if(mysqli_query($conn, $sql)){
    echo "Table ".$tableName," created successfully!";
}
else{
    echo "Error when creating table ".$tableName.": ".mysqli_error($conn);
}

//mysqli_close($conn);
?>