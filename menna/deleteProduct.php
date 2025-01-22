<?php
// session_start();

require('../databasePHP/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$query= "delete from products where product_id = ?;";
$statement = $connection->prepare($query);
$statement->execute([$id]);



}
header('Location:../menna/index.php');



?>
