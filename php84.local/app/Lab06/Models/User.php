<?php
// Weight: 35%
// Step 1: Define the namespace for the class. All classes in the Models folder should be in the Models namespace.
// Step 2: Declare an abstract class named User.
// Step 3: Define $username and $email properties that can be accessed within the class and by child classes but NOT outside of the class or it's children.
// Step 4: Define a private property for the $password.
// Step 5: Create a constructor to initialize the class properties. It should accept username, email, and password as arguments and set the properties accordingly. Note that the password should be set using the setPassword method (see below).
// Step 6: Create a public method called getUsername to return the username.
// Step 7: Create a public method called getEmail to return the email.
// Step 8: Create a public method called getPassword to return the hashed password. (note, this is just for display for the sake of this lab you'd never really do this.)
// Step 9: Define a private method called setPassword. Pass the password through password_hash() and assign the value to the private password property.
// Step 10: Create a public method called checkPassword to verify a password. It should accept the password as an argument. Use PHP's password_verify() function to compare the password with the hashed password stored in the password property.
// Step 11: Declare an abstract method named getRole(). This will be overridden by child classes to return the role of the user.

namespace Models;

abstract class User {
    protected $username;
    protected $email;

    private $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password);
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    private function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkPassword($password) {
        return password_verify($password, $this->password);
    }

    abstract public function getRole();
}
?>