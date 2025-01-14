<?php

session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    foreach ($_SESSION['users'] as $key => $user) {
        if ($user['id'] === $id) {
            unset($_SESSION['users'][$key]); 
            break;
        }
    }

    $_SESSION['users'] = array_values($_SESSION['users']);
}

header("Location: allUsers.php");
exit();
?>