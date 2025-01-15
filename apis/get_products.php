  <?php



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
// header("Access-Control-Allow-Methods:GET");
// header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-with");

 include '../databasePHP/connection.php';


try {

    $stmt = $connection->prepare("SELECT * FROM products");
    $stmt->execute();


    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($products);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}


// header("Content-Type: application/json");

// $method = $_SERVER['REQUEST_METHOD'];
// $input = json_decode(file_get_contents('php://input'), true);

// switch ($method) {
//     case 'GET':
//         handleGet($connection);
//         break;
//     case 'POST':
//         handlePost($connection, $input);
//         break;
//     case 'PUT':
//         handlePut($connection, $input);
//         break;
//     case 'DELETE':
//         handleDelete($connection, $input);
//         break;
//     default:
//         echo json_encode(['message' => 'Invalid request method']);
//         break;
// }

// function handleGet($connection) {
//     $sql = "SELECT * FROM products";
//     $stmt = $connection->prepare($sql);
//     $stmt->execute();
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     echo json_encode($result);
// }

// function handlePost($connection, $input) {
//     $sql = "INSERT INTO products (name, email) VALUES (:name, :email)";
//     $stmt = $connection->prepare($sql);
//     $stmt->execute(['name' => $input['name'], 'email' => $input['email']]);
//     echo json_encode(['message' => 'User created successfully']);
// }

// function handlePut($connection, $input) {
//     $sql = "UPDATE products SET name = :name, email = :email WHERE id = :id";
//     $stmt = $connection->prepare($sql);
//     $stmt->execute(['name' => $input['name'], 'email' => $input['email'], 'id' => $input['id']]);
//     echo json_encode(['message' => 'User updated successfully']);
// }

// function handleDelete($connection, $input) {
//     $sql = "DELETE FROM products WHERE id = :id";
//     $stmt = $connection->prepare($sql);
//     $stmt->execute(['id' => $input['id']]);
//     echo json_encode(['message' => 'User deleted successfully']);
// }
// ?>
