<?php
require_once '../databasePHP/connection.php';


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $productId = $_POST['product_id'];
//     $quantity = $_POST['quantity'];
//     $price = $_POST['price'];
//     $totalPrice = $quantity * $price;

    // إضافة عملية الشراء إلى قاعدة البيانات
    // $sql = "INSERT INTO orders (product_id, quantity, total_price) VALUES (:product_id, :quantity, :total_price)";

//     $sql = "INSERT INTO orders (user_id, total_price, order_date, status, notes)
//         VALUES (:user_id, :total_price, NOW(), :status, :notes)";
//     $stmt = $connection->prepare($sql);
//     $stmt->execute([
//         ':product_id' => $productId,
//         ':quantity' => $quantity,
//         ':total_price' => $totalPrice
//     ]);

//     header("Location: products.php");
//     exit();
// }



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // افترض أن user_id يتم الحصول عليه من الجلسة أو من مصدر آخر
   // ملاحظات الطلب

  $productId = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $totalPrice = $quantity * $price;

  // إضافة عملية الشراء إلى جدول الطلبات (orders)
  $sql = "INSERT INTO orders (user_id, total_price, order_date, status, notes)
          VALUES (:user_id, :total_price, NOW(), :status, :notes)";
  $stmt = $connection->prepare($sql);
  $stmt->execute([
      ':user_id' => $user_id,
      ':total_price' => $totalPrice,
      ':status' => $status,
      ':notes' => $notes
  ]);

  // الحصول على معرف الطلب الذي تم إدراجه
  $order_id = $connection->lastInsertId();

  // إضافة المنتج إلى جدول order_items (إذا كان موجودًا)
  $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
          VALUES (:order_id, :product_id, :quantity, :price)";
  $stmt = $connection->prepare($sql);
  $stmt->execute([
      ':order_id' => $order_id,
      ':product_id' => $productId,
      ':quantity' => $quantity,
      ':price' => $price
  ]);

  header("Location: products.php");
  exit();
}
