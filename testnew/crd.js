// // تهيئة السلة
// let cart = [];

// // دالة لإضافة منتج إلى السلة
// function addToCart(productId, productName, productPrice, product_img) {
//     // التحقق من وجود المنتج في السلة
//     const existingItem = cart.find(item => item.id === productId);

//     if (existingItem) {
//         existingItem.quantity += 1; // زيادة الكمية إذا كان المنتج موجودًا
//     } else {
//         cart.push({ id: productId, name: productName, price: productPrice, quantity: 1, image: product_img }); // إضافة المنتج إلى السلة
//     }

//     updateCartUI(); // تحديث واجهة السلة
// }

// // دالة لتحديث واجهة السلة
// function updateCartUI() {
//     const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0); // حساب عدد العناصر في السلة
//     const cartTotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0); // حساب المجموع الكلي

//     // تحديث عدد العناصر في السلة
//     document.getElementById('cart-count-overlay').textContent = cartCount;

//     // تحديث محتوى السلة
//     const cartItemsHTML = cart
//         .map(
//             (item) => `
//                 <div class="cart-item">

//                     <img src="../product-img/${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;">
//                     <h6>${item.name}</h6>
//                     <p>    $${item.price.toFixed(2)} x   ${item.quantity} </p>
//                     <div class="cart-item-actions">
//                         <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 'increase')">
//                             <i class="fas fa-plus"></i>
//                         </button>
//                         <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 'decrease')">
//                             <i class="fas fa-minus"></i>
//                         </button>
//                         <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">
//                             <i class="fas fa-trash"></i>
//                         </button>
//                     </div>
//                 </div>
//             `
//         )
//         .join('');

//     document.getElementById('cart-items-overlay').innerHTML = cartItemsHTML;

//     // تحديث المجموع الكلي
//     document.getElementById('cart-total-overlay').textContent = cartTotal.toFixed(2);
// }

// // دالة لتحديث كمية المنتج
// function updateQuantity(productId, action) {
//     const item = cart.find(item => item.id === productId);

//     if (item) {
//         if (action === 'increase') {
//             item.quantity += 1; // زيادة الكمية
//         } else if (action === 'decrease' && item.quantity > 1) {
//             item.quantity -= 1; // إنقاص الكمية
//         }
//     }

//     updateCartUI(); // تحديث واجهة السلة
// }

// // دالة لإزالة منتج من السلة
// function removeFromCart(productId) {
//     cart = cart.filter(item => item.id !== productId); // إزالة المنتج من السلة
//     updateCartUI(); // تحديث واجهة السلة
// }

// // دالة لتبديل عرض السلة
// function toggleCart() {
//     const cartOverlay = document.getElementById('cartOverlay');
//     cartOverlay.classList.toggle('active');
// }

// // دالة لعرض رسالة نجاح الطلب
// function showCheckoutMessage() {
//     const checkoutMessage = document.getElementById('checkoutMessage');
//     checkoutMessage.classList.add('active');

//     // إفراغ السلة بعد الطلب
//     cart = [];
//     updateCartUI();
// }

// // دالة لإخفاء رسالة نجاح الطلب
// function hideCheckoutMessage() {
//     const checkoutMessage = document.getElementById('checkoutMessage');
//     checkoutMessage.classList.remove('active');
// }

// // تحميل السلة عند فتح الصفحة
// document.addEventListener('DOMContentLoaded', () => {
//     updateCartUI(); // تحديث واجهة السلة
// });


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
