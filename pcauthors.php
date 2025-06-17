<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/kajalgohel/
 * @since             1.0.0
 * @package           Pcauthors
 *
 * @wordpress-plugin
 * Plugin Name:       Post CoAuthors
 * Description:       Assign multiple contributors to posts and display them on the front-end.
 * Version:           1.0
 * Author:            Kajal Gohel
 * Author URI:        https://profiles.wordpress.org/kajalgohel/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pcauthors
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants.
define( 'PCAUTHORS_VERSION', '1.0.0' );
define( 'PCAUTHORS_PATH', plugin_dir_path( __FILE__ ) );
define( 'PCAUTHORS_URL', plugin_dir_url( __FILE__ ) );
define( 'PCAUTHORS_BUILD_LIBRARY_URI', untrailingslashit( PCAUTHORS_URL . 'assets' ) );

// Autoload required classes.
require_once PCAUTHORS_PATH . 'includes/classes/admin/class-pcauthors-activator.php';
require_once PCAUTHORS_PATH . 'includes/classes/admin/class-pcauthors-deactivator.php';
require_once PCAUTHORS_PATH . 'includes/classes/admin/class-pcauthors-admin.php';
require_once PCAUTHORS_PATH . 'includes/classes/frontend/class-pcauthors-frontend.php';

// Activation hook.
register_activation_hook( __FILE__, array( 'Pcauthors_Activator', 'activate' ) );

// Deactivation hook.
register_deactivation_hook( __FILE__, array( 'Pcauthors_Deactivator', 'deactivate' ) );

/**
 * Begins execution of the plugin.
 *
 * @return void
 * @since    1.0.0
 */
function pcauthors_run() {
	$admin    = new Pcauthors_Admin();
	$frontend = new Pcauthors_Frontend();

	$admin->run();
	$frontend->run();
}
pcauthors_run();
