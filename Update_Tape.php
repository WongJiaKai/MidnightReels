<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoID = $_POST['videoID'];
    $videoName = $_POST['videoName'];
    $videoDescription = $_POST['videoDescription'];
    $genre = $_POST['videoGenre'];
    $videoDuration = $_POST['videoDuration'];
    $videoReleaseDate = $_POST['videoReleaseDate'];
    $videoRentalPrice = $_POST['videoRentalPrice'];
    
    // 默认先使用隐藏域传过来的旧图片路径
    $finalImagePath = $_POST['oldVideoImage']; 

    // 👈 核心逻辑：检查用户有没有从电脑里选择新照片
    if (isset($_FILES['videoImage']) && $_FILES['videoImage']['error'] == 0) {
        
        $targetDir = "ASSETS/"; // 👈 你存放照片的本地文件夹名字
        $fileName = time() . "_" . basename($_FILES["videoImage"]["name"]); // 用时间戳重命名防止文件名冲突
        $targetFilePath = $targetDir . $fileName;
        
        // 获取文件类型进行安全验证
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        
        if (in_array(strtolower($fileType), $allowTypes)) {
            // 把照片文件从用户的电脑缓存中，正式移动到你的项目本地文件夹中
            if (move_uploaded_file($_FILES["videoImage"]["tmp_name"], $targetFilePath)) {
                $finalImagePath = $targetFilePath; // ✨ 成功上传，将新路径赋给变量
            }
        }
    }

    // 执行 SQL 修改语句，写入数据库
    $sql = "UPDATE VideoTape SET 
            videoName = '$videoName', 
            videoDescription = '$videoDescription', 
            videoGenre = '$genre', 
            videoDuration = '$videoDuration', 
            videoReleaseDate = '$videoReleaseDate', 
            videoRentalPrice = '$videoRentalPrice', 
            videoImage = '$finalImagePath' 
            WHERE videoID = '$videoID'";
            
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Tape updated successfully!'); window.location.href='ListOfTapes.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>