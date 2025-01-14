<?php
// بدء الجلسة
session_start();

// إذا لم تكن مصفوفة المستخدمين موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // تحويل الـ ID إلى عدد صحيح

    // البحث عن المستخدم وحذفه
    foreach ($_SESSION['users'] as $key => $user) {
        if ($user['id'] === $id) {
            unset($_SESSION['users'][$key]); // حذف المستخدم
            break;
        }
    }

    // إعادة ترتيب المفاتيح في المصفوفة
    $_SESSION['users'] = array_values($_SESSION['users']);
}

// إعادة التوجيه إلى صفحة allUsers.php
header("Location: allUsers.php");
exit();
?>