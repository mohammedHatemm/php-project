
<?php
// بدء الجلسة
session_start();
$categories = ["Beverages", "Snacks", "Desserts"];
// إذا لم تكن مصفوفة الفئات موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استخراج البيانات من النموذج
    $name = htmlspecialchars($_POST['name']);

    // إضافة الفئة إلى الجلسة (كنص وليس كمصفوفة)
    array_push($_SESSION['categories'], $name);

    // إعادة التوجيه إلى صفحة addProduct.php
    header("Location: addProduct.php");
    exit();
}
?>