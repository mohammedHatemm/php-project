
<?php


// require_once "connection.php";





//     // استلام البيانات من الطلب
//     $data = json_decode(file_get_contents('php://input'), true);

//     // بدء المعاملة
//     $pdo->beginTransaction();

//     // حساب السعر الإجمالي
//     $total_price = 0;
//     foreach ($data['items'] as $item) {
//         $total_price += $item['price'] * $item['quantity'];
//     }

//     // الحصول على user_id من الجلسة
//     session_start();
//     $user_id = $_SESSION['user_id'] ?? null;

//     if (!$user_id) {
//         throw new Exception("يجب تسجيل الدخول أولاً");
//     }

//     // إدخال الطلب الجديد
//     $sql = "INSERT INTO orders (user_id, total_price, order_date, notes) VALUES (:user_id, :total_price, NOW(), :notes)";
//     $stmt = $pdo->prepare($sql);

//     $stmt->execute([
//         ':user_id' => $user_id,
//         ':total_price' => $total_price,
//         ':notes' => 'طلب جديد'
//     ]);

//     $order_id = $pdo->lastInsertId();

//     // تحديث المنتجات في الطلب
//     $sql = "UPDATE orders SET product_id = :product_id WHERE order_id = :order_id";
//     $stmt = $pdo->prepare($sql);

//     foreach ($data['items'] as $item) {
//         $stmt->execute([
//             ':product_id' => $item['id'],
//             ':order_id' => $order_id
//         ]);
//     }

//     // التحقق من توفر المنتجات (اختياري)
//     $sql = "SELECT product_id, productName FROM products WHERE product_id = :product_id";
//     $stmt = $pdo->prepare($sql);

//     foreach ($data['items'] as $item) {
//         $stmt->execute([':product_id' => $item['id']]);
//         if (!$stmt->fetch()) {
//             throw new Exception("المنتج غير متوفر: " . $item['id']);
//         }
//     }

//     // تأكيد المعاملة
//     $pdo->commit();

//     echo json_encode([
//         'status' => 'success',
//         'order_id' => $order_id,
//         'message' => 'تم إنشاء الطلب بنجاح'
//     ]);

// } catch (PDOException $e) {
//     if (isset($pdo)) {
//         $pdo->rollBack();
//     }
//     echo json_encode([
//         'status' => 'error',
//         'message' => 'خطأ في قاعدة البيانات: ' . $e->getMessage()
//     ]);
// } catch (Exception $e) {
//     if (isset($pdo)) {
//         $pdo->rollBack();
//     }
//     echo json_encode([
//         'status' => 'error',
//         'message' => $e->getMessage()
//     ]);
// }





// session_start();

// require_once "connection.php";

// try {
//     // استلام البيانات من الطلب
//     $data = json_decode(file_get_contents('php://input'), true);

//     // التحقق من وجود البيانات
//     if (empty($data) || !isset($data['items'])) {
//         throw new Exception("بيانات الطلب غير صالحة.");
//     }

//     // بدء المعاملة
//     $pdo->beginTransaction();

//     // حساب السعر الإجمالي
//     $total_price = 0;
//     foreach ($data['items'] as $item) {
//         if (!is_numeric($item['quantity']) || $item['quantity'] <= 0) {
//             throw new Exception("الكمية غير صالحة للمنتج: " . $item['id']);
//         }
//         $total_price += $item['price'] * $item['quantity'];
//     }

//     // الحصول على user_id من الجلسة
//     session_start();
//     $user_id = $_SESSION['user_id'] ?? null;

//     if (!$user_id) {
//         throw new Exception("يجب تسجيل الدخول أولاً");
//     }

//     // إدخال الطلب الجديد
//     $sql = "INSERT INTO orders (user_id, total_price, order_date, notes) VALUES (:user_id, :total_price, NOW(), :notes)";
//     $stmt = $pdo->prepare($sql);

//     $stmt->execute([
//         ':user_id' => $user_id,
//         ':total_price' => $total_price,
//         ':notes' => 'طلب جديد'
//     ]);

//     $order_id = $pdo->lastInsertId();

