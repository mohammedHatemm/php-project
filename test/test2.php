<?php
require_once '../databasePHP/connection.php';

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <!-- النافبار -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="#">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <span class="logo-text">Becoffee</span>
                </div>
            </a>

            <!-- Toggler button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Center menu items -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../main-page/main.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <!-- Right icons -->
                <div class="nav-icons">
                    <a href="#" class="nav-link d-inline-block me-3" onclick="openSidebar()">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count" class="badge bg-primary">0</span>
                    </a>
                    <a href="../menna/allUsers.php" class="nav-link d-inline-block">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">إدارة المنتجات</h1>
        <div class="text-end mb-3">
            <button class="btn btn-primary" onclick="openAddModal()">
                <i class="fas fa-plus"></i> إضافة منتج جديد
            </button>
        </div>
        <div class="row">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            <img src="../product-img/<?php echo $product['product_img']; ?>" alt="<?php echo $product['productName']; ?>">
                            <h2><?php echo $product['productName']; ?></h2>
                            <h3 class="product-price">$ <?php echo $product['price']; ?></h3>
                            <div class="product-description"><?php echo $product['product_description']; ?></div>
                            <div class="product-action">
                                <a href="#" onclick="openEditModal(
                                    '<?php echo $product['product_id']; ?>',
                                    '<?php echo $product['productName']; ?>',
                                    '<?php echo $product['price']; ?>',
                                    '<?php echo $product['product_description']; ?>')">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- <a href="deleteproduct.php?product_id=<?php echo $product['product_id']; ?>"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
                                    <i class="fas fa-trash"></i>
                                </a> -->
                                <button class="btn btn-success" onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo $product['productName']; ?>', <?php echo $product['price']; ?>)">
                                    <i class="fas fa-shopping-cart"></i> شراء
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-warning">لا توجد منتجات متاحة.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- الكارد الجانبي -->
    <div class="sidebar" id="sidebar">
        <button class="close-sidebar" onclick="closeSidebar()">×</button>
        <h2>العناصر المختارة</h2>
        <div id="selected-items">
            <!-- العناصر المختارة ستظهر هنا -->
        </div>
        <!-- أزرار تأكيد الطلب وإلغائه -->
        <div class="sidebar-actions">
            <button class="btn btn-success w-100 mb-2" onclick="confirmOrder()">تأكيد الطلب</button>
            <button class="btn btn-danger w-100" onclick="cancelOrder()">إلغاء الطلب</button>
        </div>
    </div>

    <!-- نافذة إضافة منتج جديد -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeAddModal()">×</button>
            <h2>إضافة منتج جديد</h2>
            <form action="addproduct.php" method="post" enctype="multipart/form-data">
                <input class="form-control mb-3" type="text" placeholder="اسم المنتج" name="product_name" required>
                <input class="form-control mb-3" type="number" placeholder="السعر" name="price" step="0.01" required>
                <textarea class="form-control mb-3" placeholder="وصف المنتج" name="product_description" rows="3" required></textarea>
                <input class="form-control mb-3" type="file" name="product_image" accept="image/*" required>
                <button type="submit" class="btn btn-primary w-100">إضافة</button>
            </form>
        </div>
    </div>

    <!-- نافذة تعديل المنتج -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeEditModal()">×</button>
            <h2>تعديل المنتج</h2>
            <form action="editproduct.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" id="edit_product_id">
                <input class="form-control mb-3" type="text" placeholder="اسم المنتج" name="product_name" id="edit_product_name" required>
                <input class="form-control mb-3" type="number" placeholder="السعر" name="price" id="edit_product_price" step="0.01" required>
                <textarea class="form-control mb-3" placeholder="وصف المنتج" name="product_description" id="edit_product_description" rows="3" required></textarea>
                <input class="form-control mb-3" type="file" name="product_image" id="edit_product_image" accept="image/*">
                <button type="submit" class="btn btn-primary w-100">تحديث</button>
            </form>
        </div>
    </div>

  <script src="tsst.js"></script>
</body>
</html>
