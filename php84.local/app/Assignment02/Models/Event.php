<?php
/**
 * Assignment 2 Instructions:
 * 
 * - Add an additional property to the Event class called $authorID.
 * - Add a constructor parameter for the new property.
 * - Adjust the class' methods to account for the new property.
 */

namespace Models;
use \DateTime;
/**
 * Event class represents an event with an ID, name, description, start time, and end time.
 * 
 * @package Models
 */
class Event {

	/**
	 * @var string $id The unique identifier for the event.
	 */
	public $id;

	/**
	 * @var string $name The name of the event.
	 */
	public $name;

	/**
	 * @var string $description A brief description of the event.
	 */
	public $description;

	/**
	 * @var DateTime $start The start time of the event.
	 */
	public $start;

	/**
	 * @var DateTime $end The end time of the event.
	 */
	public $end;

	// Constructor to initialize the Event object
	/**
	 * Event constructor.
	 * Initializes the Event object with the provided values.
	 *
	 * @param string $id The unique identifier for the event.
	 * @param string $name The name of the event.
	 * @param string $description A brief description of the event.
	 * @param string $start The start time of the event in a valid date-time format.
	 * @param string $end The end time of the event in a valid date-time format.
	 */
	public function __construct( $id, $name, $description, $start, $end ) {
		// Assign values to the properties
		$this->id          = $id;
		$this->name        = $name;
		$this->description = $description;
		// Convert start and end times to DateTime objects
		$this->start = new DateTime( $start );
		$this->end   = new DateTime( $end );
	}

	// Static method to create an Event object from a string
	/**
	 * Creates an Event object from a string.
	 *
	 * @param string $line The string containing event data separated by '|'.
	 * @return Event The created Event object.
	 */
	public static function fromString( $line ) {
		// Split the input string by '|' and assign to variables
		list( $id, $name, $description, $start, $end ) = explode( '|', $line );
		// Return a new Event object
		return new self( $id, $name, $description, $start, $end );
	}

	// Method to convert the Event object to a string
	/**
	 * Converts the Event object to a string.
	 *
	 * @return string The string representation of the Event object.
	 */
	public function toString() {
		// Join the properties into a string separated by '|'
		return implode( '|', [ 
			$this->id,
			// Escape '|' characters in name and description
			str_replace( '|', '\|', $this->name ),
			str_replace( '|', '\|', $this->description ),
			// Format start and end times as 'Y-m-d H:i:s'
			$this->start->format( 'Y-m-d H:i:s' ),
			$this->end->format( 'Y-m-d H:i:s' ),
		] );
	}
}