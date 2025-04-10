<?php

// This file's code is written for you. You're welcome to look through it, but you don't need to change anything. Confirm all the steps in the lab instructions are complete using the provided class, namespace, property, and method names or change them in the code below.

// Your code should result in the following functionality without modifying this file:
	// Using the Login form and the username and password for the default admin, you should be able to log in successfully as shown by the message at the top. Note that the user name is retrieved from the User object and displayed in the message.
	// You should be able to register new users using the Register form. They should appear at the bottom of the page.
	// You will not be able to login with the new user (it will disappear on refresh) as it is not being saved anywhere, just stored in a class property. In a real project, such as assignment 2, you'll store credentials and compare against those in a file instead of the array in the Auth class so they persist between reloads.



require_once 'Models/User.php';
require_once 'Models/Admin.php';
require_once 'Models/Member.php';
require_once 'Models/Auth.php';

use Models\Admin;
use Models\Member;
use Models\Auth;

// Create a default admin
$admin = new Admin('admin', 'admin@example.com', 'password123');

// Initialize Auth system
$auth = new Auth();
$auth->register($admin);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['register'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		if ($role === 'admin') {
			$user = new Admin($username, $email, $password);
		} else {
			$user = new Member($username, $email, $password);
		}

		$auth->register($user);
	} elseif (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$user = $auth->login($username, $password);
		if ($user) {
			echo 'Login of ' . $user->getUsername() . ' successful!';
		} else {
			echo 'Login failed!';
		}
	}
}

// Get the list of registered users
$users = $auth->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Authentication System</title>
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
	<div class="container mx-auto">
		<h1 class="text-2xl font-bold mb-4">Authentication System</h1>

		<div class="mb-6">
			<h2 class="text-xl font-semibold mb-2">Register</h2>
			<form method="POST" class="bg-white p-4 rounded shadow-md">
				<div class="mb-4">
					<label class="block text-gray-700">Username</label>
					<input type="text" name="username" class="w-full p-2 border border-gray-300 rounded">
				</div>
				<div class="mb-4">
					<label class="block text-gray-700">Email</label>
					<input type="email" name="email" class="w-full p-2 border border-gray-300 rounded">
				</div>
				<div class="mb-4">
					<label class="block text-gray-700">Password</label>
					<input type="password" name="password" class="w-full p-2 border border-gray-300 rounded">
				</div>
				<div class="mb-4">
					<label class="block text-gray-700">Role</label>
					<select name="role" class="w-full p-2 border border-gray-300 rounded">
						<option value="member">Member</option>
						<option value="admin">Admin</option>
					</select>
				</div>
				<button type="submit" name="register" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
			</form>
		</div>

		<div class="mb-6">
			<h2 class="text-xl font-semibold mb-2">Login</h2>
			<form method="POST" class="bg-white p-4 rounded shadow-md">
				<div class="mb-4">
					<label class="block text-gray-700">Username</label>
					<input type="text" name="username" class="w-full p-2 border border-gray-300 rounded">
				</div>
				<div class="mb-4">
					<label class="block text-gray-700">Password</label>
					<input type="password" name="password" class="w-full p-2 border border-gray-300 rounded">
				</div>
				<button type="submit" name="login" class="bg-green-500 text-white px-4 py-2 rounded">Login</button>
			</form>
		</div>

		<div class="mt-6">
			<h2 class="text-xl font-semibold mb-2">Registered Users</h2>
			<ul class="bg-white p-4 rounded shadow-md">
				<?php foreach ($users as $user): ?>
					<li class="mb-2">
						<strong>Username:</strong> <?php echo htmlspecialchars($user->getUsername()); ?>,
						<strong>Email:</strong> <?php echo htmlspecialchars($user->getEmail()); ?>,
						<strong>Role:</strong> <?php echo htmlspecialchars($user->getRole()); ?>
						<strong>Password:</strong> <?php echo htmlspecialchars($user->getPassword()); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</body>
</html>