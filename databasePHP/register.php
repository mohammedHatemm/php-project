<?php
session_start();
require_once "../databasePHP/connection.php";
 // تأكد من أن هذا الملف يحتوي على اتصال قاعدة البيانات

// Register (Signup)
if (isset($_POST["registerBtn"])) {
    // $userId = $_POST["userId"];
    $userName = $_POST["username"] ?? null;
    $userPassword = $_POST["userpassword"] ?? null;
    $confirmPassword = $_POST["confirmpassword"] ?? null;
    $userEmail = $_POST["useremail"] ?? null;
    $userPhone = $_POST["userphone"] ?? null;
    $userRole = $_POST["role"] ?? null;
    $userImg = $_FILES["userimg"] ?? null;

    // التحقق من تطابق كلمة المرور
    if ($userPassword !== $confirmPassword) {
        header("location: ../regester/register.php?message=" . urlencode("Passwords do not match."));
        exit();
    }
// التحقق من رفم الهاتف
    if (strlen($userPhone) !== 11 || !ctype_digit($userPhone)) {
      header("location: ../regester/register.php?message=" . urlencode("Phone number must be exactly 11 digits."));
      exit();
  }





    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../regester/register.php?message=" . urlencode("Invalid email format."));
        exit();
    }

    // التحقق من صحة الصورة
    if (isset($userImg) && $userImg["error"] == 0) {
      $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/jpg"];
        $fileType = $userImg["type"];

        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = uniqid() . "_" . basename($userImg["name"]);
            $uploadFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($userImg["tmp_name"], $uploadFilePath)) {
                // Hash password
                $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

                // التحقق من وجود المستخدم مسبقًا
                $checkQuery = "SELECT * FROM users WHERE email = :userEmail OR username = :userName";
                $checkStatement = $connection->prepare($checkQuery);
                $checkStatement->bindParam(':userEmail', $userEmail);
                $checkStatement->bindParam(':userName', $userName);
                $checkStatement->execute();

                if ($checkStatement->rowCount() > 0) {
                    header("location: ../regester/register.php?message=" . urlencode("User with this email or username already exists."));
                    exit();
                } else {
                    // إدخال المستخدم الجديد في قاعدة البيانات
                    $query = "INSERT INTO users (    username, password, email, phone, role, user_img) VALUES (:userName, :userPassword, :userEmail, :userPhone, :userRole, :userImg  )";
                    $statement = $connection->prepare($query);

                    $statement->bindParam(':userName', $userName);
                    $statement->bindParam(':userPassword', $hashedPassword);
                    //  $statement -> bindParam(':confirmPassword' ,$confirmpassword);


                    $statement->bindParam(':userEmail', $userEmail);
                    $statement->bindParam(':userPhone', $userPhone);
                    $statement->bindParam(':userRole', $userRole);
                    $statement->bindParam(':userImg', $uploadFilePath);
                    $statement->execute();

                    header("location: ../regester/register.php?message=" . urlencode("Image uploaded and account created successfully!"));
                    exit();
                }
            } else {
                header("location: ../regester/register.php?message=" . urlencode("Failed to upload image."));
                exit();
            }
        } else {
            header("location: ../regester/register.php?message=" . urlencode("Invalid file type. Only JPEG, PNG, and GIF are allowed."));
            exit();
        }
    } else {
        header("location: ../regester/register.php?message=" . urlencode("Please upload a profile image."));
        exit();
    }
}






// // Login
// if (isset($_POST["btnLogin"])) {
//     $userEmail = $_POST["useremail"] ?? null;
//     $userPassword = $_POST["userpassword"] ?? null;
//     $encryptedPassword = md5($userPassword);

//     // التحقق من بيانات تسجيل الدخول
//     $query = "SELECT * FROM users WHERE email = :userEmail AND password = :userPassword";
//     $statement = $connection->prepare($query);
//     $statement->bindParam(':userEmail', $userEmail);
//     $statement->bindParam(':userPassword', $encryptedPassword);
//     $statement->execute();
//     $result = $statement->fetch(PDO::FETCH_ASSOC);

//     if ($result) {
//         $_SESSION["user_id"] = $result[" user_id"];
//         $_SESSION["username"] = $result["username"];
//         header("location: ../main-page/main.html");
//         exit();
//     } else {
//         header("location: ../login/login.php?message=" . urlencode("Invalid email or password, please try again."));
//         exit();
//     }
// }
