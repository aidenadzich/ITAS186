<?php
/**
 * Assignment 2 Instructions
 * 
 * - Confirm the current user is an admin. If they are not, redirect them to the index.php page with an error indicating they must be an admin to create users.
 * - Include a link back to the users.php page.
 * - Create a new user form to gather the user's username, email, full name, role, and password.
 * - When the form is submitted, validate and sanitize all data and ensure required values are submitted, then attempt create the user using the UserManager class, checking the username is unique before creating the user.
 * - redirect the user to the users.php page with a success message indicating the user was created. If the user was not created (missing required field values, non-unique username, etc.), redirect the user back to the new-user.php page with an error indicating why the user was not created.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'Utils/config.php';
require_once 'Models/UserManager.php';
$user = null;
if (isset($_SESSION['id'])) {
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

 if ($_SESSION['role'] !== 'admin') {
     header("Location index.php?error=You must be an admin to create users");
     exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = trim($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $fullname = trim($_POST['fullname']);
    $role = in_array($_POST['role'], ['admin', 'user']) ? $_POST['role'] : 'user';
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($fullname) || empty($password)) {
        header("Location: new-user.php?error=All fields are required.");
        exit;
    }

    $userManager = new UserManager($pdo);
    $result = $userManager->createUser($username, $email, $fullname, $role, $password);

    if ($result === true) {
        header("Location: users.php?success=User created successfully");
    } else {
        header("Location: new-user.php?error=" . urlencode($result));
    }
    exit;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create New User</title>
</head>
<body>
    <h2>Create a New User</h2>
    
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Full Name:</label>
        <input type="text" name="fullname" required><br>

        <label>Role:</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Create User</button>
    </form>

    <a href="users.php">Back to Users</a>
</body>
</html>
