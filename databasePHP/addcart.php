<?php
 session_start();
require_once 'connection.php';

header('Content-Type: application/json');

try {
    // Get the raw POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['cart']) || empty($data['cart'])) {
        throw new Exception('Cart data is empty');
    }

    // Start transaction
    $connection->beginTransaction();

    // Calculate total price from cart items
    $totalPrice = array_reduce($data['cart'], function($sum, $item) {
        return $sum + ($item['price'] * $item['quantity']);
    }, 0);

    // Insert main order
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $orderDate = date('Y-m-d H:i:s');

    $orderSql = "INSERT INTO orders (user_id, total_price, order_date,quantity, notes, product_id)
                 VALUES (?, ?, ?,?, ?, ?)";

    $orderStmt = $connection->prepare($orderSql);
    foreach ($data['cart'] as $item) {
        $notes = "Quantity: " . $item['quantity']; // You can customize this

        $orderStmt->execute([
            $userId,
            $item['price'] * $item['quantity'],
            $orderDate,
            $item['quantity'],
            $notes,
            $item['id']
        ]);
    }

    // Commit the transaction
    $connection->commit();

    echo json_encode([
        'status' => 'success',
        'message' => 'Order placed successfully'
    ]);

} catch (Exception $e) {
    // Rollback transaction on error
    if ($connection->inTransaction()) {
        $connection->rollBack();
    }

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
