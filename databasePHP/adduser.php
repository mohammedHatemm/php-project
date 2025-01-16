<?php
session_start();
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // جمع البيانات من النموذج
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $phone = $_POST['userphone'] ?? null;
    $role = $_POST['role'] ?? 'user';
    $userimg = $_FILES['userimg'] ?? null;

    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:../addUser.php?message=" . urlencode("Invalid email format."));
        exit();
    }

    // تحميل الصورة إذا تم تحميلها
    $uploadFilePath = null;
    if (isset($userimg) && $userimg['error'] == 0) {
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        $fileType = $userimg['type'];

        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = uniqid() . "_" . basename($userimg['name']);
            $uploadFilePath = $uploadDir . $fileName;

            if (!move_uploaded_file($userimg['tmp_name'], $uploadFilePath)) {
                header("location:../addUser.php?message=" . urlencode("Failed to upload image."));
                exit();
            }
        } else {
            header("location:../addUser.php?message=" . urlencode("Invalid file type. Only JPEG, PNG, and GIF are allowed."));
            exit();
        }
    }

    // تشفير كلمة المرور
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // التحقق من عدم وجود مستخدم بنفس البريد الإلكتروني أو اسم المستخدم
    $checkQuery = "SELECT * FROM users WHERE email = :email OR username = :username";
    $checkStatement = $connection->prepare($checkQuery);
    $checkStatement->bindParam(':email', $email);
    $checkStatement->bindParam(':username', $username);
    $checkStatement->execute();

    if ($checkStatement->rowCount() > 0) {
        header("location:../addUser.php?message=" . urlencode("User with this email or username already exists."));
        exit();
    }

    // إدخال المستخدم الجديد في قاعدة البيانات
    $query = "INSERT INTO users (username, password, email, phone, role, user_img) VALUES (:username, :password, :email, :phone, :role, :user_img)";
    $statement = $connection->prepare($query);

    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashedPassword);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':role', $role);
    $statement->bindParam(':user_img', $uploadFilePath);
    $statement->execute();

    header("location:../menna/allUsers.php?message=" . urlencode("User added successfully!"));
    exit();
}
?>
