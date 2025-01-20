<?php
session_start();
require_once '../databasePHP/connection.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Fetch all orders with user and product details
$sql = "SELECT o.*, u.username, p.productName, p.price as unit_price
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.user_id
        LEFT JOIN products p ON o.product_id = p.product_id
        ORDER BY o.order_date DESC";
$stmt = $connection->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .order-status-pending { color: #ffc107; }
        .order-status-completed { color: #28a745; }
        .order-status-cancelled { color: #dc3545; }

        .table-responsive {
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .dashboard-header {
            background: #f8f9fa;
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid #dee2e6;
        }

        .stats-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .order-filters {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-coffee me-2"></i>
                Becoffee Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../products/products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../users/users.php">Users</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-link" href="../logout.php">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <h1 class="h3">Order Management</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Total Orders</h5>
                    <h2><?php echo count($orders); ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Total Revenue</h5>
                    <h2>$<?php
                        echo number_format(array_sum(array_column($orders, 'total_price')), 2);
                    ?></h2>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order):
                        // Extract quantity from notes
                        preg_match('/Quantity: (\d+)/', $order['notes'], $matches);
                        $quantity = isset($matches[1]) ? $matches[1] : 1;
                    ?>
                    <tr>
                        <td>#<?php echo $order['order_id']; ?></td>
                        <td><?php echo htmlspecialchars($order['username']); ?></td>
                        <td><?php echo htmlspecialchars($order['productName']); ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                        <td><?php echo date('Y-m-d H:i', strtotime($order['order_date'])); ?></td>
                        <td><?php echo htmlspecialchars($order['notes']); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-success"
                                        onclick="updateOrderStatus(<?php echo $order['order_id']; ?>, 'completed')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger"
                                        onclick="updateOrderStatus(<?php echo $order['order_id']; ?>, 'cancelled')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function updateOrderStatus(orderId, status) {
            try {
                const response = await fetch('update_order_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        status: status
                    })
                });

                const result = await response.json();
                if (result.status === 'success') {
                    location.reload();
                } else {
                    alert('Error updating order status');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('System error occurred');
            }
        }
    </script>
</body>
</html>
