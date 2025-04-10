<?php
/**
 * Assignment 2 Instructions 
 * 
 * - Create a new class called Auth in the Models namespace.
 * - The Auth class should have the following properties:
 * --- A public method called login that accepts a username and password, gets all users, then authenticates the username+password against the set of users. If a user with matching username and password found, return true; otherwise return false. Note: Use the password_verify function to verify the password. 
 * --- A public method called logout that destroys the session. 
 * --- A public method called isLoggedIn that returns true if a user is logged in, false otherwise. 
 * --- A public method called getUser that returns the currently logged-in user as a User object from the Session. If no user is logged in, return false.
 */

