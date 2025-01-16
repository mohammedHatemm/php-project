  <?php



header("Content-Type: application/json");

// الاتصال بقاعدة البيانات
$dbtype = "mysql";
$dbhost = "localhost";
$dbname = "cafateria";
$dbuser = "root";
$dbpass = "123456";

try {
    $connection = new PDO("$dbtype:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// جلب البيانات من الجدول
$query = "SELECT * FROM products";
$statement = $connection->prepare($query);
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// إرجاع البيانات بتنسيق JSON
echo json_encode($products);





// header("Content-Type: application/json");

// try {
//     $connection = new PDO("mysql:host=localhost;dbname=cafateria", "root", "123456");
//     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // جلب البيانات من الجدول مع تحويل مسار الصورة لـ URL كامل
//     $query = "SELECT product_id, productName, category, price ,product_description, CONCAT('http://localhost/uploads/', product_img) AS product_img FROM products";
//     $statement = $connection->prepare($query);
//     $statement->execute();
//     $products = $statement->fetchAll(PDO::FETCH_ASSOC);

//     echo json_encode($products);
// } catch (PDOException $e) {
//     echo json_encode(["error" => "Failed to fetch data: " . $e->getMessage()]);
// }
// ?>
