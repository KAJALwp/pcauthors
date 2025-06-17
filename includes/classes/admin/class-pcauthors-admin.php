<?php
/**
 * Admin class for Post Coauthors plugin.
 *
 * This file contains the admin functionality for managing contributors in the
 * WordPress admin interface. It adds a metabox to the post editor for selecting
 * contributors and saves the selected contributors as post metadata.
 *
 * @package    Pcauthors
 * @subpackage Pcauthors/includes/classes/admin
 * @since      1.0.0
 * @author     Kajal Gohel
 */

/**
 * Class Pcauthors_Admin
 *
 * Handles the admin functionality for the Post Coauthors plugin.
 *
 * @package    Pcauthors
 * @subpackage Pcauthors/includes/classes/admin
 * @since      1.0.0
 */
class Pcauthors_Admin {

	/**
	 * Initialize the admin hooks.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function run() {
		add_action( 'add_meta_boxes', array( $this, 'pcauthors_add_metabox' ) );
		add_action( 'save_post', array( $this, 'pcauthors_save_metabox' ) );
	}

	/**
	 * Add a Contributors metabox to the post editor.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function pcauthors_add_metabox() {
		add_meta_box(
			'pcauthors_metabox',
			__( 'Contributors', 'pcauthors' ),
			array( $this, 'pcauthors_render_metabox' ),
			'post',
			'side',
			'default'
		);
	}

	/**
	 * Render the Contributors metabox.
	 *
	 * @param WP_Post $post The current post object.
	 * @return void
	 * @since 1.0.0
	 */
	public function pcauthors_render_metabox( $post ) {
		// Get all users.
		$users = get_users();

		// Retrieve saved contributors.
		$saved_contributors = get_post_meta( $post->ID, '_pcauthors', true );
		$saved_contributors = is_array( $saved_contributors ) ? $saved_contributors : array();

		// Output a nonce field for security.
		wp_nonce_field( 'pcauthors_save_metabox', 'pcauthors_nonce' );

		// Check if the current user has the required role to edit contributors.
		$current_user_can_edit = current_user_can( 'edit_others_posts' );
		?>
		<div class="pcauthors-metabox">
			<?php if ( ! $current_user_can_edit ) : ?>
				<p><?php esc_html_e( 'You do not have permission to edit contributors.', 'pcauthors' ); ?></p>
			<?php endif; ?>
			<ul class="pcauthors-list">
				<?php foreach ( $users as $user ) : ?>
					<?php
					$checked = in_array( $user->ID, $saved_contributors, true ) ? 'checked' : '';
					?>
					<li>
						<label>
							<input
								type="checkbox"
								name="PcAuthors[]"
								value="<?php echo esc_attr( $user->ID ); ?>"
								<?php echo esc_attr( $checked ); ?>
								<?php echo $current_user_can_edit ? '' : 'disabled'; ?>
							>
							<?php echo esc_html( $user->display_name ); ?>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}

	/**
	 * Save the contributors when the post is saved.
	 *
	 * @param int $post_id The ID of the current post.
	 * @return void
	 * @since 1.0.0
	 */
	public function pcauthors_save_metabox( $post_id ) {
		// Verify the nonce for security.
		if ( ! isset( $_POST['pcauthors_nonce'] ) ) {
			return;
		}

		$nonce = sanitize_text_field( wp_unslash( $_POST['pcauthors_nonce'] ) );
		if ( ! wp_verify_nonce( $nonce, 'pcauthors_save_metabox' ) ) {
			return;
		}

		// Prevent saving during autosave.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check if the user has permission to edit the post.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Verify that the current user can manage contributors (Admin, Editor, Author).
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			return;
		}

		// Sanitize and save the contributors.
		$contributors = isset( $_POST['PcAuthors'] ) ? array_map( 'intval', $_POST['PcAuthors'] ) : array();
		update_post_meta( $post_id, '_pcauthors', $contributors );
	}
}


