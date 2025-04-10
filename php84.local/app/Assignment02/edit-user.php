<?php
/**
 * Assignment 2 Instructions
 * 
 * - Confirm the current user is an admin. If they are not, redirect them to the index.php page with an error indicating they must be an admin to create users.
 * - Confirm the user ID is provided in the URL. If it is not, redirect the user to the users.php page with an error indicating no user ID was provided.
 * - Confirm the user ID is valid and exists in the users.txt file. If it is not, redirect the user to the users.php page with an error indicating the user was not found.
 * - Include a link back to the users.php page.
 * - Create an edit user form to gather the user's email, full name, role, and password. The username should be displayed, but not be a form field or otherwise  made editable. The form should be pre-populated with information from the current user being edited(except for the password). The password field should be blank, with a messaging indicating the password will not be changed if the field is empty.
 * - The form should also include a hidden input field for the user ID's (not the current user's ID, the one being edited and passed to this page as GET attribute).
 * - When the form is submitted, validate and sanitize all data and ensure required values are submitted then attempt edit the user using the UserManager class.
 * - If the user was edited successfully, redirect the user to the users.php page with a success message indicating the user was edited. If the user was not edited (missing required field values, id of user is not found, etc.), redirect the user back to the edit-user.php page with an error indicating why the user was not edited.
 */
