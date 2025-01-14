<?php

session_start();
$categories = ["Beverages", "Snacks", "Desserts"];

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $id = intval($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category']);
    $price = floatval($_POST['price']);

    foreach ($_SESSION['products'] as &$product) {
        if ($product['id'] === $id) {
            $product['name'] = $name;
            $product['category'] = $category;
            $product['price'] = $price;
            break;
        }
    }


    header("Location: index.php");
    exit();
}
?>