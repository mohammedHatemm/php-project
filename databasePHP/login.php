 <?php



require_once "../databasePHP/connection.php";



// Login
if (isset($_POST["btnLogin"])) {
    $userEmail = $_POST["useremail"] ?? null;
    $userPassword = $_POST["userpassword"] ?? null;

    // التحقق من بيانات تسجيل الدخول
    $query = "SELECT * FROM users WHERE email = :userEmail";
    $statement = $connection->prepare($query);
    $statement->bindParam(':userEmail', $userEmail);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($userPassword, $result["password"])) {
        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["username"] = $result["username"];
        header("location:../main-page/main.html");
        exit();
    } else {
        header("location:../login/login.php?message=" . urlencode("Invalid email or password, please try again."));
        exit();
    }
}
