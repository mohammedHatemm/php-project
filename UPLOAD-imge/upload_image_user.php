<?php
// الاتصال بقاعدة البيانات
require_once "connection.php";

// التحقق من الاتصال
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من الطلب
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])) {
        // استلام الملف
        $imageName = $_FILES['image']['name'];
        $targetDir = "uploads/"; // مسار مجلد الصور
        $targetFile = $targetDir . basename($imageName);

        // نقل الصورة إلى المجلد
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // حفظ مسار الصورة في قاعدة البيانات
            $stmt = $connection->prepare("INSERT INTO users (name, path) VALUES (?, ?)");
            $stmt->bind_param("ss", $imageName, $targetFile);
            $stmt->execute();

            echo "Image uploaded and path saved successfully!";
            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image selected.";
    }
}

$conn->close();
?>
