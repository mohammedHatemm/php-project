
<?php
// بدء الجلسة
session_start();
$products = [
    ["id" => 1, "name" => "Coffee", "category" => "Beverages", "price" => 10.50],
    ["id" => 2, "name" => "Cake", "category" => "Desserts", "price" => 15.00],
];
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// استرجاع بيانات المنتجات من الجلسة
$products = $_SESSION['products'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\allProducts.css">
    <title>All Products</title>
</head>
<body>
<?php
include('navbar.html') ;
include('header.php');
// بيانات وهمية للمنتجات
$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
?>
    <div class="container">
        <h1>All Products</h1>
        <a href="addProduct.php" class="btn">Add Product</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['category']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td>
                            <a href="editProduct.php?id=<?php echo $product['id']; ?>" class="btn">Edit</a>
                            <a href="deleteProduct.php?id=<?php echo $product['id']; ?>" class="btn delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>