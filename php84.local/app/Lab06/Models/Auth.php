<?php
// Weight: 25%
//Step 1: Define the Namespace
//Step 2: Use the require and use keywords to import and use the Utils/Validator.php file, then Create the Auth Class
//Step 3: Create a private static property called '$users' and initialize it as an empty array. This property will hold an associative array where usernames are keys and User objects are values.
//Step 4: Create a public static method named 'register'. This method accepts a 'User' object as a parameter. Inside the method, add the 'User' object to the static '$users' array within the Auth class, using the user's username (obtained by calling '$user->getUsername()') as the key.
//Step 5: Create a public static method named 'login'. This method accepts two parameters: a $username and a $password.
	// Inside the method, check if the username is valid using the Validator::isValidUsername and that it exists in the '$users' array as a key using 'isset'.
	// If the username exists, retrieve the corresponding 'User' object from the $users property. If it does not exist return null.
	// Use the 'checkPassword' method of the 'User' object to verify the provided password. If the password is correct, return the 'User' object, otherwise return null.
//Step 6: Create a public static method called "getUsers" that returns the static property '$users'.
namespace Models;

require_once __DIR__ . '/../Utils/Validator.php';
use Utils\Validator;

class Auth {
    private static $users = [];

    public static function register($user) {
        self::$users[$user->getUsername()] = $user;
    }

    public static function login($username, $password) {
        if (!Validator::isValidUsername($username) || !isset(self::$users[$username])) {
            return null;
        }

        $user = self::$users[$username];

        if ($user->checkPassword($password)) {
            return $user;
        }

        return null;
    }

    public static function getUsers() {
        return self::$users;
    }
}
?>