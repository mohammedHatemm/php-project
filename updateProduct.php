<?php
// بدء الجلسة
session_start();
$categories = ["Beverages", "Snacks", "Desserts"];
// إذا لم تكن مصفوفة المنتجات موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استخراج البيانات من النموذج
    $id = intval($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category']);
    $price = floatval($_POST['price']);

    // البحث عن المنتج وتحديثه
    foreach ($_SESSION['products'] as &$product) {
        if ($product['id'] === $id) {
            $product['name'] = $name;
            $product['category'] = $category;
            $product['price'] = $price;
            break;
        }
    }

    // إعادة التوجيه إلى صفحة index.php
    header("Location: index.php");
    exit();
}
?>