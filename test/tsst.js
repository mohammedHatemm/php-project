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
