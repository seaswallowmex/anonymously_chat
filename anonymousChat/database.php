<?php

$dsn = "mysql:host=localhost;dbname=anonymously_chat";
$dbusername = "root";
$dbpassword = "Altaa1203@@@";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();

}