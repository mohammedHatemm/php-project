
<?php
// session_start();

require('../databasePHP/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$query= "delete from users where user_id = ?;";
$statement = $connection->prepare($query);
$statement->execute([$id]);



}
header('Location:../menna/allUsers.php');



?>
