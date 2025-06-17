<?php
/**
 * Handles plugin deactivation tasks for Post CoAuthors plugin.
 *
 * This class contains the logic to clean up options or perform any necessary
 * tasks when the plugin is deactivated.
 *
 * @package    Pcauthors
 * @subpackage Pcauthors/includes/classes/admin
 * @since      1.0.0
 * @author     Kajal Gohel
 */

/**
 * Deactivator class file.
 */
class Pcauthors_Deactivator {

	/**
	 * Code to execute on plugin deactivation.
	 *
	 * This method is called when the plugin is deactivated. It cleans up any
	 * options or data that were stored during the plugin's operation.
	 *
	 * @return void
	 */
	public static function deactivate() {
		// Optional: Cleanup tasks, such as removing options or transient data.
		delete_option( 'pcauthors_version' );
	}
}
