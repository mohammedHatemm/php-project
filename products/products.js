// products.js

let cart = []; // مصفوفة لتخزين العناصر المضافة إلى السلة
function addToCart(product_id ,productName , price)
{
  
}

let item = addEventListener.qu

// // دالة لإضافة منتج إلى السلة
// function addToCart(productId, productName, productPrice) {
//     // التحقق من وجود المنتج في السلة
//     const existingItem = cart.find(item => item.id === productId);

//     if (existingItem) {
//         existingItem.quantity += 1; // زيادة الكمية إذا كان المنتج موجودًا
//     } else {
//         cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 }); // إضافة المنتج إلى السلة
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
//                     <h6>${item.name}</h6>
//                     <p>${item.quantity} x $${item.price.toFixed(2)}</p>
//                     <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">
//                         <i class="fas fa-trash"></i>
//                     </button>
//                 </div>
//             `
//         )
//         .join('');

//     document.getElementById('cart-items-overlay').innerHTML = cartItemsHTML;

//     // تحديث المجموع الكلي
//     document.getElementById('cart-total-overlay').textContent = cartTotal.toFixed(2);
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

// // تحميل السلة من الجلسة عند فتح الصفحة
// document.addEventListener('DOMContentLoaded', () => {
//     // يمكنك هنا جلب بيانات السلة من الجلسة باستخدام AJAX إذا كنت تستخدم جلسات PHP
//     updateCartUI(); // تحديث واجهة السلة
// });
