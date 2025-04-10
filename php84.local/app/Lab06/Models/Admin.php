<?php
// Weight: 15%
// Step 1: Define the namespace for the class.
//Step 2: Create the Admin Class extending the User Class.
//Step 3: Use Polymorphism to override the getRole Method of the User class within the Admin class. The method should return the string "Admin" when called. This method does not take any arguments.

namespace Models;

require_once 'User.php';

class Admin extends User {
    public function getRole() {
        return "Admin";
    }
}