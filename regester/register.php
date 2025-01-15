<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="login-container">
        <h2>Create Account</h2>
        <?php
        if (isset($_GET["message"])) {
            echo "<p class='alert alert-info'>" . htmlspecialchars($_GET["message"]) . "</p>";
        }
        ?>
        <form action="../databasePHP/server.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required placeholder="Enter username" />
            </div>
            <div class="form-group">
                <label for="useremail">Email:</label>
                <input type="email" id="useremail" name="useremail" required placeholder="Enter email" />
            </div>
            <div class="form-group">
                <label for="userpassword">Password:</label>
                <input type="password" id="userpassword" name="userpassword" required placeholder="Enter password" />
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirm Password:</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required placeholder="Confirm password" />
            </div>
            <div class="form-group">
                <label for="userphone">Phone:</label>
                <input type="text" id="userphone" name="userphone" required placeholder="Enter phone number" />
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
                <input type="file" id="profile_image" name="userimg" accept="image/*" class="form-control" />
            </div>
            <button type="submit" name="registerBtn" class="submit-btn">Create Account</button>
        </form>
        <p>Already have an account? <a href="../login/login.php">Login here</a></p>
    </div>
</body>

</html>