
// دالة لحفظ السلة في Local Storage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// دالة لاسترجاع السلة من Local Storage
function loadCartFromLocalStorage() {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }
}

// دالة لإرسال بيانات السلة إلى الخادم
async function sendCartToServer() {
    if (cart.length === 0) {
        showToast("السلة فارغة!");
        return;
    }

    try {
        const response = await fetch('../databasePHP/addcart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart: cart }) // إرسال السلة كـ JSON
        });

        const result = await response.json();

        if (result.status === 'success') {
            showToast("تم إرسال بيانات السلة بنجاح!");
            cart = []; // إفراغ السلة
            updateCartUI(); // تحديث واجهة السلة
            localStorage.removeItem('cart'); // إزالة السلة من Local Storage
        } else {
            showToast(result.message || "حدث خطأ أثناء إرسال البيانات");
        }
    } catch (error) {
        console.error('Error:', error);
        showToast("حدث خطأ في النظام");
    }
}

// دالة لإضافة منتج إلى السلة
function addToCart(productId, productName, productPrice, product_img) {
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1, image: product_img });
    }

    updateCartUI();
    showToast("تمت إضافة المنتج إلى السلة");
    saveCartToLocalStorage(); // حفظ السلة في Local Storage
}

// دالة لتحديث واجهة السلة
function updateCartUI() {
    const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartTotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

    const cartCountElement = document.getElementById('cart-count-overlay');
    if (cartCountElement) {
        cartCountElement.textContent = cartCount;
    }

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
            item.quantity += 1;
        } else if (action === 'decrease' && item.quantity > 1) {
            item.quantity -= 1;
        }
    }

    updateCartUI();
    saveCartToLocalStorage(); // حفظ السلة في Local Storage
}

// دالة لإزالة منتج من السلة
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCartUI();
    showToast("تمت إزالة المنتج من السلة");
    saveCartToLocalStorage(); // حفظ السلة في Local Storage
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
    sendCartToServer(); // إرسال بيانات السلة إلى الخادم
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
    }, 3000);
}

// تحميل السلة عند فتح الصفحة
document.addEventListener('DOMContentLoaded', () => {
    loadCartFromLocalStorage(); // استرجاع السلة من Local Storage
    updateCartUI(); // تحديث واجهة السلة
});

let cart = [];

// Add this line to initialize the cart
cart = JSON.parse(localStorage.getItem('cart')) || [];

// Add event listener to the add to cart button
document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.productId;
            const productName = button.dataset.productName;
            const productPrice = button.dataset.productPrice;
            const productImg = button.dataset.productImg;
            addToCart(productId, productName, productPrice, productImg);
        });
    });
});


// let cart = [];

// // دالة لحفظ السلة في Local Storage
// function saveCartToLocalStorage() {
//     localStorage.setItem('cart', JSON.stringify(cart));
// }

// // دالة لاسترجاع السلة من Local Storage
// function loadCartFromLocalStorage() {
//     const savedCart = localStorage.getItem('cart');
//     if (savedCart) {
//         cart = JSON.parse(savedCart);
//     }
// }

// // دالة لإرسال بيانات السلة إلى الخادم
// async function sendCartToServer() {
//     if (cart.length === 0) {
//         showToast("السلة فارغة!");
//         return;
//     }

//     try {
//         const response = await fetch('../databasePHP/addcart.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({ cart: cart }) // إرسال السلة كـ JSON
//         });

//         const result = await response.json();

//         if (result.status === 'success') {
//             showToast("تم إرسال بيانات السلة بنجاح!");
//             cart = []; // إفراغ السلة
//             updateCartUI(); // تحديث واجهة السلة
//             localStorage.removeItem('cart'); // إزالة السلة من Local Storage
//         } else {
//             showToast(result.message || "حدث خطأ أثناء إرسال البيانات");
//         }
//     } catch (error) {
//         console.error('Error:', error);
//         showToast("حدث خطأ في النظام");
//     }
// }

