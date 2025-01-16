


let products = [];
let currentFilter = "all";
let cart = [];

// تحميل المنتجات من ملف JSON
async function loadProducts() {
  try {
    const response = await fetch("http://localhost/apis/get_products.php");
    const data = await response.json();
    products = data; // البيانات تُرجع مصفوفة مباشرةً
    displayProducts(products);
  } catch (error) {
    console.error("Error loading products:", error);
  }
}

// عرض المنتجات
function displayProducts(productsToShow) {
  const container = document.getElementById("products-container");
  container.innerHTML = "";

  productsToShow.forEach((product) => {
    const productCard = `
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="product-card">
          <img src="${product.product_img}" class="product-image w-100" alt="${product.productName}">
          <div class="product-body">
            <h5 class="product-title">${product.productName}</h5>
            <p class="product-description">${product.product_description}</p>
            <div class="product-price">$${parseFloat(product.price).toFixed(2)}</div>
            <button class="btn btn-primary w-100" onclick="addToCart(${product.product_id})">
              Add to Cart
              <i class="fas fa-plus ms-2"></i>
            </button>
          </div>
        </div>
      </div>
    `;
    container.innerHTML += productCard;
  });
}

// تصفية المنتجات
function filterProducts(category) {
  currentFilter = category;
  const filteredProducts =
    category === "all"
      ? products
      : products.filter((product) => product.category === category);
  displayProducts(filteredProducts);

  // تحديث حالة الأزرار النشطة
  document.querySelectorAll("[data-filter]").forEach((btn) => {
    btn.classList.toggle("active", btn.dataset.filter === category);
  });
}

// إضافة منتج إلى السلة
function addToCart(productId) {
  const product = products.find((p) => p.product_id === productId);
  if (product) {
    const existingItem = cart.find((item) => item.product_id === productId);
    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cart.push({ ...product, quantity: 1 });
    }
    updateCartDisplay();
  }
}

// إزالة منتج من السلة
function removeFromCart(productId) {
  const index = cart.findIndex((item) => item.product_id === productId);
  if (index > -1) {
    cart.splice(index, 1);
    updateCartDisplay();
  }
}

// تحديث كمية المنتج في السلة
function updateQuantity(productId, change) {
  const item = cart.find((item) => item.product_id === productId);
  if (item) {
    item.quantity += change;
    if (item.quantity <= 0) {
      removeFromCart(productId);
    } else {
      updateCartDisplay();
    }
  }
}

// تحديث عرض السلة
function updateCartDisplay() {
  const cartItems = document.getElementById("cart-items");
  const cartCount = document.getElementById("cart-count");
  const cartTotal = document.getElementById("cart-total");

  // تحديث عدد العناصر في السلة
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
  cartCount.textContent = totalItems;

  // تحديث محتوى السلة
  cartItems.innerHTML = cart
    .map(
      (item) => `
        <div class="cart-item mb-3">
          <div class="d-flex justify-content-between align-items-center">
            <span>${item.productName}</span>
            <span>$${(item.price * item.quantity).toFixed(2)}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="btn-group">
              <button class="btn btn-sm btn-outline-primary" onclick="updateQuantity(${
                item.product_id
              }, -1)">-</button>
              <span class="btn btn-sm btn-outline-secondary disabled">${
                item.quantity
              }</span>
              <button class="btn btn-sm btn-outline-primary" onclick="updateQuantity(${
                item.product_id
              }, 1)">+</button>
            </div>
            <button class="btn btn-sm btn-danger" onclick="removeFromCart(${
              item.product_id
            })">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
    `
    )
    .join("");

  // تحديث المجموع
  const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
  cartTotal.textContent = total.toFixed(2);


  // تحديث عرض الـ overlay
  updateCartOverlay();
}

// تحديث محتوى السلة في الـ overlay
function updateCartOverlay() {
  const cartItemsOverlay = document.getElementById("cart-items-overlay");
  const cartCountOverlay = document.getElementById("cart-count-overlay");
  const cartTotalOverlay = document.getElementById("cart-total-overlay");

  // تحديث عدد العناصر
  cartCountOverlay.textContent = cart.reduce(
    (sum, item) => sum + item.quantity,
    0
  );

  // تحديث المحتوى
  cartItemsOverlay.innerHTML = cart
    .map(
      (item) => `
        <div class="cart-item">
            <div class="d-flex justify-content-between align-items-center">
                <span>${item.productName}</span>
                <span>$${(item.price * item.quantity).toFixed(2)}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-primary" onclick="updateQuantity(${
                      item.product_id
                    }, -1)">-</button>
                    <span class="btn btn-sm btn-outline-secondary disabled">${
                      item.quantity
                    }</span>
                    <button class="btn btn-sm btn-outline-primary" onclick="updateQuantity(${
                      item.product_id
                    }, 1)">+</button>
                </div>
                <button class="btn btn-sm btn-danger" onclick="removeFromCart(${
                  item.product_id
                })">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `
    )
    .join("");

  // تحديث المجموع
  cartTotalOverlay.textContent = cart
    .reduce((sum, item) => sum + item.price * item.quantity, 0)
    .toFixed(2);
}

// الدفع (Checkout)
function checkout() {
  if (cart.length === 0) {
    alert("Your cart is empty!");
    return;
  }
  alert("Thank you for your order!");
  cart = [];
  updateCartDisplay();
}

// تبديل حالة عرض السلة
function toggleCart() {
  const cartOverlay = document.getElementById("cartOverlay");
  cartOverlay.classList.toggle("active");
  updateCartOverlay(); // تحديث محتوى السلة
}

// عرض رسالة نجاح الطلب
function showCheckoutMessage() {
  if (cart.length === 0) {
    alert("Your cart is empty!");
    return;
  }

  const checkoutMessage = document.getElementById("checkoutMessage");
  checkoutMessage.classList.add("active");

  // إفراغ السلة
  cart = [];
  updateCartOverlay();
  toggleCart(); // إغلاق السلة
}

// إخفاء رسالة نجاح الطلب
function hideCheckoutMessage() {
  const checkoutMessage = document.getElementById("checkoutMessage");
  checkoutMessage.classList.remove("active");
}

// إضافة مستمع حدث لزر السلة في الـ navbar
document.addEventListener("DOMContentLoaded", () => {
  loadProducts();

  document.querySelectorAll("[data-filter]").forEach((button) => {
    button.addEventListener("click", (e) => {
      filterProducts(e.target.dataset.filter);
    });
  });

  const cartButton = document.querySelector(".nav-icons .fa-shopping-cart");
  cartButton.parentElement.addEventListener("click", (e) => {
    e.preventDefault();
    toggleCart();
  });
});
