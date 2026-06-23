<?php
// 1. 引入连接文件并确保选中数据库
require_once("config.php");
mysqli_select_db($conn, "MidnightReels");

echo "<h2>Starting Data Insertion...</h2>";

// ==========================================
// 步骤 1：先向父表 Users 插入数据（假设你的 Users 表有 username 和 email）
// ==========================================
// 我们假设 userID 是 AUTO_INCREMENT（自增）的，1号和2号
$sql_users = "INSERT INTO Users VALUES 
(001, 'wongjiakai', 'john@example.com', 0187920075, 123456789, 'Staff', 20250110, ''),
(002, 'Ali', 'marry@example.com', 0127822353, 987654321, 'Customer', 20251001, '')
ON DUPLICATE KEY UPDATE userID=userID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_users)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}

$sql_tape = "INSERT INTO VideoTape VALUES 
(001, '7710', 'A travelling about a bangbo and its pet, a cat', 'Action', '120', 20260101, 20, 'img/7710.png', ''),
(002, 'AttackOnCyberz', 'A video that talking about the titan', 'Horror', '210', 20250101, 10, 'img/AttackOnCyberz.png', '')
ON DUPLICATE KEY UPDATE videoID=videoID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_tape)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}

$sql_customer = "INSERT INTO Customer VALUES 
(001, '7, Jalan Anggerik 29', 'NEWCOMER'),
(002, '8, Jalan Anggerik 29', 'NEWCOMER')
ON DUPLICATE KEY UPDATE userID=userID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_customer)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}

$sql_rental = "INSERT INTO Rental VALUES 
(001, 20260110, 001, ''),
(002, 20260619, 002, '')
ON DUPLICATE KEY UPDATE rentalID=rentalID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_rental)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}

$sql_payment = "INSERT INTO Payment VALUES 
(001, 20, 'CASH', 20260710, 'PAID', 001),
(002, 50, 'QR', 20261010, 'NOT PAID', 002)
ON DUPLICATE KEY UPDATE paymentID=paymentID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_payment)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}

$sql_inventory = "INSERT INTO Inventory VALUES 
(001, 001, 'AVAILABLE', ''),
(002, 002, 'RENTED', '')
ON DUPLICATE KEY UPDATE inventoryID=inventoryID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_inventory)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}

$sql_rentalitem = "INSERT INTO RentalItem VALUES 
(001, 20, 20260620, 20260720, 001, 001),
(002, 40, 20251001, 20261001, 002, 002)
ON DUPLICATE KEY UPDATE rentalItemID=rentalItemID;"; // 防止重复运行脚本时报错

if(mysqli_query($conn, $sql_rentalitem)){
    echo "✔ Users data inserted successfully!<br>";
} else {
    echo "❌ Error inserting Users: " . mysqli_error($conn) . "<br>";
}
// ==========================================
// 步骤 2：再向子表 Customer 插入数据（依赖刚才的 userID 1 和 2）
// ==========================================
// 这里的 userID 必须是 Users 表里真正存在的！
// $sql_customer = "INSERT INTO Customer (userID, address, membershipType) VALUES 
// (1, '123 Main Street, Johor Bahru', 'VIP'),
// (2, '456 Skudai Way, Taman Universiti', 'NEWCOMER')
// ON DUPLICATE KEY UPDATE address=address;";

// if(mysqli_query($conn, $sql_customer)){
//     echo "✔ Customer data inserted successfully!<br>";
// } else {
//     echo "❌ Error inserting Customer: " . mysqli_error($conn) . "<br>";
// }

// ==========================================
// 步骤 3：向其他没有外键依赖的独立表（如 VideoTape）插入数据
// ==========================================
// $sql_tape = "INSERT INTO VideoTape ..."; 
// mysqli_query($conn, $sql_tape);


// 最后关闭连接
mysqli_close($conn);
echo "<br><b>Data population completed!</b>";
?>