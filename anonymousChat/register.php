<?php
session_start();
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["password2"];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        die("Passwords do not match");
    }

    try {
        $query = "INSERT INTO chat_users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $password]);

        // Redirect to signup success page
        header("Location: signedup.php");
        exit();

    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    // If accessed via invalid method, redirect to signup page
    header("Location: signup.php");
    exit();
}
