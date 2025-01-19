<?php
require_once '../databasePHP/connection.php';

session_start();

// التحقق من أن الطلب هو POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // قراءة البيانات المرسلة
    $json = file_get_contents('php://input');
    $cart = json_decode($json, true);

    if (is_array($cart)) {
        try {
            // بدء معاملة (transaction) لضمان سلامة البيانات
            $connection->beginTransaction();

            // حساب المجموع الكلي للطلب
            $totalPrice = array_reduce($cart, function($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            // إدراج الطلب في جدول الطلبات
            $stmt = $connection->prepare("INSERT INTO orders (user_id, total_price, order_date) VALUES (:user_id, :total_price, NOW())");
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'], // يمكنك تعديل هذا ليتناسب مع نظام المستخدمين الخاص بك
                ':total_price' => $totalPrice
            ]);

            $orderId = $connection->lastInsertId(); // الحصول على معرف الطلب الجديد

            // إدراج تفاصيل الطلب في جدول تفاصيل الطلبات
            $stmt = $connection->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
            foreach ($cart as $item) {
                $stmt->execute([
                    ':order_id' => $orderId,
                    ':product_id' => $item['id'],
                    ':quantity' => $item['quantity'],
                    ':price' => $item['price']
                ]);
            }

            // إتمام المعاملة
            $connection->commit();

            // إرسال استجابة نجاح
            echo json_encode(['success' => true, 'message' => 'تمت عملية الطلب بنجاح.']);
        } catch (PDOException $e) {
            // التراجع عن المعاملة في حالة حدوث خطأ
            $connection->rollBack();
            echo json_encode(['success' => false, 'message' => 'خطأ في قاعدة البيانات: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'بيانات غير صالحة.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'طريقة الطلب غير صالحة.']);
}
