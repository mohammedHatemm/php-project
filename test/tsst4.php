<?php
session_start();
require_once "../databasePHP/connection.php"; // تأكد من أن هذا الملف يحتوي على اتصال قاعدة البيانات

if (isset($_POST["registerBtn"])) {
    $userName = $_POST["username"] ?? null;
    $userPassword = $_POST["userpassword"] ?? null;
    $confirmPassword = $_POST["confirmpassword"] ?? null;
    $userEmail = $_POST["useremail"] ?? null;
    $userPhone = $_POST["userphone"] ?? null;
    $userRole = $_POST["role"] ?? null;
    $userImg = $_FILES["userimg"] ?? null;
    $roomNum = ($userRole === 'user') ? ($_POST["room_num"] ?? null) : null; // رقم الغرفة فقط للمستخدمين

    // التحقق من تطابق كلمة المرور
    if ($userPassword !== $confirmPassword) {
        header("location: ../regester/register.php?message=" . urlencode("كلمة المرور غير متطابقة."));
        exit();
    }

    // التحقق من رقم الهاتف
    if (strlen($userPhone) !== 11 || !ctype_digit($userPhone)) {
        header("location: ../regester/register.php?message=" . urlencode("رقم الهاتف يجب أن يكون 11 رقمًا."));
        exit();
    }

    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../regester/register.php?message=" . urlencode("صيغة البريد الإلكتروني غير صحيحة."));
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
                    header("location: ../regester/register.php?message=" . urlencode("المستخدم موجود مسبقًا."));
                    exit();
                } else {
                    // التحقق من توفر الغرفة
                    if ($userRole === 'user') {
                        if (empty($roomNum)) {
                            header("location: ../regester/register.php?message=" . urlencode("رقم الغرفة مطلوب للمستخدمين."));
                            exit();
                        }

                        // التحقق من توفر الغرفة
                        $roomQuery = "SELECT is_available FROM rooms WHERE room_num = :roomNum";
                        $roomStatement = $connection->prepare($roomQuery);
                        $roomStatement->bindParam(':roomNum', $roomNum);
                        $roomStatement->execute();
                        $room = $roomStatement->fetch(PDO::FETCH_ASSOC);

                        if (!$room || !$room['is_available']) {
                            header("location: ../regester/register.php?message=" . urlencode("الغرفة غير متاحة."));
                            exit();
                        }
                    }

                    // إدخال المستخدم الجديد في قاعدة البيانات
                    $query = "INSERT INTO users (username, password, email, phone, role, user_img, room_num) VALUES (:userName, :userPassword, :userEmail, :userPhone, :userRole, :userImg, :roomNum)";
                    $statement = $connection->prepare($query);

                    $statement->bindParam(':userName', $userName);
                    $statement->bindParam(':userPassword', $hashedPassword);
                    $statement->bindParam(':userEmail', $userEmail);
                    $statement->bindParam(':userPhone', $userPhone);
                    $statement->bindParam(':userRole', $userRole);
                    $statement->bindParam(':userImg', $uploadFilePath);
                    $statement->bindParam(':roomNum', $roomNum);
                    $statement->execute();

                    // تحديث حالة الغرفة إلى "محجوزة"
                    if ($userRole === 'user') {
                        $updateRoomQuery = "UPDATE rooms SET is_available = FALSE WHERE room_num = :roomNum";
                        $updateRoomStatement = $connection->prepare($updateRoomQuery);
                        $updateRoomStatement->bindParam(':roomNum', $roomNum);
                        $updateRoomStatement->execute();
                    }

                    header("location: ../regester/register.php?message=" . urlencode("تم التسجيل بنجاح!"));
                    exit();
                }
            } else {
                header("location: ../regester/register.php?message=" . urlencode("فشل تحميل الصورة."));
                exit();
            }
        } else {
            header("location: ../regester/register.php?message=" . urlencode("نوع الملف غير مدعوم. يُسمح فقط بملفات JPEG, PNG, و GIF."));
            exit();
        }
    } else {
        header("location: ../regester/register.php?message=" . urlencode("يرجى تحميل صورة شخصية."));
        exit();
    }
}
?>
