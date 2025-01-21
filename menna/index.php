<?php

session_start();

require_once "../databasePHP/connection.php";
$sql = "SELECT * FROM products";
$result = $connection->query($sql);

$products = array();



if ($result) {
    $products = $result->fetchAll(); // جلب جميع الصفوف كـ array
    if (empty($products)) {
        // إذا لم توجد بيانات
        echo "<p class='text-center text-danger'>لا توجد منتجات في قاعدة البيانات.</p>";
    }
} else {
    // إذا كان هناك خطأ في الاستعلام
    echo "<p class='text-center text-danger'>خطأ في جلب البيانات.</p>";
}

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
    include('navbar.html');
    include('header.php');

    // $products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
    ?>
    <!-- <nav class="navbar">
    <div>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">Users</a>
        <a href="#">Manual Order</a>
        <a href="#">Checks</a>
    </div>
    <div class="admin-icon">
        <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 5px;"></i>
        <span>Admin</span>
        <div class="logout" style="display: flex; align-items: center; margin-left: 15px; cursor: pointer;">
            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; margin-right: 5px;"></i>
            <span>Log out</span>
        </div>
    </div>
</nav> -->
    <div class="container">
        <h1>All Products</h1>
        <a href="addProduct.php" class="btn">Add Product</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>description</th>
                    <th>Price</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['product_id']; ?></td>
                        <td><?php echo $product['productName']; ?></td>
                        <td><?php echo $product['category']; ?></td>
                        <td><?php echo $product['product_description'] ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>
