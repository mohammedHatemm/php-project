<?php
// بدء الجلسة
session_start();
$categories = ["Beverages", "Snacks", "Desserts"];
// إذا لم تكن مصفوفة المنتجات موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // تحويل الـ ID إلى عدد صحيح

    // البحث عن المنتج وحذفه
    foreach ($_SESSION['products'] as $key => $product) {
        if ($product['id'] === $id) {
            unset($_SESSION['products'][$key]); // حذف المنتج
            break;
        }
    }

    // إعادة ترتيب المفاتيح في المصفوفة
    $_SESSION['products'] = array_values($_SESSION['products']);
}

// إعادة التوجيه إلى صفحة index.php
header("Location: index.php");
exit();
?>