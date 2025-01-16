<?php

session_start();
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);

    $newUser = [
        "id" => count($_SESSION['users']) + 1,
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "role" => $role
    ];

    array_push($_SESSION['users'], $newUser);


    header("Location: allUsers.php");
    exit();
}
?>
