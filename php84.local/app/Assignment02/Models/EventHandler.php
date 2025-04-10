<?php
/**
 * Assignment 2 instructions
 * 
 * - Modify the addEvent() method to include the author. It should be the last item in the event string, e.g.:
 * --- eventID|name|description|start|end|authorId
 * --- 67a1934088435|asda|asda|2025-01-30 20:10:00|2025-02-12 20:10:00| 47a19240b8d35
 * - Modify the editEvent() method to factor in the author. Ensure you check that the currently logged in user can edit the event before making changes to events.txt.
 * - Modify the deleteEvent() method to factor in the author. Ensure you check that the currently logged in user can delete the event before making changes to events.txt.
 */
namespace Models;
require_once 'Utils/Redirect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Utils\Redirect;
use \DateTime;
/**
 * Class EventHandler
 * Handles the creation, editing, and deletion of events.
 * 
 * @package Models
 */
class EventHandler {

	/**
	 * @var array $postData The data received from the POST request.
	 */
	private $postData;

	/**
	 * @var string $eventFile The file where events are stored.
	 */
	private $eventFile = 'events.txt';

	/**
	 * EventHandler constructor.
	 * @param array $postData The data received from the POST request.
	 */
	public function __construct( $postData ) {
		$this->postData = $postData;
	}

