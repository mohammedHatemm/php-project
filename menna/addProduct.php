

<?php


require_once "../databasePHP/connection.php";



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

?>
    <div class="container">
        <h1>Add Product</h1>
        <form action="saveProduct.php" method="POST">
            <img src="" alt="">
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
