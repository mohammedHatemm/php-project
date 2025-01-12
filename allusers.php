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
            <div><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style=" border-radius: 15px;"> <img src="images/icon search.webp" alt=""width="20px" hight="25px" style="position: absolute;top: 1.3rem;"></div>
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
                <span> <a href="#"> Admin</a></span>
            </div>
        </nav>
    </div>
    <div class="hero">
        <span style="color: RGB(20, 112, 175); margin-left: 8rem; font-size: 20px;">ALl users</span>
        <span style="margin-left: 58rem; "> <a href="addpro.html" style="color:rgb(158, 157, 157)">Add users</a> </span>
     </div>
     <div style="margin-top: 1rem;">
        <table style="background-color: black ; margin-left: 9rem;width: 70rem;height: 10rem;">
            <tr style="background-color: rgb(78, 77, 77);">
                <th>Name</th>
                <th>Room</th>
                <th>Image</th>
                <th>EXT</th>
                <th>Action</th>
            </tr>

            <tr style="background-color: lightgray;">
                <th>Mohammed hatem</th>
                <td>67</td>
                <td><img src="images\tea-64.webp" alt=""></td>
                <td>5015</td>
                <td>avilable edit delete</td>
            </tr>
            <tr style="background-color: lightgray;">
                <th>Moustfa</th>
                <td>111</td>
                <td><img src="images/Nescafe.webp" alt=""></td>
                <td>5015</td>
                <td>avilable edit delete</td>
            </tr>
            <tr style="background-color: lightgray;">
                <th>Rawda Ramadan</th>
                <td>145</td>
                
                <td><img src="images/coffee.webp" alt=""></td>
                <td>5015</td>
                <td>avilable edit delete</td>
            </tr>
            <tr style="background-color: lightgray;">
                <th>Menna Mahmoud</th>
                <td>397</td>
                
                <td><img src="images/coffee.webp" alt=""></td>
                <td>5015</td>
                <td>avilable edit delete</td>
            </tr>
        </table>
    </div>
</body>
</html>