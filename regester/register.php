
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <?php
        if (isset($_GET["message"])) {
            echo "<p class='alert alert-info'>" . htmlspecialchars($_GET["message"]) . "</p>";
        }
        ?>
        <form action="../databasePHP/server.php" method="POST">
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
                <i class="ri-lock-line"></i>
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                      <input type="password" id="confirmpassword" name="confirmpassword" placeholder=" " required>
                      <i class="ri-lock-line"></i>
                  </div>
            <div class="form-group">
                <label for="userphone">Phone:</label>
                <input type="text" id="userphone" name="userphone" required />
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="userimg" accept="image/*"  />
            </div>
            <button type="submit" name="registerBtn" class="submit-btn">Register</button>

        </form>
        <p>Already have an account? <a href="../login/login.php">Login here</a></p>
    </div>
</body>
</html>
