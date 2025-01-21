<?php
session_start();
require_once "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    

    // Default image path
    $defaultImage = "uploads/default.png"; // Path to your default image

    // Handle file upload
    $image = $defaultImage; // Initialize with default image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/"; // Directory where the image will be saved
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Create the directory if it doesn't exist
        }

        // Validate file type
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        $fileType = $_FILES['image']['type'];

        if (in_array($fileType, $allowedTypes)) {
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file; // Save the file path in the database
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        } else {
            echo "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
            exit;
        }
    }

    // Prepare the SQL statement
    $newproduct = "INSERT INTO products (productName, price, category, product_description, product_imge) VALUES (:name, :price, :category, :description, :product_img)";
    $stmt = $connection->prepare($newproduct);

    if ($stmt) {
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':product_img', $image);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Error preparing statement: " . $connection->errorInfo()[2];
    }

    // Close the connection
    $connection = null;
}
?>
