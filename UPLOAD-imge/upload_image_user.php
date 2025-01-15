<?php

require_once "../databasePHP/connection.php";
// require_once "../databasePHP/server.php" ;  // Handle file upload

    $uploadMessage = "";

    $uploadMessage = "";
    $userName = $userEmail = $userPassword = $userPhone = $userRole = "";
    $userImg = [];

     // رسالة حالة التحميل
    if (isset($userImg) && $userImg["error"] == 0) {
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        $fileType = $userImg["type"];

        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = "../uploads/"; // المسار الذي سيتم حفظ الصور فيه
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // إنشاء المجلد إذا لم يكن موجودًا
            }

            $fileName = uniqid() . "_" . basename($userImg["name"]); // اسم فريد للصورة
            $uploadFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($userImg["tmp_name"], $uploadFilePath)) {
                // Hash password
                $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

                // Insert new user into the database
                $query = "INSERT INTO users (username, password, email, phone, role, user_img) VALUES (:userName, :userPassword, :userEmail, :userPhone, :userRole, :userImg)";
                $statement = $connection->prepare($query);
                $statement->bindParam(':userName', $userName);
                $statement->bindParam(':userPassword', $hashedPassword);
                $statement->bindParam(':userEmail', $userEmail);
                $statement->bindParam(':userPhone', $userPhone);
                $statement->bindParam(':userRole', $userRole);
                $statement->bindParam(':userImg', $uploadFilePath);
                $statement->execute();

                $uploadMessage = "Image uploaded and account created successfully!";
            } else {
                $uploadMessage = "Failed to upload image.";
            }
        } else {
            $uploadMessage = "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $uploadMessage = "Please upload a profile image.";
    }

    // إعادة التوجيه مع رسالة حالة التحميل
    header("location:../regester/register.php?message=" . urlencode($uploadMessage));
    exit();