// // دالة لإضافة منتج إلى السلة
// function addToCart(productId, productName, productPrice, product_img) {
//     const existingItem = cart.find(item => item.id === productId);

//     if (existingItem) {
//         existingItem.quantity += 1;
//     } else {
//         cart.push({ id: productId, name: productName, price: productPrice, quantity: 1, image: product_img });
//     }

//     updateCartUI();
//     showToast("تمت إضافة المنتج إلى السلة");
//     saveCartToLocalStorage(); // حفظ السلة في Local Storage
// }

// // دالة لتحديث واجهة السلة
// function updateCartUI() {
//     const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
//     const cartTotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

//     const cartCountElement = document.getElementById('cart-count-overlay');
//     if (cartCountElement) {
//         cartCountElement.textContent = cartCount;
//     }

//     const cartItemsElement = document.getElementById('cart-items-overlay');
//     if (cartItemsElement) {
//         const cartItemsHTML = cart
//             .map(
//                 (item) => `
//                     <div class="cart-item">
//                         <P><img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;"></p>
//                         <h6>${item.name}</h6>
//                         <p>$${item.price.toFixed(2)} x ${item.quantity}</p>
//                         <div class="cart-item-actions">
//                             <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 'increase')">
//                                 <i class="fas fa-plus"></i>
//                             </button>
//                             <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 'decrease')">
//                                 <i class="fas fa-minus"></i>
//                             </button>
//                             <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">
//                                 <i class="fas fa-trash"></i>
//                             </button>
//                         </div>
//                     </div>
//                 `
//             )
//             .join('');

//         cartItemsElement.innerHTML = cartItemsHTML;
//     }

//     const cartTotalElement = document.getElementById('cart-total-overlay');
//     if (cartTotalElement) {
//         cartTotalElement.textContent = cartTotal.toFixed(2);
//     }
// }

// // دالة لتحديث كمية المنتج
// function updateQuantity(productId, action) {
//     const item = cart.find(item => item.id === productId);

//     if (item) {
//         if (action === 'increase') {
//             item.quantity += 1;
//         } else if (action === 'decrease' && item.quantity > 1) {
//             item.quantity -= 1;
//         }
//     }

//     updateCartUI();
//     saveCartToLocalStorage(); // حفظ السلة في Local Storage
// }

// // دالة لإزالة منتج من السلة
// function removeFromCart(productId) {
//     cart = cart.filter(item => item.id !== productId);
//     updateCartUI();
//     showToast("تمت إزالة المنتج من السلة");
//     saveCartToLocalStorage(); // حفظ السلة في Local Storage
// }

// // دالة لتبديل عرض السلة
// function toggleCart() {
//     const cartOverlay = document.getElementById('cartOverlay');
//     if (cartOverlay) {
//         cartOverlay.classList.toggle('active');
//     }
// }

// // دالة لعرض رسالة نجاح الطلب
// function showCheckoutMessage() {
//     sendCartToServer(); // إرسال بيانات السلة إلى الخادم
// }

// // دالة لإخفاء رسالة نجاح الطلب
// function hideCheckoutMessage() {
//     const checkoutMessage = document.getElementById('checkoutMessage');
//     if (checkoutMessage) {
//         checkoutMessage.classList.remove('active');
//     }
// }

// // دالة لعرض رسائل toast
// function showToast(message) {
//     const toast = document.createElement('div');
//     toast.className = 'toast';
//     toast.textContent = message;
//     document.body.appendChild(toast);

//     setTimeout(() => {
//         toast.remove();
//     }, 3000);
// }

// // تحميل السلة عند فتح الصفحة
// document.addEventListener('DOMContentLoaded', () => {
//     loadCartFromLocalStorage(); // استرجاع السلة من Local Storage
//     updateCartUI(); // تحديث واجهة السلة
// });
