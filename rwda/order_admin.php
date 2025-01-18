



<!--
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

<nav class="navbar">
    <div>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">Users</a>
        <a href="#">Manual Order</a>
        <a href="#">Checks</a>
    </div>

    <div class="admin-icon">
        <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 5px;"></i>
        <span>Admin</span>
        <div class="logout" style="display: flex; align-items: center; margin-left: 15px; cursor: pointer;">
            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; margin-right: 5px;"></i>
            <span>Log out</span>
        </div>
    </div>
</nav>

<div class="table-container">
    <h2 class="text-center mb-4">Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Name</th>
                <th>Items</th>
                <th>Room</th>
                <th>Ext</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2025/01/14 10:30 AM</td>
                <td>Rawda ramadan</td>
                <td>
                    <button class="action-button" onclick="toggleProducts('product-list-1')">View Products</button>
                </td>
                <td>2006</td>
                <td>6506</td>
                <td class="total">34 LE</td>
                <td>
                    <button class="action-button">Deliver</button>
                </td>
            </tr>

        </tbody>
    </table> -->

    <!-- Hidden product details for the first order -->
    <!-- <div id="product-list-1" class="product-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tea</td>
                    <td>2</td>
                    <td>5 LE</td>
                </tr>
                <tr>
                    <td>Coffee</td>
                    <td>1</td>
                    <td>6 LE</td>
                </tr>
                <tr>
                    <td>Nescafe</td>
                    <td>1</td>
                    <td>8 LE</td>
                </tr>
                <tr>
                    <td>Cola</td>
                    <td>1</td>
                    <td>10 LE</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right"><strong>Total</strong></td>
                    <td><strong>34 LE</strong></td>
                </tr>
            </tfoot>
        </table>
    </div> -->

    <!-- Hidden product details for the second order -->
    <!-- <div id="product-list-2" class="product-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cappuccino</td>
                    <td>1</td>
                    <td>20 LE</td>
                </tr>
                <tr>
                    <td>Sandwich</td>
                    <td>1</td>
                    <td>30 LE</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right"><strong>Total</strong></td>
                    <td><strong>50 LE</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleProducts(productId) {
        const productList = document.getElementById(productId);
        if (productList.style.display === "none") {
            productList.style.display = "block";
        } else {
            productList.style.display = "none";
        }
    }
</script>

</body>
</html> -->





<?php
require_once '../databasePHP/connection.php';
require_once '../databasePHP/userdata.php';

// جلب البيانات من قاعدة البيانات

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

<nav class="navbar">
    <div>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">Users</a>
        <a href="#">Manual Order</a>
        <a href="#">Checks</a>
    </div>

    <div class="admin-icon">
        <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 5px;"></i>
        <span>Admin</span>
        <div class="logout" style="display: flex; align-items: center; margin-left: 15px; cursor: pointer;">
            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; margin-right: 5px;"></i>
            <span>Log out</span>
        </div>
    </div>
</nav>

<div class="table-container">
    <h2 class="text-center mb-4">Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Name</th>
                <th>Items</th>
                <th>Room</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['user_name']; ?></td>
                    <td>
                        <button class="action-button" onclick="toggleProducts('product-list-<?php echo $order['order_id']; ?>')">View Products</button>
                    </td>
                    <td><?php echo $order['room_number']; ?></td>
                    <td class="total"><?php echo $order['total_price']; ?> LE</td>
                    <td>
                        <?php if ($order['status'] == 'pending'): ?>
                            <button class="action-button" onclick="deliverOrder(<?php echo $order['order_id']; ?>)">Deliver</button>
                        <?php else: ?>
                            <span class="text-success">Delivered</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- تفاصيل المنتجات -->
    <?php foreach ($orders as $order): ?>
        <div id="product-list-<?php echo $order['order_id']; ?>" class="product-table" style="display: none;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // جلب تفاصيل المنتجات للطلب الحالي
                    $order_id = $order['order_id'];
                    $product_query = "
                        SELECT
                            p.productName,
                            od.quantity,
                            p.price
                        FROM
                            order_details od
                        JOIN
                            products p ON od.product_id = p.product_id
                        WHERE
                            od.order_id = :order_id;
                    ";
                    $product_statement = $connection->prepare($product_query);
                    $product_statement->bindParam(':order_id', $order_id);
                    $product_statement->execute();
                    $products = $product_statement->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['productName']; ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td><?php echo $product['price']; ?> LE</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right"><strong>Total</strong></td>
                        <td><strong><?php echo $order['total_price']; ?> LE</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleProducts(productId) {
        const productList = document.getElementById(productId);
        if (productList.style.display === "none") {
            productList.style.display = "block";
        } else {
            productList.style.display = "none";
        }
    }

    function deliverOrder(orderId) {
        if (confirm("Are you sure you want to deliver this order?")) {
            fetch(`deliver_order.php?order_id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Order delivered successfully!");
                        location.reload(); // إعادة تحميل الصفحة
                    } else {
                        alert("Failed to deliver order.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>

</body>
</html>
