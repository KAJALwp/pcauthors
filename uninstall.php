<?php
/**
 * Handles plugin uninstallation.
 *
 * Triggered when the plugin is deleted via the WordPress dashboard.
 *
 * @package    Pcauthors
 * @subpackage Pcauthors
 * @since      1.0.0
 * @author     Kajal Gohel
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove plugin options.
delete_option( 'pcauthors_version' );

/**
 * Deletes a post metadata related to contributors.
 * Retrieves posts that have the '_pcauthors' metadata and deletes it.
 * This is done to ensure that any data associated with contributors is properly removed.
 */
$pcargs = array(
	'post_type' => 'post',
	'meta_key'  => '_pcauthors', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
	'fields'    => 'ids', // Only retrieve post IDs for efficiency.
);

$pcquery = new WP_Query( $pcargs );

// Check if any posts have the '_pcauthors' metadata.
if ( $pcquery->have_posts() ) {
	foreach ( $pcquery->posts as $single_post_id ) {
		// Delete the '_pcauthors' metadata for each post.
		delete_post_meta( $single_post_id, '_pcauthors' );
	}
}

// Clear cache for affected objects.
wp_cache_flush();
