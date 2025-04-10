<?php
/**
 * PHP Lab: Using Sessions and Cookies
 * 
 * Objective: Learn how to use sessions and cookies in PHP to maintain user data across pages.
 * 
 * Detailed Instructions:
 * 
 * Task 1 (10%). Create a plain text file named `credentials.txt` in the same directory as this file and other files for the lab.
 *    - Each line in the file should contain a username and password separated by a colon (`:`).
 *      Example:
 *      ```
 *      alice:password123
 *      bob:qwerty
 *      ```
 *		- You will validate login credentials against this file in login_action.php in task 3. Refer to Lab 3 for a reminder on
 * 		  how to read and loop through files during Task 3, this is no different. Remember, in the real world NEVER STORE
 * 		  PASSWORDS ANYWHERE WITHOUT FIRST HASHING THEM!
 *
 *  Task 2 (25%). In this login.php file, do the following:
 *    - Displays a form asking for a username, password, and favorite color.
 *    - Sends the form data to `login_action.php` for processing using the POST method.
 *    - Includes an HTML section that displays an error message passed via a $_GET attribute (visible only if present)
 *      should the login fail.
 * 
 */
?>

