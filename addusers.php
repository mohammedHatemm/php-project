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
    <style>
        input{
            margin-left: 3rem;
            width: 15rem;  
        }
        input:hover{
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
      transform: translateY(-2px);
        }
        .cancelbtn:hover {
      /* background-color:  RGB(20, 112, 175); */
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
      transform: translateY(-2px);
    }
    .signupbtn:hover {
      /* background-color:  RGB(20, 112, 175); */
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
      transform: translateY(-2px);
    }
     h1:hover{
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        transform: translateY(-2px);
      width: 15rem;
     }
    </style>
</head>
<body>
    <div class="container">
        <form class="d-flex" role="search" style="margin-left: 65rem;">
            <div><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style=" border-radius: 15px;"> <img src="images\icon search.webp" alt=""width="20px" hight="25px" style="position: absolute; top: 1.3rem; left: 1rem;"></div>
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
                <span> <a href="#">Admin</a> </span>
            </div>
        </nav>
    </div>
        
              <form method="post" style="margin-top: 6rem;">
      
              <h1 align="left" style="color:  RGB(20, 112, 175);" >Add User</h1>
              <hr>
      
              <label><b>Name</b></label>
              <input type="text" placeholder="Enter Name" name="name" required style="margin-left: 10rem;" >
      <br />
              <label><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required style="margin-left: 10rem;">
      <br />
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required style="margin-left: 7.7rem;">
      <br />
              <label><b>Confirm Password</b></label>
              <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      <br />
              <label><b>Room No.</b></label>
              <input type="text" placeholder="Enter Room No." name="roomNo" required style="margin-left: 8rem;">
      <br />
              <label><b>Ext.</b></label>
              <input type="text" placeholder="Enter Ext." name="Ext" required style="margin-left: 11rem;">
      <br />
              <label><b>Profile Picture</b></label>
              <input type="text" placeholder="Browse" name="file" required style="margin-left: 5.3rem;">
      <br />
      
              <div class="clearfix" style="margin-left: 6rem; margin-top: 1rem; ">
                <button type="submit" class="cancelbtn" style="cursor: pointer;">Save</button>
                <button type="reset" class="signupbtn" style="margin-left: 2rem; cursor: pointer; ">Reset</button>
              </div>
            </div>
        </form>
      </div>
</body>
</html>