 <?php


// session_start();
// require_once "../databasePHP/connection.php"; // تأكد من أن هذا الملف يحتوي على اتصال قاعدة البيانات

// // Register (Signup)
// if (isset($_POST["registerBtn"])) {
//     // $userId = $_POST["userId"];
//     $userName = $_POST["username"] ?? null;
//     $userPassword = $_POST["userpassword"] ?? null;
//     $confirmPassword = $_POST["confirmpassword"] ?? null;
//     $userEmail = $_POST["useremail"] ?? null;
//     $userPhone = $_POST["userphone"] ?? null;
//     $userRole = $_POST["role"] ?? null;
//     $userImg = $_FILES["userimg"] ?? null;

//     if ($userRole === 'user') {
//         $roomNum = $_POST["room_num"] ?? null;
//     } else {
//         $roomNum = null;
//     }

//     // التحقق من تطابق كلمة المرور
//     if ($userPassword !== $confirmPassword) {
//         header("location: ../regester/register.php?message=" . urlencode("Passwords do not match."));
//         exit();
//     }

//     // التحقق من رقم الهاتف
//     if (strlen($userPhone) !== 11 || !ctype_digit($userPhone)) {
//         header("location: ../regester/register.php?message=" . urlencode("Phone number must be exactly 11 digits."));
//         exit();
//     }

//     // التحقق من صحة البريد الإلكتروني
//     if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
//         header("location: ../regester/register.php?message=" . urlencode("Invalid email format."));
//         exit();
//     }

//     // صورة افتراضية
//     $defaultImage = "../uploads/6788ff5b8889c_ss.PNG"; // المسار إلى الصورة الافتراضية

//     // إذا تم تحميل صورة
//     if (isset($userImg) && $userImg["error"] == 0) {
//         $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/jpg"];
//         $fileType = $userImg["type"];

//         if (in_array($fileType, $allowedTypes)) {
//             $uploadDir = "../uploads/";
//             if (!is_dir($uploadDir)) {
//                 mkdir($uploadDir, 0755, true);
//             }

//             $fileName = uniqid() . "_" . basename($userImg["name"]);
//             $uploadFilePath = $uploadDir . $fileName;

//             if (move_uploaded_file($userImg["tmp_name"], $uploadFilePath)) {
//                 $userImagePath = $uploadFilePath; // استخدام الصورة التي تم تحميلها
//             } else {
//                 header("location: ../regester/register.php?message=" . urlencode("Failed to upload image."));
//                 exit();
//             }
//         } else {
//             header("location: ../regester/register.php?message=" . urlencode("Invalid file type. Only JPEG, PNG, and GIF are allowed."));
//             exit();
//         }
//     } else {
//         $userImagePath = $defaultImage; // استخدام الصورة الافتراضية
//     }

//     // Hash password
//     $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

//     // التحقق من وجود المستخدم مسبقًا
//     $checkQuery = "SELECT * FROM users WHERE email = :userEmail OR username = :userName";
//     $checkStatement = $connection->prepare($checkQuery);
//     $checkStatement->bindParam(':userEmail', $userEmail);
//     $checkStatement->bindParam(':userName', $userName);
//     $checkStatement->execute();

//     if ($checkStatement->rowCount() > 0) {
//         header("location: ../regester/register.php?message=" . urlencode("User with this email or username or phone number already exists. or room number already taken."));
//         exit();
//     } else {
//         if ($userRole === 'user' && empty($roomNum)) {
//             header("location:test2.php?message=" . urlencode("The room number is empty"));
//             exit();
//         }

//         // إدخال المستخدم الجديد في قاعدة البيانات
//         $query = "INSERT INTO users (username, password, email, phone, role, user_img, room_num) VALUES (:userName, :userPassword, :userEmail, :userPhone, :userRole, :userImg, :roomNum)";
//         $statement = $connection->prepare($query);

