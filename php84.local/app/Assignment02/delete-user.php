<?php
/**
 * Assignment 2 Instructions
 * 
 * - Confirm the current user is an admin. If they are not, redirect them to the index.php page with an error indicating they must be an admin to delete users.
 * - Confirm the user ID is provided in the URL. If it is not, redirect the user to the users.php page with an error indicating no user ID was provided.
 * - If the user ID is provided, attempt to delete the user using the UserManager class. Redirect the user back to users.php with a success indicating the user was deleted. If the user was not deleted (id did not exist in users.txt), redirect the user back to users.php with an error indicating the user was not found.
 */

