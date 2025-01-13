<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: login.html");
    exit();
}

require_once "../databasePHP/connection.php";

$userId = $_SESSION["user_id"];
$query = "SELECT * FROM users WHERE id = :userId";
$statement = $connection->prepare($query);
$statement->bindParam(':userId', $userId);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($user["username"]); ?></h2>
        <p>Email: <?php echo htmlspecialchars($user["useremail"]); ?></p>
        <p>Phone: <?php echo htmlspecialchars($user["userphone"]); ?></p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
