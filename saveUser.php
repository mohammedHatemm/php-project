<?php
// بيانات وهمية (بدون قاعدة بيانات)
session_start();
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استخراج البيانات من النموذج
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور
    $role = htmlspecialchars($_POST['role']);

    // إنشاء مستخدم جديد
    $newUser = [
        "id" => count($_SESSION['users']) + 1,
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "role" => $role
    ];

    // إضافة المستخدم إلى الجلسة
    array_push($_SESSION['users'], $newUser);

    // إعادة التوجيه إلى صفحة allUsers.php
    header("Location: allUsers.php");
    exit();
}
?>