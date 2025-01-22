<?php
session_start();
require_once '../databasePHP/connection.php';
// require_once "../databasePHP/addcart.php";


// تهيئة السلة إذا لم تكن موجودة
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// جلب البيانات من جدول المنتجات
$sql = "SELECT * FROM products";
$stmt = $connection->query($sql);

$products = array(); // مصفوفة لتخزين المنتجات

// التحقق من وجود بيانات
if ($stmt) {
    $products = $stmt->fetchAll(); // جلب جميع الصفوف كـ array
    if (empty($products)) {
        // إذا لم توجد بيانات
        echo "<p class='text-center text-danger'> no products in database</p>";
    }
} else {
    // إذا كان هناك خطأ في الاستعلام
    echo "<p class='text-center text-danger'>error</p>";
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Becoffee - Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="mostafa.css" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <span class="logo-text">Becoffee</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="../test/test.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>


                <div class="nav-icons">
                    <a href="#" class="nav-link d-inline-block me-3" onclick="toggleCart()">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count-overlay" class="badge bg-primary">0</span>
                    </a>
                <div class="dropdown">
    <a href="#" class="nav-link d-inline-block dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="../menna/allUsers.php">admin</a></li>
        <li><a class="dropdown-item" href="../testnew/userorder.php">user</a></li>
        <li><a class="dropdown-item" href="../menna/logout.php">logout</a></li>
    </ul>
</div>
</div>

            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="products-header">
        <div class="container">
            <div class="text-center py-5">
                <h1 class="display-4 fw-bold text-gradient">Our Menu</h1>
                <div class="section-divider"></div>
                <p class="lead text-light">Discover our premium selection of beverages and treats</p>
            </div>
        </div>
    </header>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter-buttons mb-4">
                        <button type="button" class="btn btn-filter active" data-filter="all">All Items</button>
                        <button type="button" class="btn btn-filter" data-filter="hot">Hot Drinks</button>
                        <button type="button" class="btn btn-filter" data-filter="cold">Cold Drinks</button>
                        <button type="button" class="btn btn-filter" data-filter="dessert">Desserts</button>
                    </div>
                    <div class="row g-4" id="products-container">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card product-card">
                                        <img src="../product-img/<?php echo $product['product_img']; ?>" class="card-img-top" style="min-height: 200px;max-height: 200px;" alt="<?php echo $product['productName']; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product['productName']; ?></h5>
                                            <p class="card-text"><?php echo $product['product_description']; ?></p>
                                            <p class="card-text"><strong>Price: <?php echo $product['price']; ?> $</strong></p>
                                            <button class="btn btn-primary" style="width: 100%;" onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo $product['productName']; ?>', <?php echo $product['price']; ?>)">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <p class="text-center text-warning">No products available.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-4 footer-title">Hotel Cafeteria</h5>
                    <p class="mb-3">We provide the best food and drinks in a luxurious and comfortable atmosphere.</p>
                    <div class="footer-info">
                        <p class="mb-2"><i class="fas fa-phone me-2"></i>Phone: 123-456-789</p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i>Email: info@hotelcafeteria.com</p>
                        <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Address: Main Hotel Street</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-4 footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="../products/products.html">Food List</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-4 footer-title">Working Hours</h5>
                    <div class="footer-hours mb-4">
                        <p class="mb-2">All days of the week</p>
                        <p class="mb-2">From 7 am to 11 pm</p>
                        <p class="mb-3">Room service: 24/7</p>
                    </div>
                    <h5 class="mb-3 footer-title">Follow Us On</h5>
                    <div class="social-icons">
                        <a href="#" class="me-4" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-4" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-4" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-4" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="footer-bottom text-center">
                        <p class="mb-0">All rights reserved &copy; 2024 Hotel Cafeteria</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Overlay -->
    <div class="cart-overlay" id="cartOverlay">
        <div class="cart-sidebar-overlay">
            <div class="cart-header">
                <h4><i class="fas fa-shopping-cart me-2"></i>Your Cart <span id="cart-count-overlay" class="badge bg-primary ms-2">0</span></h4>
                <button class="btn-close-cart" onclick="toggleCart()"><i class="fas fa-times"></i></button>
            </div>
            <div class="cart-body">
                <div id="cart-items-overlay" class="cart-items"></div>
                <div class="cart-total">
                    <h5>Total: <span id="cart-total-overlay">0</span> $</h5>
                </div>
                <button class="btn btn-primary w-100" onclick="showCheckoutMessage()">Checkout <i class="fas fa-arrow-right ms-2"></i></button>
            </div>
        </div>
    </div>

    <!-- Checkout Success Message -->
    <div class="checkout-message" id="checkoutMessage">
        <div class="message-content">
            <div class="message-icon"><i class="fas fa-check-circle"></i></div>
            <h3>Thank You!</h3>
            <p>Your order has been placed successfully</p>
            <button class="btn btn-primary" onclick="hideCheckoutMessage()">Continue Shopping</button>
        </div>
    </div>
    <script>
    function redirectUser() {
        console.log("hamada")
        <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                // إذا كان المستخدم مشرفًا
                echo "window.location.href = '../menna/allUsers.php';";
            } else {
                // إذا كان المستخدم عاديًا
                echo "alert('غير مسموح لك بالوصول إلى هذه الصفحة.');";
            }
        } else {
            // إذا لم يكن المستخدم مسجل الدخول
            echo "window.location.href = '../main-page/main.php';";
        }
        ?>
    }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="crd.js"></script>
    <!-- <script src="../test/test.js"></script> -->
</body>
</html>
