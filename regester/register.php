<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="register.css" />
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <?php
        if (isset($_GET["message"])) {
            echo "<p class='alert alert-info'>" . htmlspecialchars($_GET["message"]) . "</p>";
        }
        ?>
        <form action="../databasePHP/register.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required />
            </div>
            <div class="form-group">
                <label for="useremail">Email:</label>
                <input type="email" id="useremail" name="useremail" required />
            </div>
            <div class="form-group">
                <label for="userpassword">Password:</label>
                <input type="password" id="userpassword" name="userpassword" required />
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required />
            </div>
            <div class="form-group">
                <label for="userphone">Phone:</label>
                <input type="text" id="userphone" name="userphone"  />
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group" id="roomNumField">
            <input type="number" name="roomnum" placeholder="room number" >
        </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="userimg" accept="image/*" />
            </div>
            <button type="submit" name="registerBtn" class="submit-btn">Register</button>
        </form>
        <p>Already have an account? <a href="../login/login.php">Login here</a></p>
    </div>
    <script src="register.js"></script>
</body>
</html>
