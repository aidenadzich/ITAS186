<?php
/**
 * Assignment 2 Instructions:
 * 
 * - Add a login button that links to the login.php page if the user is not logged in.
 * - Add a logout button that links to the logout.php page if the user is logged in.
 * - Add a "Manage User" button that links to the users.php page if the user is logged in and is an admin.
 * - Add a welcome message that displays the user's full name and role if the user is logged in.
 * - Add an Author column listing the full name of the event author.
 * - Add an Actions column with Edit and Delete links for each event. Display the edit link if the user is an admin or editor, or if the user is the author of the event. Display the delete button if the user is an admin or author of the event.
 * 
 */

 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "Models/UserManager.php";

$userManager = new UserManager($pdo);

if (isset($_SESSION['user_id'])) {
	$userData = $userManager->getUser($_SESSION['user_id']);
	$loggedIn = true;
}

// Import and use classes
require_once 'Models/Event.php';
use Models\Event;
include 'Utils/config.php';

// Get all events from the file 'events.txt', ignoring empty lines
$events = file( 'events.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

// Initialize arrays to categorize events
$pastEvents = $thisWeekEvents = $futureEvents = [];

// Get the current date and time
$today = new DateTime();

// Get the date and time for one week from today
$nextWeek = ( clone $today )->modify( '+7 days' );

// Loop through each line in the events file
foreach ( $events as $line ) {
	// Create an Event object from the line
	$event = Event::fromString( $line );

	// Categorize the event based on its end date
	if ( $event->end < $today ) {
		$pastEvents[] = $event;
	} elseif ( $event->end <= $nextWeek ) {
		$thisWeekEvents[] = $event;
	} else {
		$futureEvents[] = $event;
	}
}
?>
<!-- Index HTML -->
<!DOCTYPE html>
<html>

	<head>
		<!-- Include Tailwind CSS for styling -->
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Event List</title>
	</head>

	

	<body class="container mx-auto p-4">
		<p><?php if ($loggedIn == true) { echo ("Welcome " . $userData['fullname'] . " (" . $userData['role'] . ")"); }?></p>
		<h1 class="text-2xl font-bold mb-4">Event List</h1>

		<!-- Display success message if present in the URL parameters -->
		<?php if ( isset( $_GET[ 'success' ] ) ) { ?>
			<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
				<span class="block sm:inline"><?php echo htmlspecialchars( $_GET[ 'success' ] ); ?></span>
			</div>
		<?php } ?>

		<!-- Display error message if present in the URL parameters -->
		<?php if ( isset( $_GET[ 'error' ] ) ) { ?>
			<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
				<span class="block sm:inline"><?php echo htmlspecialchars( $_GET[ 'error' ] ); ?></span>
			</div>
		<?php } ?>

		<!-- Link to create a new event -->
		<a href="new-event.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">New Event</a>

		<?php 
			if ($loggedIn == true):
		?>
			<a href="logout.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Logout</a>
			<a href="users.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Manage Users</a>
		<?php else: ?>
			<a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
		<?php endif; ?>
		<!-- Loop through each event category and display the events in a table -->
		<?php foreach ( [ "Past Events" => $pastEvents, "This Week" => $thisWeekEvents, "Future Events" => $futureEvents ] as $title => $group ) { ?>
			<h2 class="text-xl font-semibold mt-6 mb-2"><?php echo $title; ?></h2>
			<table class="min-w-full border-collapse border border-gray-300">
				<thead>
					<tr class="bg-gray-100">
						<th class="border px-4 py-2">Name</th>
						<th class="border px-4 py-2">Description</th>
						<th class="border px-4 py-2">Start Date/Time</th>
						<th class="border px-4 py-2">End Date/Time</th>
						<th class="border px-4 py-2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<!-- Loop through each event in the current category and display its details -->
					<?php foreach ( $group as $event ) { ?>
						<tr class="hover:bg-gray-50">
							<td class="border px-4 py-2"><?php echo htmlspecialchars( $event->name ); ?></td>
							<td class="border px-4 py-2"><?php echo htmlspecialchars( $event->description ); ?></td>
							<td class="border px-4 py-2"><?php echo htmlspecialchars( $event->start->format( 'F j, Y, g:i a' ) ); ?></td>
							<td class="border px-4 py-2"><?php echo htmlspecialchars( $event->end->format( 'F j, Y, g:i a' ) ); ?></td>
							<td class="border px-4 py-2">
								<!-- Link to edit the event -->
								<a href="edit-event.php?id=<?php echo $event->id; ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
								<!-- Link to delete the event with a confirmation prompt -->
								<a href="delete-event.php?id=<?php echo $event->id; ?>"
								   class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
								   onclick="return confirm('Are you sure you want to delete this event?');">
									Delete
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>
	</body>

</html>