<?php

session_start();
$categories = ["Beveragees", "snacks", "Desserts"];

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

     
    foreach ($_SESSION['products'] as $key => $product) {
        if ($product['id'] === $id) {
            unset($_SESSION['products'][$key]); 
            break;
        }
    }

  
    $_SESSION['products'] = array_values($_SESSION['products']);
}

header("Location: index.php");
exit();
?>