<?php
/**
 * Assignment 2 Instructions
 * 
 * - Create a login form to gather the user's username and password.
 * - If the user is already logged in and attempts to visit login.php, redirect them to index.php.
 * - When the form is submitted, validate and sanitize all data and ensure required values are submitted, then login the user using the Auth class and redirect them to index.php
 * - If the username or password does not validate, display an error message at the top of the login form. Note: see the success and error get attribute blocks in the index.php file for an example of how to display messages.
 */

 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'Utils/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Pull user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password is correct
    if ($user && password_verify($password, $user['password_hash'])) {
        
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $user["role"];
        header("Location: index.php");
        exit;
        
    } else {
        echo "<p>Invalid username or password.</p>";
    }
}
?>


<div class="container">
    <h2>Login</h2>
    <form method="post">

        <!-- Username field -->
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>

        <!-- Password field -->
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
