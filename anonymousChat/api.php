<?php
session_start();

$info = (object)[];

if (!isset($_SESSION['user_id'])) {
    $info->logged_in = false;
    echo json_encode($info);
    die;
}

// Include the database connection details from an external file
require_once "db_config.php";

// Create connection using PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$ERROR = "";

if (isset($DATA_OBJ->data_type)) {
    switch ($DATA_OBJ->data_type) {
        case "signup":
            // Include the signup.php file and pass the connection object
            include("includes/signup.php");
            break;
        case "login":
            // Include the login.php file and pass the connection object
            include("includes/login.php");
            break;
        default:
            $ERROR = "Invalid data type";
    }
} else {
    $ERROR = "Data type not provided";
}

// Return error response if applicable
if ($ERROR) {
    $info->error = $ERROR;
    echo json_encode($info);
}

// Close the database connection
$conn = null;
