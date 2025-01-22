<?php
session_start();
require_once "../databasePHP/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user'] ?? null;
    $product_id = $_POST['product'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;
    $room_number = $_POST['room'] ?? null;
    $order_date = $_POST['date'] ?? null;
    $notes = $_POST['notes'] ?? '';

    // Validate inputs
    if (empty($user_id) || empty($product_id) || empty($room_number) || empty($order_date)) {
        $_SESSION['error_message'] = "Please fill all required fields!";
        header("Location: manual_order.php");
        exit;
    }

    try {
        // Get product price
        $price_query = "SELECT price FROM products WHERE product_id = :product_id";
        $stmt = $connection->prepare($price_query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $total_price = $product['price'] * $quantity;

            // Insert order
            $query = "INSERT INTO orders (user_id, product_id, total_price, order_date,quantity, notes)
                     VALUES (:user_id, :product_id, :total_price, :order_date,:quantity, :notes)";
            $stmt = $connection->prepare($query);

            $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                ':total_price' => $total_price,
                ':order_date' => $order_date,
                ':quantity' => $quantity,
                ':notes' => $notes
            ]);

            $_SESSION['success_message'] = "Order saved successfully!";
        } else {
            $_SESSION['error_message'] = "Selected product not found!";
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error saving order: " . $e->getMessage();
    }

    header("Location:../rwda/test2.php");
    exit;
}
?>
