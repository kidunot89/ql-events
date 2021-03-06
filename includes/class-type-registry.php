<?php
/**
 * Registers TEC types to the schema.
 *
 * @package \WPGraphQL\Extensions\QL_Events
 * @since   0.0.1
 */

namespace WPGraphQL\Extensions\QL_Events;

/**
 * Class Type_Registry
 */
class Type_Registry {
	/**
	 * Registers actions related to type registry.
	 */
	public static function add_actions() {
		// Register types.
		add_action( 'graphql_register_types', array( __CLASS__, 'graphql_register_types' ), 10 );
	}

	/**
	 * Registers TEC types, connection, and mutations to GraphQL schema
	 */
	public static function graphql_register_types() {
		// TEC Object fields.
		\WPGraphQL\Extensions\QL_Events\Type\WPObject\Event_Type::register_fields();
		\WPGraphQL\Extensions\QL_Events\Type\WPObject\Organizer_Type::register_fields();
		\WPGraphQL\Extensions\QL_Events\Type\WPObject\Venue_Type::register_fields();

		// TEC Connections.
		\WPGraphQL\Extensions\QL_Events\Connection\Organizers::register_connections();

		// Register type fields if Event Tickets in installed and loaded.
		if ( \QL_Events::is_ticket_events_loaded() ) {
			\WPGraphQL\Extensions\QL_Events\Type\WPObject\PayPalAttendee_Type::register_fields();
			\WPGraphQL\Extensions\QL_Events\Type\WPObject\PayPalOrder_Type::register_fields();
			\WPGraphQL\Extensions\QL_Events\Type\WPObject\PayPalTicket_Type::register_fields();
			\WPGraphQL\Extensions\QL_Events\Type\WPObject\RSVPAttendee_Type::register_fields();
			\WPGraphQL\Extensions\QL_Events\Type\WPObject\RSVPTicket_Type::register_fields();

			// Event Tickets Connections.
			\WPGraphQL\Extensions\QL_Events\Connection\Tickets::register_connections();
		}

		// Register type fields if Event Tickets Plus in installed and loaded.
		if ( \QL_Events::is_ticket_events_plus_loaded() ) {
			\WPGraphQL\Extensions\QL_Events\Type\WPObject\WooAttendee_Type::register_fields();
		}
	}
}
