<?php

// Database configuration
$dbtype = "mysql";
$dbhost = "localhost";
$dbname = "cafateria";
// $dbname = "cafeteriaphp";
$dbuser = "root";
$dbpass = "123456";

try {
    // Create a PDO instance
    $connection = new PDO("$dbtype:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Close the connection when not in use
// $connection = null;
