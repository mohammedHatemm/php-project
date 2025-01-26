<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color:#adb5bd ;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #87CEEB;
            padding: 1rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .admin-icon {
            display: flex;
            align-items: center;
        }

        .admin-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .table-container {
            margin: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table thead {
            background-color: #87CEEB;
            color: white;
            text-align: center;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }

        .action-button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-button:hover {
            background-color: #5a6268;
        }

        .total {
            font-weight: bold;
            color: #6c757d;
        }

        .product-table {
            margin-top: 10px;
            display: none;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 10px;
        }

        .product-table table {
            width: 100%;
        }

        .product-table table th, .product-table table td {
            text-align: left;
            padding: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">Users</a>
        <a href="#"><a href="manual_order.html">Manual Order</a>
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
            <tr>
                <td>2025/01/14 11:00 AM</td>
                <td>Menna Mohamed</td>
                <td>
                    <button class="action-button" onclick="toggleProducts('product-list-2')">View Products</button>
                </td>
                <td>2010</td>
                <td>6510</td>
                <td class="total">50 LE</td>
                <td>
                    <button class="action-button">Deliver</button>
                </td>
            </tr>
        </tbody>
    </table>
    
    <!-- Hidden product details for the first order -->
    <div id="product-list-1" class="product-table">
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
    </div>

    <!-- Hidden product details for the second order -->
    <div id="product-list-2" class="product-table">
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
</html>
