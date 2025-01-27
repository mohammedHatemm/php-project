 <?php
session_start();
require_once "../databasePHP/connection.php";



// Login
if (isset($_POST["btnLogin"])) {
    $userEmail = $_POST["useremail"] ?? null;
    $userPassword = $_POST["userpassword"] ?? null;

    // التحقق من بيانات تسجيل الدخول
    $query = "SELECT * FROM users WHERE email = :userEmail";
    $statement = $connection->prepare($query);
    $statement->bindParam(':userEmail', $userEmail);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($userPassword, $result["password"])) {
        // تخزين بيانات المستخدم في الجلسة
        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["user_role"] = $result["role"]; // تخزين دور المستخدم

        // إعادة التوجيه بناءً على الدور
        if ($result["role"] === "admin") {
            header("location:../menna/allUsers.php");
        } else {
            header("location: ../test/test.php"); // لوحة تحكم المستخدمين
        }
        exit();
    } else {
        header("location: ../login/login.php?message=" . urlencode("Invalid email or password, please try again."));
        exit();
    }
}
