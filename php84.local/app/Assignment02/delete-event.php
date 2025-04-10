<?php
/**
 * Assignment 2 Instructions
 * 
 * - Check the user is allowed to delete this event. If they are not redirect to index.php with an error message. Admins can delete any event, editors and members can only delete events they created.
 * - Check the event id is set in the GET request. If not, redirect to index.php with an error message indicating to try again.
 * - If the user is allowed to delete the event, attempt to delete it.
 * - If successful, redirect to index.php with a success message. If not (user's id did not exist, etc.), redirect to index.php with an error message.
 */

// Import and use classes
require_once 'Models/EventHandler.php'; // Include the EventHandler class file
use Models\EventHandler; // Use the EventHandler class from the Models namespace

// Handle Form Submission
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) { // Check if the request method is GET
	$eventHandler = new EventHandler( $_GET ); // Instantiate EventHandler with GET parameters
	$eventHandler->handleRequest(); // Call the handleRequest method to process the request
}