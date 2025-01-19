// Cart functionality
let cart = [];

// Using Promise for loading menu items
const loadMenuItems = () => {
  return new Promise((resolve, reject) => {
    //  AJAX call
    fetch("http://localhost/apis/get_products.php")
      .then((response) => response.json())
      .then((data) => resolve(data))
      .catch((error) => reject(error));
  });
};

// Add to cart function
const addToCart = (item) => {
  cart.push(item);
  updateCartDisplay();
};

// Update cart display
const updateCartDisplay = () => {
  // Cart update logic here
};

// Initialize when document is ready
document.addEventListener("DOMContentLoaded", () => {
  loadMenuItems()
    .then((items) => {
      // Display menu items
    })
    .catch((error) => console.error("Error loading menu items:", error));
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
