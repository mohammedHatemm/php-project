<?php
require_once '../databasePHP/connection.php';
require_once "test2.php ";

session_start();

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
        echo "<p class='text-center text-danger'>لا توجد منتجات في قاعدة البيانات.</p>";
    }
} else {
    // إذا كان هناك خطأ في الاستعلام
    echo "<p class='text-center text-danger'>خطأ في جلب البيانات.</p>";
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
                    <li class="nav-item"><a class="nav-link" href="../main-page/main.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="nav-icons">
                    <a href="#" class="nav-link d-inline-block me-3" onclick="toggleCart()">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count-overlay" class="badge bg-primary">0</span>
                    </a>
                    <a href="../menna/allUsers.php" class="nav-link d-inline-block">
                        <i class="fas fa-user"></i>
                    </a>
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
                                            <button class="btn btn-primary" style="width: 100%;" onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo $product['productName']; ?>', <?php echo $product['price']; ?>, '<?php echo $product['product_img']; ?>')">
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
                <button class="btn btn-primary w-100" onclick="checkout()">Checkout <i class="fas fa-arrow-right ms-2"></i></button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // تهيئة السلة
        let cart = [];

        // دالة لإضافة منتج إلى السلة
        function addToCart(productId, productName, productPrice, product_img) {
            const existingItem = cart.find(item => item.id === productId);

            if (existingItem) {
                existingItem.quantity += 1; // زيادة الكمية إذا كان المنتج موجودًا
            } else {
                cart.push({ id: productId, name: productName, price: productPrice, quantity: 1, image: product_img }); // إضافة المنتج إلى السلة
            }

            updateCartUI(); // تحديث واجهة السلة
            showToast("تمت إضافة المنتج إلى السلة"); // عرض رسالة تأكيد
        }

        // دالة لتحديث واجهة السلة
        function updateCartUI() {
            const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0); // حساب عدد العناصر في السلة
            const cartTotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0); // حساب المجموع الكلي

            // تحديث عدد العناصر في السلة
            const cartCountElement = document.getElementById('cart-count-overlay');
            if (cartCountElement) {
                cartCountElement.textContent = cartCount;
            }

            // تحديث محتوى السلة
            const cartItemsElement = document.getElementById('cart-items-overlay');
            if (cartItemsElement) {
                const cartItemsHTML = cart
                    .map(
                        (item) => `
                            <div class="cart-item">
                                <P><img src="../product-img/${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;"></p>
                                <h6>${item.name}</h6>
                                <p>$${item.price.toFixed(2)} x ${item.quantity}</p>
                                <div class="cart-item-actions">
                                    <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 'increase')">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 'decrease')">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `
                    )
                    .join('');

                cartItemsElement.innerHTML = cartItemsHTML;
            }

            // تحديث المجموع الكلي
            const cartTotalElement = document.getElementById('cart-total-overlay');
            if (cartTotalElement) {
                cartTotalElement.textContent = cartTotal.toFixed(2);
            }
        }

        // دالة لتحديث كمية المنتج
        function updateQuantity(productId, action) {
            const item = cart.find(item => item.id === productId);

            if (item) {
                if (action === 'increase') {
                    item.quantity += 1; // زيادة الكمية
                } else if (action === 'decrease' && item.quantity > 1) {
                    item.quantity -= 1; // إنقاص الكمية
                }
            }

            updateCartUI(); // تحديث واجهة السلة
        }

        // دالة لإزالة منتج من السلة
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId); // إزالة المنتج من السلة
            updateCartUI(); // تحديث واجهة السلة
            showToast("تمت إزالة المنتج من السلة"); // عرض رسالة تأكيد
        }

        // دالة لتبديل عرض السلة
        function toggleCart() {
            const cartOverlay = document.getElementById('cartOverlay');
            if (cartOverlay) {
                cartOverlay.classList.toggle('active');
            }
        }

        // دالة لعرض رسالة نجاح الطلب
        function showCheckoutMessage() {
            const checkoutMessage = document.getElementById('checkoutMessage');
            if (checkoutMessage) {
                checkoutMessage.classList.add('active');
            }
        }

        // دالة لإخفاء رسالة نجاح الطلب
        function hideCheckoutMessage() {
            const checkoutMessage = document.getElementById('checkoutMessage');
            if (checkoutMessage) {
                checkoutMessage.classList.remove('active');
            }
        }

        // دالة لعرض رسائل toast
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000); // إزالة الرسالة بعد 3 ثوانٍ
        }

        // دالة لإرسال بيانات السلة إلى الخادم
        function checkout() {
            const cartData = JSON.stringify(cart); // تحويل السلة إلى JSON

            fetch('checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: cartData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showCheckoutMessage(); // عرض رسالة نجاح الطلب
                    cart = []; // إفراغ السلة
                    updateCartUI(); // تحديث واجهة السلة
                } else {
                    alert('فشل في إتمام الطلب: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء إتمام الطلب.');
            });
        }

        // تحميل السلة عند فتح الصفحة
        document.addEventListener('DOMContentLoaded', () => {
            updateCartUI(); // تحديث واجهة السلة
        });
    </script>
</body>
</html>
