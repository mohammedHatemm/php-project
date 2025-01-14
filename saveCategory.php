
<?php

session_start();
$categories = ["Beverages", "Snacks", "Desserts"];

if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars($_POST['name']);

    array_push($_SESSION['categories'], $name);

    header("Location: addProduct.php");
    exit();
}
?>