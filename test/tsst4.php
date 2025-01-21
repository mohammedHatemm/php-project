<?php
require_once "../databasePHP/connection.php";

// Fetch distinct categories from the products table
$sql = "SELECT DISTINCT category FROM products";
$result = $connection->query($sql);
$categories = array();

if ($result) {
    $categories = $result->fetchAll(PDO::FETCH_ASSOC);
    if (empty($categories)) {
        echo "<p class='text-center text-danger'>No categories found in the database.</p>";
    }
} else {
    // If there is an error in the query execution
    echo "<p class='text-center text-danger'>Error: Unable to fetch categories.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addProduct.css">
    <title>Add Product</title>
</head>
<body>
    <?php
    include('navbar.html');
    include('header.php');
    ?>

    <div class="container">
        <h1>Add Product</h1>
        <form action="../databasePHP/addproduct.php" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>

            <label for="category">Category:</label>
            <select name="category" required>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['category']); ?>">
                            <?php echo htmlspecialchars($category['category']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No categories available</option>
                <?php endif; ?>
            </select>

            <label for="description">Description:</label>
            <textarea name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required>

            <label for="image">Product Image:</label>
            <input type="file" name="image" accept="image/*" >

            <button type="submit" class="btn">Save</button>
        </form>
        <a href="index.php" class="btn">Add product</a>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
