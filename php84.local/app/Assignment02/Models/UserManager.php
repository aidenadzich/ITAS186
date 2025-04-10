<?php
/**
 * Assignment 2 Instructions
 * 
 * - Create a new class called UserManager in the Models namespace.
 * - The UserManager class should have the following properties:
 * --- A private property called file that stores the path to the file where user data is stored.
 * - The UserManager class should have the following methods: 
 * --- A constructor that checks if the file exists and creates it if it doesn't. 
 * --- A getUsers method that reads the user data from the file and returns an array of User objects. 
 * --- A getUser method that accepts a user ID and returns the corresponding User object. If the user ID is not found, it should return null.
 * --- A createUser method that accepts a username, email, full name, role, and password, creates a new User object, and adds it to the user data file. If the username is already in use, it should return an error message. Note: Use the password_hash function to hash the password.
 * --- An editUser method that accepts a user ID, email, full name, role, and password, updates the corresponding User object, and saves the changes to the user data file. If the password is empty, it should not be updated. 
 * --- A deleteUser method that accepts a user ID and deletes the corresponding User object from the user data file. Only users with the role 'admin' should be able to delete users.
 * --- An isUsernameAvailable method that accepts a username and checks if it is available in the user data file. It should return true if the username is available, false otherwise.
 * --- A private method called userToString that accepts a User object and converts it to a string format for storage in the file.
 * --- A private method called stringToUser that accepts a string and converts it to a User object.
 */

 include 'Utils/config.php';

class UserManager {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function getUsers() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUser($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $email, $fullname, $role, $password) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            return "Username is already taken.";
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, fullname, role, password_hash) VALUES (?, ?, ?, ?, ?)");
        $success = $stmt->execute([$username, $email, $fullname, $role, $passwordHash]);

        return $success ? true : "Failed to create user";
    }

    


}