<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\addCategory.css">
    <title>Add Category</title>
</head>
<body>
    <div class="container">
        <h1>Add Category</h1>
        <form action="saveCategory.php" method="POST">
            <label for="name">Category Name:</label>
            <input type="text" name="name" required>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>