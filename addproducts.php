<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
</head>
<body>
   
     <div class="container">
        <form class="d-flex" role="search" style="margin-left: 65rem;">
            <div><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style=" border-radius: 15px;"> <img src="images\icon search.webp" alt=""width="20px" hight="25px" style="position: absolute;top: 1.3rem;"></div>
          </form>
        <nav style="display: flex; cursor: pointer;">
            <div style="margin-left: 3rem;">
                
                <span style="font-size: 20px;">Cafeteria</span>
            </div>
            <div >
                <ul style="display: flex; position: absolute;left:25rem;gap: 3rem;">
                    <li>Home</li>
                    <li>Product</li>
                    <li>Users</li>
                    <li>Manual_Order</li>
                    <li>Checks</li>
                </ul>
            </div>
            <div style="position: absolute;left: 73rem;top:1rem;cursor: pointer;">
                <img src="images\icons_user2-64.webp" alt="" width="20px" height="20px" >
                <span>Admin</span>
            </div>
            
        </nav>
     </div>

     <div class="hero">
        <span style="color: RGB(20, 112, 175); margin-left: 8rem; font-size: 20px;">ALl Products</span>
        <span style="margin-left: 58rem; "> <a href="addpro.html" style="color:rgb(158, 157, 157)">Add Products</a> </span>
     </div>
     <div style="margin-top: 1rem;">
        <table style="background-color: black ; margin-left: 9rem;width: 70rem;height: 10rem;">
            <tr style="background-color: rgb(78, 77, 77);">
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <tr style="background-color: lightgray;">
                <th>Tea</th>
                <td>5EGP</td>
                <td><img src="images\tea-64.webp" alt=""></td>
                <td>avilable edit delete</td>
            </tr>
            <tr style="background-color: lightgray;">
                <th>Nescafe</th>
                <td>10EGP</td>
                <td><img src="images\Nescafe.webp" alt=""></td>
                <td>avilable edit delete</td>
            </tr>
            <tr style="background-color: lightgray;">
                <th>coffee</th>
                <td>15EGP</td>
                <td><img src="images\coffee.webp" alt=""></td>
                <td>avilable edit delete</td>
            </tr>
        </table>
    </div>

    <!-- <footer style="margin-top: 10rem;">
        <div class="footer-container" >
        
            <div class="map">
                <h3>Our Location</h3>
                <iframe 
                   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093746!2d144.95565151566425!3d-37.817313979751875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce6e0!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sus!4v1693240446591!5m2!1sen!2sus" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    >
                </iframe>
            </div>

        
            <div class="contact-form" style="margin-left: 26rem ;">
                <h3>Send Us a Message</h3>
                <form action="#" method="POST">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required><br>
                    <input type="text" name="subject" placeholder="Your subject" required style="width: 24rem" > <br><br>
                    <textarea name="message" placeholder="Your Message" rows="4" required style="width: 24rem;"></textarea><br>
                    <button type="submit" style=" background-color:RGB(20, 112, 175) ; color: white;">Send Message</button>
                </form>
            </div>
            
             <div class="social-media" style="margin-top: 5rem;">
                <h3 style="color:RGB(20, 112, 175); margin-left: 36rem; ">Follow Us</h3>
                <ul style="display: flex; margin-left: 32rem;">
                    <li><a href="https://www.facebook.com/"><img src="facebook-64.webp" alt="Facebook" width="50%" height="60%"></a></li>
                    <li><a href="https://www.x.com/"><img src="X-64.webp" alt="Twitter" width="50%" height="60%"> </a></li>
                    <li><a href="https://www.instagram.com/"><img src="instagram-64.webp" alt="Instagram" width="50%" height="60%"> </a></li>
                </ul>
            </div>
        </div>

    </footer> -->

    <!-- <header>
    <nav class="navbar bg-body-tertiary" style="display: flex;  font-family:Shrikhand";>
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="1.png" alt="Bootstrap" width="70" height="40">
            <span>Cafeteria</span>
          </a>
        </div>
        
        <div class="contain">
        <ul style="display: flex; position: absolute; top:0px ;right:10rem; gap: 10px;">
            <li>Home </li>
            <li>Products</li>
            <li>Users</li>
            <li>Manual_Order</li>
            <li>Checks</li>
        </ul>
        </div>
      
      <div class="icon-cart" style="position: absolute;right: 5rem; top:1rem ;">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
        </svg>
        <span>0</span>
        </div>
    </nav>
    </header> -->
    <script src=""></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>