<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script>
        localStorage.clear(); // تشيل كل البيانات
        window.location.href = "../login/login.php"; // توجه المستخدم لصفحة Login
    </script>
</head>
<body>
    <p>جارٍ تسجيل الخروج...</p>
</body>
</html>
