<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color:rgb(52, 56, 60);
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #roomNumField {
            display: none;
        }
    </style>
</head>
<body>
    <h2>تسجيل مستخدم جديد</h2>
    <form action="tsst4.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="اسم المستخدم" required>
        <input type="password" name="userpassword" placeholder="كلمة المرور" required>
        <input type="password" name="confirmpassword" placeholder="تأكيد كلمة المرور" required>
        <input type="email" name="useremail" placeholder="البريد الإلكتروني" required>
        <input type="text" name="userphone" placeholder="رقم الهاتف" required>
        <select name="role" required>
            <option value="user">مستخدم</option>
            <option value="admin">مدير</option>
        </select>
        <div id="roomNumField">
            <select name="room_num" required>
                <option value="">اختر رقم الغرفة</option>
                <?php
                require_once "../databasePHP/connection.php";
                $query = "SELECT room_num FROM rooms WHERE is_available = TRUE";
                $statement = $connection->prepare($query);
                $statement->execute();
                $rooms = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rooms as $room) {
                    echo "<option value='{$room['room_num']}'>{$room['room_num']}</option>";
                }
                ?>
            </select>
        </div>
        <input type="file" name="userimg" required>
        <button type="submit" name="registerBtn">تسجيل</button>
    </form>

    <script>
        // إظهار أو إخفاء حقل رقم الغرفة بناءً على الدور المحدد
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            const roomNumField = document.getElementById('roomNumField');
            if (this.value === 'user') {
                roomNumField.style.display = 'block';
            } else {
                roomNumField.style.display = 'none';
            }
        });
    </script>
</body>
</html>
