
<?php

session_start();

// تهيئة السلة إذا لم تكن موجودة
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];

}
?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Cafeteria</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
    <!-- Navbar -->
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
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation items -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <!-- Center menu items -->
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../testnew/index.php">Menu</a>
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
            <a href="#" class="nav-link d-inline-block me-3" >
              <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="#" class="nav-link d-inline-block" onclick="userprofile()">
              <i class="fas fa-user" ></i>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="hero-content" data-aos="fade-up">
              <h1 class="display-4 fw-bold mb-4">Welcome to Becoffee</h1>
              <p class="lead mb-4">
                Experience the finest coffee and delicious treats in a cozy
                atmosphere
              </p>
              <div class="hero-features mb-5">
                <div class="hero-feature">
                  <i class="fas fa-star"></i>
                  <span>Premium Quality</span>
                </div>
                <div class="hero-feature">
                  <i class="fas fa-coffee"></i>
                  <span>Fresh Coffee</span>
                </div>
                <div class="hero-feature">
                  <i class="fas fa-cookie"></i>
                  <span>Tasty Desserts</span>
                </div>
              </div>
              <div class="hero-buttons">
                <a href="#menu" class="btn btn-primary btn-lg">
                  View Menu
                  <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#about" class="btn btn-outline-light btn-lg">
                  About Us
                  <i class="fas fa-info-circle"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="floating-card card-1">
        <i class="fas fa-coffee"></i>
        <span>200+ Coffee Varieties</span>
      </div>
      <div class="floating-card card-2">
        <i class="fas fa-users"></i>
        <span>1000+ Happy Customers</span>
      </div>
    </section>

    <!-- Header -->
    <header class="main-header">
      <div class="container">
        <div class="row align-items-center min-vh-100">
          <div class="col-lg-6 text-white">
            <h1 class="display-4 fw-bold mb-4">Welcome to Our Cafeteria</h1>
            <p class="lead mb-4">
              Discover our premium selection of hot drinks, cold beverages, and
              delicious desserts
            </p>
            <div class="header-features mb-4">
              <div class="feature">
                <i class="fas fa-coffee"></i>
                <span>Premium Coffee</span>
              </div>
              <div class="feature">
                <i class="fas fa-cookie"></i>
                <span>Fresh Desserts</span>
              </div>
              <div class="feature">
                <i class="fas fa-clock"></i>
                <span>24/7 Service</span>
              </div>
            </div>
            <a href="../testnew/index.php" class="btn btn-primary btn-lg">Explore Menu</a>
          </div>
          <div class="col-lg-6">
            <img
              src="./home_coffee_slide1.png"
              alt="Cafeteria"
              class="img-fluid header-image"
            />
          </div>
        </div>
      </div>
    </header>

    <!-- Features Section -->
    <section class="features-section py-5">
      <div class="container">
        <div class="section-header text-center mb-5">
          <h2 class="display-5 fw-bold text-gradient">Our Features</h2>
          <div class="section-divider"></div>
          <p class="lead text-light">What makes us special</p>
        </div>

        <div class="row g-4">
          <!-- Feature 1 -->
          <div class="col-lg-3 col-md-6">
            <div class="feature-box text-center">
              <div class="feature-icon">
                <i class="fas fa-coffee"></i>
              </div>
              <h4>Premium Coffee</h4>
              <p>
                Enjoy our selection of premium coffee beans from around the world
              </p>
            </div>
          </div>

          <!-- Feature 2 -->
          <div class="col-lg-3 col-md-6">
            <div class="feature-box text-center">
              <div class="feature-icon">
                <i class="fas fa-clock"></i>
              </div>
              <h4>24/7 Service</h4>
              <p>We're here to serve you anytime, day or night</p>
            </div>
          </div>

          <!-- Feature 3 -->
          <div class="col-lg-3 col-md-6">
            <div class="feature-box text-center">
              <div class="feature-icon">
                <i class="fas fa-cookie"></i>
              </div>
              <h4>Fresh Desserts</h4>
              <p>Delicious desserts made fresh daily by our expert bakers</p>
            </div>
          </div>

          <!-- Feature 4 -->
          <div class="col-lg-3 col-md-6">
            <div class="feature-box text-center">
              <div class="feature-icon">
                <i class="fas fa-truck"></i>
              </div>
              <h4>Fast Delivery</h4>
              <p>Quick and reliable delivery service to your location</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="menu-section py-5">
      <div class="container">
        <div class="section-header text-center mb-5">
          <h2 class="display-5 fw-bold text-gradient">Our Featured Menu</h2>
          <div class="section-divider"></div>
          <p class="lead text-light">
            Discover our carefully selected premium items
          </p>
        </div>
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="menu-image-container">
              <img
                src="./66782a3f20ce4051506907.jpg"
                alt="Menu Image"
                class="img-fluid rounded-lg menu-image"
              />
              <div class="menu-image-overlay"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="menu-content">
              <h3 class="text-gradient mb-4">Premium Quality</h3>
              <p class="lead text-light mb-4">
                Experience the finest selection of beverages and desserts crafted
                with passion
              </p>
              <div class="menu-features">
                <div class="menu-feature-item">
                  <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                  </div>
                  <div class="feature-text">
                    <h5>Fresh Ingredients</h5>
                    <p>We use only the finest and freshest ingredients</p>
                  </div>
                </div>
                <div class="menu-feature-item">
                  <div class="feature-icon">
                    <i class="fas fa-award"></i>
                  </div>
                  <div class="feature-text">
                    <h5>Expert Baristas</h5>
                    <p>Crafted by our skilled professional team</p>
                  </div>
                </div>
                <div class="menu-feature-item">
                  <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                  </div>
                  <div class="feature-text">
                    <h5>Made with Love</h5>
                    <p>Every item is prepared with care and attention</p>
                  </div>
                </div>
              </div>
              <a
                href="../testnew/index.php"
                class="btn btn-primary btn-lg mt-4"
              >
                <span>Explore Full Menu</span>
                <i class="fas fa-arrow-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-section py-5">
      <div class="container">
        <div class="section-header text-center mb-5">
          <h2 class="display-5 fw-bold text-gradient">About Us</h2>
          <div class="section-divider"></div>
          <p class="lead text-light">Creating moments of joy with every cup</p>
        </div>
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="about-content">
              <h3 class="text-gradient mb-4">Our Story</h3>
              <p class="lead text-light mb-4">
                We are passionate about creating the perfect blend of comfort and
                luxury in every visit
              </p>
              <div class="about-features">
                <div class="about-feature-item">
                  <i class="fas fa-globe"></i>
                  <div>
                    <h5>International Cuisine</h5>
                    <p>Flavors from around the world</p>
                  </div>
                </div>
                <div class="about-feature-item">
                  <i class="fas fa-star"></i>
                  <div>
                    <h5>Premium Service</h5>
                    <p>Exceptional customer experience</p>
                  </div>
                </div>
                <div class="about-feature-item">
                  <i class="fas fa-users"></i>
                  <div>
                    <h5>Friendly Team</h5>
                    <p>Professional and welcoming staff</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-image-container">
              <img
                src="about-image.jpg"
                alt="About Us"
                class="img-fluid rounded-lg about-image"
              />
              <div class="about-image-overlay"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5">
      <div class="container">
        <div class="row g-4">
          <!-- معلومات الشركة -->
          <div class="col-lg-4 col-md-6">
            <h5 class="mb-4 footer-title">Hotel Cafeteria</h5>
            <p class="mb-3">
              we provide the best food and drinks in a luxurious and comfortable
              atmosphere
            </p>
            <div class="footer-info">
              <p class="mb-2">
                <i class="fas fa-phone me-2 footer-icon"></i>
                phone: 123-456-789
              </p>
              <p class="mb-2">
                <i class="fas fa-envelope me-2 footer-icon"></i>
                email: info@hotelcafeteria.com
              </p>
              <p class="mb-2">
                <i class="fas fa-map-marker-alt me-2 footer-icon"></i>
                address: main hotel street
              </p>
            </div>
          </div>

          <!-- روابط سريعة -->
          <div class="col-lg-4 col-md-6">
            <h5 class="mb-4 footer-title">quick links</h5>
            <ul class="footer-links">
              <li><a href="#home">Home</a></li>
              <li><a href="../testnew/index.php">food list</a></li>
              <li><a href="#about">about us</a></li>
              <li><a href="#contact">contact us</a></li>
              <li><a href="#">privacy policy</a></li>
              <li><a href="#">terms and conditions</a></li>
            </ul>
          </div>

          <!-- ساعات العمل والتواصل -->
          <div class="col-lg-4 col-md-6">
            <h5 class="mb-4 footer-title">working hours</h5>
            <div class="footer-hours mb-4">
              <p class="mb-2">all days of the week</p>
              <p class="mb-2">from 7 am to 11 pm</p>
              <p class="mb-3">room service: 24/7</p>
            </div>
            <h5 class="mb-3 footer-title">follow us on</h5>
            <div class="social-icons">
              <a href="#" class="me-4" title="Instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="me-4" title="Facebook">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="me-4" title="Twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="me-4" title="LinkedIn">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" title="TikTok">
                <i class="fab fa-tiktok"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- حقوق النشر -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="footer-bottom text-center">
              <p class="mb-0">all rights reserved &copy; 2024 Hotel Cafeteria</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
     <script>
    function userprofile(){
      console.log("hamada")
        <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                // إذا كان المستخدم مشرفًا
                header("location :../menna/allUsers.php");

              } else {
                // إذا كان المستخدم عاديًا
                echo "alert('غير مسموح لك بالوصول إلى هذه الصفحة.');";
            }
         } else {
        //     // إذا لم يكن المستخدم مسجل الدخول
            echo "window.location.href = '../main-page/main.php';";
        }
        ?>
    }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="main.js"></script>
  </body>
</html>
