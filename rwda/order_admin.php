<?php

require_once '../databasePHP/connection.php';
require_once '../databasePHP/userdata.php';




// التحقق من وجود user_id في الرابط
$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    die("User ID is missing!");
}

// الاستعلام الرئيسي لجلب الطلبات
$query = "
    SELECT
        o.order_id,
        o.order_date,
        o.total_price,
        o.notes,
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

<?php
require_once "../nave/nave.php";
?>

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
                <th>Notes</th>
                <th>Action</th>
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
                    <td><?php echo htmlspecialchars($order['notes'] ?? ''); ?></td>
                    <td>
                        <button class="action-button"
                                onclick="deliverOrder(<?php echo $order['order_id']; ?>)">
                            Deliver
                        </button>
                    </td>
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
