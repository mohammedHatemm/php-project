<?php
require_once "../databasePHP/connection.php";

// Fetch distinct categories
$sql = "SELECT DISTINCT category FROM products";
$stmt = $connection->prepare($sql);
$categories = array();

try {
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Error fetching categories: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Validate form data
        $name = trim($_POST['name']);
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        $description = trim($_POST['description']);
        $category = trim($_POST['category']);

        if (empty($name) || $price === false || empty($description) || empty($category)) {
            throw new Exception("Please fill all required fields with valid data.");
        }

        // Handle image upload
        $image_path = "../product-img/americano.jpg"; // Default image path

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = $_FILES['image']['type'];
            $file_size = $_FILES['image']['size'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if (!in_array($file_type, $allowed_types)) {
                throw new Exception("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
            }

            if ($file_size > $max_size) {
                throw new Exception("File is too large. Maximum size is 5MB.");
            }

            // Create upload directory if it doesn't exist
            $upload_dir = __DIR__ . "/uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique filename
            $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $unique_filename = uniqid('product_', true) . '.' . $file_extension;
            $upload_path = $upload_dir . $unique_filename;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                throw new Exception("Failed to upload image.");
            }

            $image_path = "uploads/" . $unique_filename;
        }

        // Insert into database
        $query = "INSERT INTO products (productName, price, category, product_description, product_img)
                 VALUES (:name, :price, :category, :description, :image)";

        $stmt = $connection->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':category' => $category,
            ':description' => $description,
            ':image' => $image_path
        ]);

        $success_message = "Product added successfully!";

    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-label {
            font-weight: bold;
            margin-top: 1rem;
        }

        .preview-image {
            max-width: 200px;
            margin-top: 1rem;
        }

        .error-message {
            color: #dc3545;
            margin-top: 0.5rem;
        }

        .success-message {
            color: #198754;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
<?php
//  include('navbar.html') ;
require_once "../nave/nave.php";

include('header.php');

?>
    <div class="container">
        <h1 class="text-center mb-4">Add Product</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['category']); ?>">
                            <?php echo htmlspecialchars($cat['category']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                <img id="imagePreview" class="preview-image d-none" alt="Preview">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Save Product</button>
                <a href="index.php" class="btn btn-secondary">Back to Products</a>
            </div>
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
