<?php
session_start();
require_once "../databasePHP/connection.php";

// التحقق من وجود user_id في الجلسة
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("User ID is missing in session!");
}

// الاستعلام الرئيسي لجلب الطلبات
$query = "
    SELECT
        o.order_id,
        o.order_date,
        o.total_price,
        o.notes,
        o.quantity,  -- إضافة حقل الكمية
        u.username,
        u.room_num,
        p.productName,
        p.price,
        p.product_id
    FROM
        orders o
        JOIN users u ON o.user_id = u.user_id
        JOIN products p ON o.product_id = p.product_id
    WHERE
        o.user_id = :user_id
    ORDER BY
        o.order_date DESC
";

try {
    $statement = $connection->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error fetching orders: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/order_admin.css">
</head>
<body>
<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="css/navbar.css" />
    <link href="https://fonts.googleapis.com/css?family=Odibee+Sans&display=swap" rel="style.css">
    <link rel="stylesheet" href="../nave/nave.css" class="css">

    <div class="nav-bar">
        <div class="left-nav">
            <a href="../main-page/main.php">Home</a>
            <span>|</span>
            <a href="../testnew/index.php">menue</a>

            
        </div>


                <a id="logOut" href="../menna/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
            </div>
        </div>
    </div>





</html>


    <div class="table-container">
        <h2 class="text-center mb-4">Orders for User ID: <?php echo htmlspecialchars($user_id); ?></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Room</th>
                    <th>Total</th>
                    <th>Quantity</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(date('Y/m/d H:i A', strtotime($order['order_date']))); ?></td>
                        <td><?php echo htmlspecialchars($order['username']); ?></td>
                        <td><?php echo htmlspecialchars($order['productName']); ?></td>
                        <td><?php echo htmlspecialchars($order['room_num']); ?></td>
                        <td class="total"><?php echo htmlspecialchars($order['total_price']); ?> LE</td>
                        <td><?php echo htmlspecialchars($order['quantity'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($order['notes'] ?? ''); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function deliverOrder(orderId) {
            if (confirm("Are you sure you want to deliver this order?")) {
                try {
                    const response = await fetch(`deliver_order.php?order_id=${orderId}`);
                    const data = await response.json();
                    if (data.success) {
                        alert("Order delivered successfully!");
                        location.reload();
                    } else {
                        alert(data.message || "Failed to deliver order.");
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert("Error processing request.");
                }
            }
        }
    </script>
</body>
</html>
