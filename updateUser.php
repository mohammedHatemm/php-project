<?php

session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = intval($_POST['id']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

   
    foreach ($_SESSION['users'] as &$user) {
        if ($user['id'] === $id) {
            $user['username'] = $username;
            $user['email'] = $email;
            $user['role'] = $role;
            break;
        }
    }

    header("Location: allUsers.php");
    exit();
}
?>