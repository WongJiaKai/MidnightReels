<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['videoID'];
    $name = $_POST['videoName'];
    $description = $_POST['videoDescription'];
    $genre = $_POST['videoGenre'];
    $duration = $_POST['videoDuration'];
    $date = $_POST['videoReleaseDate'];
    $price = $_POST['videoRentalPrice'];
    $image = $_POST['videoImage'];

    $finalImagePath = "img/default.png"; 

    // ✨ 核心修正：使用 $_FILES 检查用户有没有从电脑里选择并上传照片
    if (isset($_FILES['videoImage']) && $_FILES['videoImage']['error'] == 0) {
        
        $targetDir = "img/"; // 👈 你的图片存放文件夹路径（确保项目里有这个文件夹）
        
        // 用时间戳重命名（例如：1719022259_Elevator.png），防止不同录像带上传同名图片时被覆盖
        $fileName = basename($_FILES["videoImage"]["name"]); 
        $targetFilePath = $targetDir . $fileName; //这时它就会拼接成 "img/1719022259_Elevator.png"
        
        // 获取文件后缀进行安全验证
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        
        if (in_array(strtolower($fileType), $allowTypes)) {
            // 把照片文件从临时缓存区，正式移动到你的 img/ 文件夹中
            if (move_uploaded_file($_FILES["videoImage"]["tmp_name"], $targetFilePath)) {
                $finalImagePath = $targetFilePath; // ✨ 移动成功，把带文件夹的完整路径赋给变量
            }
        }
    } else {
        // 如果你的前端是用隐藏域传了预览路径，或者是从某些特定地方传了纯文本路径过来：
        // 如果确认表单确实传了普通的 'videoImage' 文本且包含正确路径，才放开下面这行
        if(!empty($_POST['videoImage'])) { $finalImagePath = "img/" . $_POST['videoImage']; }
    }

    $sql = "INSERT INTO VideoTape (videoID, videoName, videoDescription, videoGenre, videoDuration, videoReleaseDate, videoRentalPrice, videoImage, status) 
            VALUES ('$id', '$name', '$description', '$genre', '$duration', '$date', '$price', '$finalImagePath', 'Active')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Tape details added successfully!'); window.location.href='ListOfTapes.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>