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
    <!-- <style>
        /* إضافة تنسيقات مخصصة */
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-action {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .product-action a {
            color: #333;
            font-size: 18px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            max-width: 90%;
        }
        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            float: right;
        }
        /* تنسيقات الكارد الجانبي */
        .sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            padding: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        .close-sidebar {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            float: left;
        }
        .selected-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .selected-item h3 {
            margin: 0;
            font-size: 18px;
        }
        .selected-item p {
            margin: 5px 0;
            color: #666;
        }
        .item-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .item-actions input {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .item-actions button {
            background: none;
            border: none;
            color: #ff4d4d;
            cursor: pointer;
        }
        .sidebar-actions {
            margin-top: auto; /* لنقل الأزرار إلى أسفل الكارد */
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .sidebar-actions .btn {
            font-size: 16px;
            padding: 10px;
        }
        /* تنسيقات الرسالة */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 1001;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }
    </style> -->
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
                                <a href="deleteproduct.php?product_id=<?php echo $product['product_id']; ?>"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
                                    <i class="fas fa-trash"></i>
                                </a>
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

    <script>
        // مصفوفة لتخزين العناصر المختارة
        let selectedItems = [];

        // فتح الكارد الجانبي
        function openSidebar() {
            document.getElementById('sidebar').style.right = '0';
        }

        // إغلاق الكارد الجانبي
        function closeSidebar() {
            document.getElementById('sidebar').style.right = '-400px';
        }

        // إغلاق الكارد الجانبي عند النقر خارجها
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const cartIcon = document.querySelector('.fa-shopping-cart');
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnCartIcon = cartIcon.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnCartIcon) {
                closeSidebar();
            }
        });

        // إضافة عنصر إلى الكارد الجانبي
        function addToCart(productId, productName, price) {
            const quantity = 1; // الكمية الافتراضية
            const item = {
                productId,
                productName,
                price,
                quantity
            };

            // التحقق من وجود العنصر مسبقًا
            const existingItem = selectedItems.find(item => item.productId === productId);
            if (existingItem) {
                existingItem.quantity += 1; // زيادة الكمية إذا كان العنصر موجودًا
            } else {
                selectedItems.push(item); // إضافة العنصر إذا لم يكن موجودًا
            }

            updateSidebar();
            openSidebar();

            // عرض رسالة تأكيد
            showMessage(`تمت إضافة "${productName}" إلى السلة بنجاح!`, "success");

            // تحديث عدد العناصر في السلة
            updateCartCount();
        }

        // تحديث الكارد الجانبي
        function updateSidebar() {
            const selectedItemsContainer = document.getElementById('selected-items');
            selectedItemsContainer.innerHTML = '';

            selectedItems.forEach((item, index) => {
                const itemElement = document.createElement('div');
                itemElement.className = 'selected-item';
                itemElement.innerHTML = `
                    <h3>${item.productName}</h3>
                    <p>السعر: $${item.price}</p>
                    <div class="item-actions">
                        <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)">
                        <button onclick="removeItem(${index})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
                selectedItemsContainer.appendChild(itemElement);
            });
        }

        // تحديث كمية العنصر
        function updateQuantity(index, quantity) {
            selectedItems[index].quantity = parseInt(quantity);
            updateSidebar();
        }

        // حذف العنصر
        function removeItem(index) {
            selectedItems.splice(index, 1);
            updateSidebar();
            updateCartCount();
        }

        // تحديث عدد العناصر في السلة
        function updateCartCount() {
            const cartCount = selectedItems.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cart-count').textContent = cartCount;
        }

        // تأكيد الطلب
        function confirmOrder() {
            if (selectedItems.length === 0) {
                showMessage("السلة فارغة. أضف عناصر لتأكيد الطلب.", "warning");
                return;
            }

            // إرسال الطلب إلى قاعدة البيانات
            fetch('confirm_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(selectedItems)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage("تم تأكيد الطلب بنجاح!", "success");
                    selectedItems = []; // تفريغ السلة
                    updateSidebar();
                    updateCartCount();
                } else {
                    showMessage("حدث خطأ أثناء تأكيد الطلب.", "danger");
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء الاتصال بالخادم:', error);
                showMessage("حدث خطأ أثناء تأكيد الطلب.", "danger");
            });
        }

        // إلغاء الطلب
        function cancelOrder() {
            if (selectedItems.length === 0) {
                showMessage("السلة فارغة.", "warning");
                return;
            }

            if (confirm("هل أنت متأكد من إلغاء الطلب؟")) {
                selectedItems = []; // تفريغ السلة
                updateSidebar();
                updateCartCount();
                showMessage("تم إلغاء الطلب بنجاح.", "success");
            }
        }

        // عرض رسالة تأكيد
        function showMessage(message, type = "success") {
            const messageElement = document.createElement('div');
            messageElement.className = `alert alert-${type}`;
            messageElement.textContent = message;

            document.body.appendChild(messageElement);

            // إخفاء الرسالة بعد 3 ثواني
            setTimeout(() => {
                messageElement.remove();
            }, 3000);
        }

        // فتح نافذة إضافة منتج جديد
        function openAddModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        // إغلاق نافذة إضافة منتج جديد
        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        // فتح نافذة تعديل المنتج
        function openEditModal(productId, productName, productPrice, productDescription) {
            document.getElementById('edit_product_id').value = productId;
            document.getElementById('edit_product_name').value = productName;
            document.getElementById('edit_product_price').value = productPrice;
            document.getElementById('edit_product_description').value = productDescription;
            document.getElementById('editModal').style.display = 'flex';
        }

        // إغلاق نافذة تعديل المنتج
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // إغلاق النوافذ عند النقر خارجها
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
