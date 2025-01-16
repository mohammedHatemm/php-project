<?php
// بدء الجلسة
session_start();

// إذا لم تكن مصفوفة المستخدمين موجودة في الجلسة، قم بإنشائها
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// البحث عن المستخدم المطلوب بناءً على الـ ID
$user = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // تحويل الـ ID إلى عدد صحيح

    foreach ($_SESSION['users'] as $u) {
        if ($u['id'] === $id) {
            $user = $u;
            break;
        }
    }
}

// إذا لم يتم العثور على المستخدم، قم بإعادة التوجيه إلى صفحة allUsers.php
if (!$user) {
    header("Location: allUsers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addUser.css">
    <title>Edit User</title>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="updateUser.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
            </select>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
