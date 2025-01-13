<?php

$dbtype = "mysql";
$dbhost = "localhost";
$dbname = "cafateria";
$dbuser = "root";
$dbpass = "Mn123456789";
$connection = new PDO("$dbtype:host=$dbhost;dbname= $dbname
", $dbuser, $dbpass);
