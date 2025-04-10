<?php
// Weight: 15%
// Step 1: Define a namespace for the class. Hint: Same as in Logger but you're in a different folder.
// Step 2: Declare a class named Validator.
// Step 3: Create a public static method called isValidEmail that accepts an email address as an argument and returns true if the email is valid and false if it is not. Use the filter_var() function with the FILTER_VALIDATE_EMAIL filter to validate the email address.
// Step 4: Create a public static method called isValidUsername that accepts a username as an argument and returns true if the username is at least 5 characters long and false if it is not.

namespace Utils;

class Validator {
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function isValidUsername($username) {
        return strlen($username) >= 5;
    }
}
?>