//     // إدخال تفاصيل الطلب في جدول order_items
//     $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
//     $stmt = $pdo->prepare($sql);

//     foreach ($data['items'] as $item) {
//         $stmt->execute([
//             ':order_id' => $order_id,
//             ':product_id' => $item['id'],
//             ':quantity' => $item['quantity'],
//             ':price' => $item['price']
//         ]);
//     }

//     // التحقق من توفر المنتجات
//     $sql = "SELECT product_id, productName FROM products WHERE product_id = :product_id";
//     $stmt = $pdo->prepare($sql);

//     foreach ($data['items'] as $item) {
//         $stmt->execute([':product_id' => $item['id']]);
//         if (!$stmt->fetch()) {
//             throw new Exception("المنتج غير متوفر: " . $item['id']);
//         }
//     }

//     // تأكيد المعاملة
//     $pdo->commit();

//     echo json_encode([
//         'status' => 'success',
//         'order_id' => $order_id,
//         'total_price' => $total_price,
//         'message' => 'تم إنشاء الطلب بنجاح'
//     ]);

// } catch (PDOException $e) {
//     if (isset($pdo)) {
//         $pdo->rollBack();
//     }
//     http_response_code(500); // Internal Server Error
//     echo json_encode([
//         'status' => 'error',
//         'message' => 'خطأ في قاعدة البيانات: ' . $e->getMessage()
//     ]);
// } catch (Exception $e) {
//     if (isset($pdo)) {
//         $pdo->rollBack();
//     }
//     http_response_code(400); // Bad Request
//     echo json_encode([
//         'status' => 'error',
//         'message' => $e->getMessage()
//     ]);
// }



session_start();
require_once "connection.php";

try {
    // استلام البيانات من الطلب
    $data = json_decode(file_get_contents('php://input'), true);

    // التحقق من وجود البيانات
    if (empty($data) || !isset($data['items'])) {
        throw new Exception("بيانات الطلب غير صالحة.");
    }

    // بدء المعاملة
    $pdo->beginTransaction();

    // حساب السعر الإجمالي
    $total_price = 0;
    foreach ($data['items'] as $item) {
        if (!is_numeric($item['quantity']) || $item['quantity'] <= 0) {
            throw new Exception("الكمية غير صالحة للمنتج: " . $item['id']);
        }
        $total_price += $item['price'] * $item['quantity'];
    }

    // الحصول على user_id من الجلسة
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        throw new Exception("يجب تسجيل الدخول أولاً");
    }

    // إدخال الطلب الجديد
    $sql = "INSERT INTO orders (user_id, total_price, order_date, notes) VALUES (:user_id, :total_price, NOW(), :notes)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':user_id' => $user_id,
        ':total_price' => $total_price,
        ':notes' => 'طلب جديد'
    ]);

    $order_id = $pdo->lastInsertId();

    // إدخال تفاصيل الطلب في جدول order_items
    // $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity, )";
    // $stmt = $pdo->prepare($sql);

    // foreach ($data['items'] as $item) {
    //     $stmt->execute([
    //         ':order_id' => $order_id,
    //         ':product_id' => $item['id'],
    //         ':quantity' => $item['quantity'],
    //     ]);
    // }

    // التحقق من توفر المنتجات
    $sql = "SELECT product_id, productName FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);

    foreach ($data['items'] as $item) {
        $stmt->execute([':product_id' => $item['id']]);
        if (!$stmt->fetch()) {
            throw new Exception("المنتج غير متوفر: " . $item['id']);
        }
    }

    // تأكيد المعاملة
    $pdo->commit();

    echo json_encode([
        'status' => 'success',
        'order_id' => $order_id,
        'total_price' => $total_price,
        'message' => 'تم إنشاء الطلب بنجاح'
    ]);

} catch (PDOException $e) {
    if (isset($pdo)) {
        $pdo->rollBack();
    }
    http_response_code(500); // Internal Server Error
    echo json_encode([
        'status' => 'error',
        'message' => 'خطأ في قاعدة البيانات: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    if (isset($pdo)) {
        $pdo->rollBack();
    }
    http_response_code(400); // Bad Request
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