	/**
	 * Handles the incoming request based on the request method.
	 */
	public function handleRequest() {
		if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
			if ( isset( $this->postData[ 'id' ] ) ) {
				$this->editEvent();
			} else {
				$this->addEvent();
			}
		} elseif ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_GET[ 'id' ] ) ) {
			$this->deleteEvent();
		}
	}

	/**
	 * Adds a new event.
	 * Validates the input data and appends the event to the events file.
	 */
	private function addEvent() {
		include 'Utils/config.php';

		$name        =  trim( $this->postData[ 'name' ] );
		$description =  trim( isset( $this->postData[ 'description' ] ) ? $this->postData[ 'description' ] : '' );
		$start       =  trim( $this->postData[ 'start' ] );
		$end         =  trim( $this->postData[ 'end' ] );

		// Validate required fields
		if ( empty( $name ) || empty( $start ) || empty( $end ) ) {
			Redirect::to( 'new-event.php', [ 
				'error'       => "Required fields are missing.",
				'name'        => $name,
				'description' => $description,
				'start'       => $start,
				'end'         => $end,
			] );
		}

		// Validate dates with multiple formats
		$startDate = $this->validateDate( $start );
		$endDate   = $this->validateDate( $end );

		if ( ! $startDate || ! $endDate || $startDate >= $endDate ) {
			Redirect::to( 'new-event.php', [ 
				'error'       => "Start and end dates are invalid or end date is before start date.",
				'name'        => $name,
				'description' => $description,
				'start'       => $start,
				'end'         => $end,
			] );
		}

		// Generate unique ID and escape user input
		$id          = uniqid();
		$name        = str_replace( '|', '\|', $name );
		$description = str_replace( '|', '\|', $description );

		$authorId = $_SESSION['user_id'];

		// Append to file with a new line
		$stmt = $pdo->prepare("INSERT INTO events (id, event_name, description, start_time, end_time, author_id) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->execute([$id, $name, $description, $startDate->format( 'Y-m-d H:i:s' ), $endDate->format( 'Y-m-d H:i:s' ), $authorId]);
		$line = "$id|$name|$description|{$startDate->format( 'Y-m-d H:i:s' )}|{$endDate->format( 'Y-m-d H:i:s' )}\n";
		file_put_contents( $this->eventFile, $line, FILE_APPEND | LOCK_EX );

		// Redirect with success message
		Redirect::to( 'index.php', [ 
			'success' => "Event '$name' Successfully Created",
		] );
	}

	/**
	 * Edits an existing event.
	 * Validates the input data and updates the event in the events file.
	 */
	private function editEvent() {
		$id          = htmlspecialchars( trim( $this->postData[ 'id' ] ) );
		$name        = htmlspecialchars( trim( $this->postData[ 'name' ] ) );
		$description = htmlspecialchars( trim( isset( $this->postData[ 'description' ] ) ? $this->postData[ 'description' ] : '' ) );
		$start       = htmlspecialchars( trim( $this->postData[ 'start' ] ) );
		$end         = htmlspecialchars( trim( $this->postData[ 'end' ] ) );

		// Validate required fields and dates
		if ( empty( $id ) || empty( $name ) || empty( $start ) || empty( $end ) ) {
			Redirect::to( 'edit-event.php', [ 
				'error'       => "Required fields are missing.",
				'id'          => $id,
				'name'        => $name,
				'description' => $description,
				'start'       => $start,
				'end'         => $end,
			] );
		}

		$startDate = $this->validateDate( $start );
		$endDate   = $this->validateDate( $end );

		if ( ! $startDate || ! $endDate || $startDate >= $endDate ) {
			Redirect::to( 'edit-event.php', [ 
				'error'       => "Start and end dates are invalid or end date is before start date.",
				'id'          => $id,
				'name'        => $name,
				'description' => $description,
				'start'       => $start,
				'end'         => $end,
			] );
		}

		$name        = str_replace( '|', '\|', $name );
		$description = str_replace( '|', '\|', $description );

		// Read events from file and update the specific event
		$events        = file( $this->eventFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
		$updatedEvents = [];

		foreach ( $events as $line ) {
			list( $lineID ) = explode( '|', $line );
			if ( $lineID === $id ) {
				$line = "$id|$name|$description|{$startDate->format( 'Y-m-d H:i:s' )}|{$endDate->format( 'Y-m-d H:i:s' )}";
			}
			$updatedEvents[] = $line;
		}

		// Write updated events back to file
		file_put_contents( $this->eventFile, implode( "\n", $updatedEvents ) . "\n" );

		// Redirect with success message
		Redirect::to( 'index.php', [ 
			'success' => "Event '$name' Successfully Edited",
		] );
	}

	/**
	 * Deletes an existing event.
	 * Validates the event ID and removes the event from the events file.
	 */
	private function deleteEvent() {
		if ( ! isset( $_GET[ 'id' ] ) ) {
			Redirect::to( 'index.php', [ 
				'error' => "Event could not be deleted. Please try again.",
			] );
		}

		$eventID       = $_GET[ 'id' ];
		$events        = file( $this->eventFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
		$updatedEvents = [];
		$deletedEvent  = null;

		foreach ( $events as $line ) {
			list( $id, $name ) = explode( '|', $line, 2 );
			if ( $id === $eventID ) {
				$deletedEvent     = $name;
				$deletedEventName = explode( '|', $name, )[ 0 ];
				continue;
			}
			$updatedEvents[] = $line;
		}

		if ( ! $deletedEvent ) {
			Redirect::to( 'index.php', [ 
				'error' => "Event could not be found. Please try again.",
			] );
		}

		// Write updated events back to file
		file_put_contents( $this->eventFile, implode( "\n", $updatedEvents ) . "\n" );

		// Redirect with success message
		Redirect::to( 'index.php', [ 
			'success' => "Event '$deletedEventName' Successfully Deleted",
		] );
	}

	/**
	 * Validates a date string against multiple formats.
	 * @param string $date The date string to validate.
	 * @return DateTime|false The DateTime object if valid, false otherwise.
	 */
	private function validateDate( $date ) {
		$dateFormats = [ 'Y-m-d\TH:i', 'Y-m-d H:i:s', 'd-m-Y H:i:s', 'd/m/Y H:i:s' ];
		foreach ( $dateFormats as $format ) {
			$dateTime = DateTime::createFromFormat( $format, $date );
			if ( $dateTime ) {
				return $dateTime;
			}
		}
		return false;
	}
}