<?php
session_start();
require_once "../databasePHP/connection.php";

// Fetch products from database
$sql = "SELECT product_id, productName, price FROM products";
$stmt = $connection->prepare($sql);
$products = array();

try {
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error fetching products: " . $e->getMessage();
}

// Fetch users from database
$sql = "SELECT user_id, username FROM users WHERE role = 'user'";
$stmt = $connection->prepare($sql);
$users = array();

try {
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error fetching users: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manual Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../rwda/css/style.css">
</head>
<body>

<?php
require_once "../nave/nave.php";
//  include('navbar.html');
//  include('header.php');
?>
    <!-- <nav class="navbar">
        <div>
            <a href="../main-page/main.php">Home</a>
            <a href="../testnew/index.php">Products</a>
            <a href="../menna/allUsers.php">Users</a>
            <a href="../rwda/test2.php">Manual Order</a>
            <a href="#">update products</a>
            <a href="../rwda/check_admin.php">Checks</a>
        </div>
        <div class="admin-icon">
            <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 5px;"></i>
            <span>Admin</span>
            <div class="logout" style="display: flex; align-items: center; margin-left: 15px; cursor: pointer;">
                <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; margin-right: 5px;"></i>
                <span>Log out</span>
            </div>
        </div>
    </nav> -->

    <div class="container">
        <h2>Create Manual Order</h2>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_message']); ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success_message']); ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <form id="orderForm" action="../aseeds/addmanual.php" method="POST">
            <div class="mb-4">
                <label for="user" class="form-label">Select User:</label>
                <select id="user" name="user" class="form-select" required>
                    <option value="">Select a user</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['user_id']; ?>">
                            <?php echo htmlspecialchars($user['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="product" class="form-label">Select Product:</label>
                <select id="product" name="product" class="form-select" required onchange="updatePrice()">
                    <option value="">Select a product</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['product_id']; ?>" data-price="<?php echo $product['price']; ?>">
                            <?php echo htmlspecialchars($product['productName']); ?> - <?php echo $product['price']; ?> LE
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">Enter Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1" required onchange="updatePrice()">
            </div>

            <div class="mb-4">
                <label for="room" class="form-label">Room Number:</label>
                <input type="text" id="room" name="room" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="date" class="form-label">Select Date:</label>
                <input type="datetime-local" id="date" name="date" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="notes" class="form-label">Notes:</label>
                <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Total Price:</label>
                <input type="text" id="totalPrice" class="form-control" readonly>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit Order</button>
            </div>
        </form>
    </div>

    <script>
        function updatePrice() {
            const productSelect = document.getElementById('product');
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            const selectedOption = productSelect.options[productSelect.selectedIndex];

            if (selectedOption && selectedOption.dataset.price) {
                const price = parseFloat(selectedOption.dataset.price);
                const total = price * quantity;
                document.getElementById('totalPrice').value = total.toFixed(2) + ' LE';
            } else {
                document.getElementById('totalPrice').value = '';
            }
        }

        // Initialize price on page load
        document.addEventListener('DOMContentLoaded', updatePrice);
    </script>
</body>
</html>
