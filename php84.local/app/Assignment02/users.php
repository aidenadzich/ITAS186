<?php
/**
 * Assignment 2 Instructions
 * 
 * - Check if the user is logged in and is an admin, if not redirect to login.php with a message indicating that the user must be an admin to manage users.
 * - Get all users from the database using the UserManager.
 * - Display all users in a table with the following columns: ID, Username, Email, Full Name, Role, and Actions.
 * - The Actions column should have two links: Edit and Delete.
 * - The Edit link should go to edit-user.php with the user ID as a query parameter.
 * - The Delete link should go to delete-user.php with the user ID as a query parameter and should have a JavaScript confirmation prompt before deleting the user.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "Models/UserManager.php";

$userManager = new UserManager($pdo);

if ($_SESSION['role'] !== 'admin') {
    header("Location login.php?error=You must be an admin to manage users");
     exit;
}

$users = $userManager->getUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script>
        function confirmDelete(userId) {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</head>
<body>
    <h1>Manage Users</h1>
    <a href="new-user.php">New User</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row structure (This will be dynamically generated with PHP) -->
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['fullname'];?></td>
                <td><?php echo $user['role'];?></td>
                <td>
                    <a href="edit-user.php?id=1">Edit</a> |
                    <a href="delete-user.php?id=1" onclick="return confirmDelete(1);">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</body>
</html>