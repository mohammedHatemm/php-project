<?php
// بدء الجلسة
session_start();
$categories = ["Beverages", "Snacks", "Desserts"];
// إذا لم تكن مصفوفة المنتجات موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// إذا لم تكن مصفوفة الفئات موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = ["Beverages", "Snacks", "Desserts"];
}

// استرجاع بيانات الفئات من الجلسة
$categories = $_SESSION['categories'];

// البحث عن المنتج المطلوب بناءً على الـ ID
$product = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // تحويل الـ ID إلى عدد صحيح

    foreach ($_SESSION['products'] as $p) {
        if ($p['id'] === $id) {
            $product = $p;
            break;
        }
    }
}

// إذا لم يتم العثور على المنتج، قم بإعادة التوجيه إلى صفحة index.php
if (!$product) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addProduct.css">
    <title>Edit Product</title>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>
        <form action="updateProduct.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <label for="name">Product Name:</label>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
            <label for="category">Category:</label>
            <select name="category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category; ?>" <?php echo ($category === $product['category']) ? 'selected' : ''; ?>>
                        <?php echo $category; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>