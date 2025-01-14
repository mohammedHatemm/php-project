<?php
// بيانات وهمية (بدون قاعدة بيانات)
session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استخراج البيانات من النموذج
    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category']);
    $price = floatval($_POST['price']);

    // إنشاء منتج جديد
    $newProduct = [
        "id" => count($_SESSION['products']) + 1,
        "name" => $name,
        "category" => $category,
        "price" => $price
    ];

    // إضافة المنتج إلى الجلسة
    array_push($_SESSION['products'], $newProduct);

    // إعادة التوجيه إلى صفحة index.php
    header("Location: index.php");
    exit();
}
?>