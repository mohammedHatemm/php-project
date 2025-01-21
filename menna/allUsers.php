<?php
session_start();
 require_once '../databasePHP/connection.php';

session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') {

   header("Location:../main-page/main.php");
   exit();
}


$query = "select * from users";

// var_dump($users);

$result = $connection ->prepare($query);
$result->execute();
$users = $result ->fetchAll(PDO ::FETCH_ASSOC);



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
                    <th>Imge</th>
                    <th>user </th>
                    <th>delete</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>

                        <td>

                            <a href="deleteUser.php?id=<?php echo $user['user_id']; ?>" class="btn delete"><img src="<?php echo $user['user_img'];?>" alt="" width="17px" hight="26px"></a>
                        </td>

                        <td>

                            <a href="../rwda/order_admin.php?id=<?php echo $user['user_id']; ?>" class="btn delete"></a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
