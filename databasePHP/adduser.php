 <?php



// session_start();
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // جمع البيانات من النموذج
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $phone = $_POST['userphone'] ?? null;
    $role = $_POST['role'] ?? 'user';
    $userimg = $_FILES['userimg'] ?? null;
    $roomNum = $_POST["roomnum"] ?? null;


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
    }else {
        $userImagePath = $defaultImage; // استخدام الصورة الافتراضية
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
    $statement->bindParam(':roomNum', $roomNum); // إذا كان المستخدم "admin" سيكون room_num = null

    $statement->execute();

    header("location:../menna/allUsers.php?message=" . urlencode("User added successfully!"));
    exit();
}
?>
