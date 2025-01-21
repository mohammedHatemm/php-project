

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addUser.css">
    <title>Add User</title>
</head>
<body>
    <?php
    include('navbar.html');
    include('header.php');
    ?>

    <div class="container">
        <h1>Add User</h1>
        <form action="../databasePHP/adduser.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="userphone">Phone:</label>
            <input type="text" name="userphone" required>

            <label for="profile_image">Profile Image:</label>
            <input type="file" name="userimg" accept="image/*" >

            <div class="form-group" id="roomNumField">
                <label for="room_num">Room Number:</label>
                <input type="number" name="room_num" placeholder="Room number">
            </div>

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <button type="submit" class="btn">Save</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
