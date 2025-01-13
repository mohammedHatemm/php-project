 <?php




require_once "connection.php";

// Register (Signup)
if (isset($_POST["registerBtn"])) {
    $userName = $_POST["username"] ?? null;
    $userPassword = $_POST["userpassword"] ?? null;
    $userEmail = $_POST["useremail"] ?? null;
    $userPhone = $_POST["userphone"] ?? null;
    $encryptedPassword = md5($userPassword);

    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email = :userEmail";
    $statement = $connection->prepare($checkEmail);
    $statement->bindParam(':userEmail', $userEmail);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        header("location:../regester/register.php
        ?message=" . urlencode("Email already exists"));
        exit();
    }

    // Validate name
    $namePattern = "/^[a-zA-Z ]{3,}$/";
    if (!preg_match($namePattern, $userName)) {
        header("location: ../regester/register.php?message=" . urlencode("Invalid username, please enter a name with at least 3 characters"));
        exit();
    }

    // Validate email
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../regester/register.php?message=" . urlencode("Your email is incorrect, check your email and try again"));
        exit();
    }

    // Validate password
    $passwordPattern = "/^[1-9]{5,}$/";
    if (!preg_match($passwordPattern, $userPassword)) {
        // header("location: ../public/register.html?message=" . urlencode("Invalid password, please enter a password with at least 5 numbers"));
        // exit();
        header("location:../regester/register.php?message=" . urlencode("Invalid password, please enter a password with at least 5 numbers"));
        exit();
    }

    // Insert new user
    $query = "INSERT INTO users (username, password, email, phone) VALUES (:userName, :userPassword, :userEmail, :userPhone)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':userName', $userName);
    $statement->bindParam(':userPassword', $encryptedPassword);
    $statement->bindParam(':userEmail', $userEmail);
    $statement->bindParam(':userPhone', $userPhone);
    $statement->execute();

    header("location:../login/login.php?message=" . urlencode("Your account created successfully"));
    exit();
}

// Login
if (isset($_POST["btnLogin"])) {
    $userEmail = $_POST["useremail"];
    $userPassword = $_POST["userpassword"];
    $encryptedPassword = md5($userPassword);

    // Check login credentials
    $query = "SELECT * FROM users WHERE email = :userEmail AND password = :userPassword";
    $statement = $connection->prepare($query);
    $statement->bindParam(':userEmail', $userEmail);
    $statement->bindParam(':userPassword', $encryptedPassword);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        session_start();
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["username"] = $result["username"];
        header("location: ../login/profile.php");
        exit();
    } else {
        header("location:../login/login.php?message=" . urlencode("Invalid email or password, please try again"));
        exit();
    }
}
