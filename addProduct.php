

<?php
// بدء الجلسة
session_start();

$categories = ["Beverages", "Snacks", "Desserts"];
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = ["Beverages", "Snacks", "Desserts"];
}

// استرجاع بيانات الفئات من الجلسة
$categories = $_SESSION['categories'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\addProduct.css">
    <title>Add Product</title>
</head>
<body>
<?php
 include('navbar.html') ;
include('header.php');
// بيانات وهمية للمنتجات
$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
?>
    <div class="container">
        <h1>Add Product</h1>
        <form action="saveProduct.php" method="POST">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>
            <label for="category">Category:</label>
            <select name="category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required>
            <button type="submit" class="btn">Save</button>
        </form>
        <a href="addCategory.php" class="btn">Add Category</a>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>