//         $statement->bindParam(':userName', $userName);
//         $statement->bindParam(':userPassword', $hashedPassword);
//         $statement->bindParam(':userEmail', $userEmail);
//         $statement->bindParam(':userPhone', $userPhone);
//         $statement->bindParam(':userRole', $userRole);
//         $statement->bindParam(':userImg', $userImagePath); // استخدام المسار الصحيح للصورة
//         $statement->bindParam(':roomNum', $roomNum);

//         $statement->execute();

//         header("location: ../regester/register.php?message=" . urlencode("Account created successfully!"));
//         exit();
//     }
// } -->




session_start();
require_once "../databasePHP/connection.php"; // تأكد من أن هذا الملف يحتوي على اتصال قاعدة البيانات

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

    // إذا كان المستخدم من نوع "user" يتم أخذ رقم الغرفة، وإلا يكون null
    if ($userRole === 'user') {
        $roomNum = $_POST["room_num"] ?? null;
    } else {
        $roomNum = null; // إذا كان المستخدم "admin" أو أي دور آخر، يكون رقم الغرفة null
    }

    // التحقق من تطابق كلمة المرور
    if ($userPassword !== $confirmPassword) {
        header("location: ../regester/register.php?message=" . urlencode("Passwords do not match."));
        exit();
    }

    // التحقق من رقم الهاتف
    if (strlen($userPhone) !== 11 || !ctype_digit($userPhone)) {
        header("location: ../regester/register.php?message=" . urlencode("Phone number must be exactly 11 digits."));
        exit();
    }

    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../regester/register.php?message=" . urlencode("Invalid email format."));
        exit();
    }

    // صورة افتراضية
    $defaultImage = "../uploads/6788ff5b8889c_ss.PNG"; // المسار إلى الصورة الافتراضية

    // إذا تم تحميل صورة
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
                $userImagePath = $uploadFilePath; // استخدام الصورة التي تم تحميلها
            } else {
                header("location: ../regester/register.php?message=" . urlencode("Failed to upload image."));
                exit();
            }
        } else {
            header("location: ../regester/register.php?message=" . urlencode("Invalid file type. Only JPEG, PNG, and GIF are allowed."));
            exit();
        }
    } else {
        $userImagePath = $defaultImage; // استخدام الصورة الافتراضية
    }

    // Hash password
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    // التحقق من وجود المستخدم مسبقًا
    $checkQuery = "SELECT * FROM users WHERE email = :userEmail OR username = :userName";
    $checkStatement = $connection->prepare($checkQuery);
    $checkStatement->bindParam(':userEmail', $userEmail);
    $checkStatement->bindParam(':userName', $userName);
    $checkStatement->execute();

    if ($checkStatement->rowCount() > 0) {
        header("location: ../regester/register.php?message=" . urlencode("User with this email or username or phone number already exists. or room number already taken."));
        exit();
    } else {
        // إذا كان المستخدم من نوع "user" ولم يتم إدخال رقم الغرفة
        if ($userRole === 'user' && empty($roomNum)) {
            header("location:test2.php?message=" . urlencode("The room number is empty"));
            exit();
        }

        // إدخال المستخدم الجديد في قاعدة البيانات
        $query = "INSERT INTO users (username, password, email, phone, role, user_img, room_num) VALUES (:userName, :userPassword, :userEmail, :userPhone, :userRole, :userImg, :roomNum)";
        $statement = $connection->prepare($query);

        $statement->bindParam(':userName', $userName);
        $statement->bindParam(':userPassword', $hashedPassword);
        $statement->bindParam(':userEmail', $userEmail);
        $statement->bindParam(':userPhone', $userPhone);
        $statement->bindParam(':userRole', $userRole);
        $statement->bindParam(':userImg', $userImagePath); // استخدام المسار الصحيح للصورة
        $statement->bindParam(':roomNum', $roomNum or null); // إذا كان المستخدم "admin" سيكون room_num = null

        $statement->execute();

        header("location: ../regester/register.php?message=" . urlencode("Account created successfully!"));
        exit();
    }
}
