<?php
// Start session at the beginning
session_start();

// Check if the script is accessed via HTTP request and if it's a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if username and password are set
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        try {
            require_once "database.php";

            // Prepare and execute the query to fetch the user from the database
            $query = "SELECT * FROM chat_users WHERE username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            // Verify user exists and password matches
            if ($user && password_verify($password, $user['password'])) {
                // Start session and store user data if login is successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Redirect user to the chat interface (logged.in.php)
                header("Location: ../logged.in.php");
                exit();
            } else {
                // If username or password is incorrect, redirect back to login page with error message
                header("Location: ../index.php?error=invalid_credentials");
                exit();
            }

        } catch (PDOException $e) {
            // Handle database errors
            die("Query failed: " . $e->getMessage());
        }
    }
}

// If the script is accessed via invalid method or missing POST data, redirect back to login page
header("Location: ../index.php");
exit();
