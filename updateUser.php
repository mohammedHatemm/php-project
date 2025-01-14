<?php
// بدء الجلسة
session_start();

// إذا لم تكن مصفوفة المستخدمين موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استخراج البيانات من النموذج
    $id = intval($_POST['id']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    // البحث عن المستخدم وتحديثه
    foreach ($_SESSION['users'] as &$user) {
        if ($user['id'] === $id) {
            $user['username'] = $username;
            $user['email'] = $email;
            $user['role'] = $role;
            break;
        }
    }

    // إعادة التوجيه إلى صفحة allUsers.php
    header("Location: allUsers.php");
    exit();
}
?>