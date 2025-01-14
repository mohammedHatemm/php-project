<?php

session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category']);
    $price = floatval($_POST['price']);

    
    $newProduct = [
        "id" => count($_SESSION['products']) + 1,
        "name" => $name,
        "category" => $category,
        "price" => $price
    ];

    
    array_push($_SESSION['products'], $newProduct);

    
    header("Location: index.php");
    exit();
}
?>