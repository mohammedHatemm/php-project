<?php

// $dbtype = "mysql";
// $dbhost = "localhost";
// $dbname = "cafateria";
// $dbuser = "root";
// $dbpass = "Mn123456789";




// $connection = new PDO("$dbtype:host=$dbhost;dbname= $dbname", $dbuser, $dbpass);




$dbtype = "mysql";
$dbhost = "localhost";
$dbname = "cafateria";
$dbuser = "root";
$dbpass = "Mn123456789";

try {
    $connection = new PDO("$dbtype:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
