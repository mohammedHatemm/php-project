
<?php
// بدء الجلسة
session_start();
$users = [
    ["id" => 1, "username" => "admin", "email" => "admin@Examlbe.com", "role" => "admin"],
    ["id" => 2, "username" => "user1", "email" => "user1@Example.com", "role" => "user"],
];
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// استرجاع بيانات المستخدمين من الجلسة
$users = $_SESSION['users'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\allUsers.css">
    <title>All Users</title>
</head>

<body>
<?php
include('navbar.html') ;
include('header.php');
// بيانات وهمية للمنتجات
$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
?>
    <div class="container">
        <h1>All Users</h1>
        <a href="addUser.php" class="btn">Add User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="editUser.php?id=<?php echo $user['id']; ?>" class="btn edit"><img src="images\edit.png" alt="" width="17px" hight="26px"></a>
                            <a href="deleteUser.php?id=<?php echo $user['id']; ?>" class="btn delete"><img src="images\bin.png" alt="" width="17px" hight="26px"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>