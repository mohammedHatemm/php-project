

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
                        <P><img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;"></p>
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

        // إفراغ السلة بعد الطلب
        cart = [];
        updateCartUI();
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

// تحميل السلة عند فتح الصفحة
document.addEventListener('DOMContentLoaded', () => {
    updateCartUI(); // تحديث واجهة السلة
});

















// دالة لإرسال بيانات الطلب إلى السيرفر
async function showCheckoutMessage() {
    if (cart.length === 0) {
        showToast("السلة فارغة!");
        return;
    }

    try {
        const response = await fetch('addcart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                items: cart.map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                    price: item.price
                }))
            })
        });

        const result = await response.json();

        if (result.status === 'success') {
            const checkoutMessage = document.getElementById('checkoutMessage');
            if (checkoutMessage) {
                checkoutMessage.classList.add('active');
            }

            showToast("تم إتمام الطلب بنجاح!");

            // إفراغ السلة بعد نجاح الطلب
            cart = [];
            updateCartUI();
        } else {
            showToast(result.message || "حدث خطأ أثناء إتمام الطلب");
        }
    } catch (error) {
        console.error('Error:', error);
        showToast("حدث خطأ في النظام");
    }
}
