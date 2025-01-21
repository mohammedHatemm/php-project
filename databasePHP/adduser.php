<?php
session_start();
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $phone = $_POST['userphone'] ?? null;
    $role = $_POST['role'] ?? 'user';
    $userimg = $_FILES['userimg'] ?? null;
    $roomNum = $_POST['room_num'] ?? null;

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:../addUser.php?message=" . urlencode("Invalid email format."));
        exit();
    }

    // Handle image upload
    $uploadFilePath = null;
    if (isset($userimg) && $userimg['error'] == 0) {
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        $fileType = $userimg['type'];

        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = "../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = uniqid() . "_" . basename($userimg['name']);
            $uploadFilePath = $uploadDir . $fileName;

            if (!move_uploaded_file($userimg['tmp_name'], $uploadFilePath)) {
                header("location:../addUser.php?message=" . urlencode("Failed to upload image."));
                exit();
            }
        } else {
            header("location:../addUser.php?message=" . urlencode("Invalid file type. Only JPEG, PNG, and GIF are allowed."));
            exit();
        }
    } else {
        $uploadFilePath = "../uploads/default.png"; // Use a default image if no image is uploaded
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the user already exists
    $checkQuery = "SELECT * FROM users WHERE email = :email OR username = :username";
    $checkStatement = $connection->prepare($checkQuery);
    $checkStatement->bindParam(':email', $email);
    $checkStatement->bindParam(':username', $username);
    $checkStatement->execute();

    if ($checkStatement->rowCount() > 0) {
        header("location:../addUser.php?message=" . urlencode("User with this email or username already exists."));
        exit();
    }

    // Validate room number for users
    if ($role === 'user' && empty($roomNum)) {
        header("location:../addUser.php?message=" . urlencode("The room number is required for users."));
        exit();
    }

    // Insert the new user into the database
    $query = "INSERT INTO users (username, password, email, phone, role, user_img, room_num) VALUES (:username, :password, :email, :phone, :role, :user_img, :room_num)";
    $statement = $connection->prepare($query);

    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashedPassword);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':role', $role);
    $statement->bindParam(':user_img', $uploadFilePath);
    $statement->bindParam(':room_num', $roomNum);

    if ($statement->execute()) {
        header("location:../menna/allUsers.php?message=" . urlencode("User added successfully!"));
        exit();
    } else {
        header("location:../addUser.php?message=" . urlencode("Error adding user."));
        exit();
    }
}
?>
