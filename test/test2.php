<?php
header('Content-Type: application/json; charset=utf-8');

try {
    require_once('../databasePHP/connection.php');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    if (!isset($_POST['user_id']) || !isset($_POST['Product_id']) || !isset($_POST['quantity'])) {
        throw new Exception('Missing required data');
    }

    $user_id = intval($_POST['user_id']);
    $Product_ids = $_POST['Product_id'];
    $quantities = $_POST['quantity'];

    if ($user_id <= 0) {
        throw new Exception('Invalid user ID');
    }

    // بدء المعاملة
    $connection->beginTransaction();

    try {
        // إنشاء الطلب الرئيسي أولاً في جدول order
        $orderStmt = $connection->prepare('
            INSERT INTO order (user_id, DateOrder)
            VALUES (:user_id, NOW())
        ');

        $orderStmt->execute([':user_id' => $user_id]);
        $orderId = $connection->lastInsertId();

        // إضافة المنتجات إلى جدول order_items
        $itemStmt = $connection->prepare('
            INSERT INTO order_items (OrderID, Product_id, quantity)
            VALUES (:OrderID, :Product_id, :quantity)
        ');

        // إضافة كل منتج إلى الطلب
        foreach ($Product_ids as $index => $Product_id) {
            $Product_id = intval($Product_id);
            $quantity = intval($quantities[$index]);

            if ($Product_id <= 0 || $quantity <= 0) {
                throw new Exception('Invalid product data');
            }

            // إضافة المنتج إلى order_items
            $success = $itemStmt->execute([
                ':OrderID' => $orderId,
                ':Product_id' => $Product_id,
                ':quantity' => $quantity
            ]);

            if (!$success) {
                throw new Exception('Failed to insert order item');
            }
        }

        // حساب وتحديث السعر الإجمالي للطلب
        $updateTotalStmt = $connection->prepare('
            UPDATE order o
            SET TotalPrice = (
                SELECT SUM(oi.quantity * p.Price)
                FROM order_items oi
                JOIN products p ON oi.Product_id = p.Product_id
                WHERE oi.OrderID = o.OrderID
            )
            WHERE o.OrderID = :OrderID
        ');

        $updateTotalStmt->execute([':OrderID' => $orderId]);

        $connection->commit();

        echo json_encode([
            'success' => true,
            'message' => 'Order placed successfully',
            'orderId' => $orderId
        ]);

    } catch (Exception $e) {
        $connection->rollBack();
        throw $e;
    }

} catch (Exception $e) {
    error_log('Checkout error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
