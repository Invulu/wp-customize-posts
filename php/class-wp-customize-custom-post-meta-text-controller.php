<?php
/**
 * Customize Custom Post Meta Text Class
 *
 * @package WordPress
 * @subpackage Customize
 */

/**
 * Class WP_Customize_Custom_Post_Meta_Text_Controller
 */
class WP_Customize_Custom_Post_Meta_Text_Controller extends WP_Customize_Postmeta_Controller {

	/**
	 * Meta key.
	 *
	 * @var string
	 */
	public $meta_key = 'gpp_team_title';

	/**
	 * Post type support for the postmeta.
	 *
	 * @var string
	 */
	public $post_type_supports = 'page-attributes';

	/**
	 * Setting transport.
	 *
	 * @var string
	 */
	public $setting_transport = 'refresh';

	/**
	 * Default value.
	 *
	 * @var string
	 */
	public $default = 'default';

	/**
	 * Enqueue customize scripts.
	 */
	public function enqueue_customize_pane_scripts() {
		$handle = 'customize-custom-post-meta-text';
		wp_enqueue_script( $handle );
	}

	/**
	 * Enqueue edit post scripts.
	 */
	public function enqueue_edit_post_scripts() {
		wp_enqueue_script( 'edit-post-preview-admin-custom-post-meta-text' );
	}

	/**
	 * Test enqueue_edit_post_scripts().
	 *
	 * @see WP_Customize_Page_Template_Controller::enqueue_admin_scripts()
	 * @see WP_Customize_Page_Template_Controller::enqueue_edit_post_scripts()
	 */
	public function test_enqueue_edit_post_scripts() {
		set_current_screen( 'post' );
		$handle = 'edit-post-preview-admin-custom-post-meta-text';
		$controller = new WP_Customize_Custom_Post_Meta_Text_Controller();
		$this->assertFalse( wp_script_is( $handle, 'enqueued' ) );
		$controller->enqueue_admin_scripts();
		$this->assertTrue( wp_script_is( $handle, 'enqueued' ) );
	}

	/**
	 * Apply rudimentary sanitization of a file path for a generic setting instance.
	 *
	 * @see sanitize_meta()
	 *
	 * @param string $meta_text Text .
	 * @return string $meta_text Text.
	 */
	public function sanitize_value( $raw_meta_text ) {
		$meta_text = sanitize_text_field($raw_meta_text);
		return $meta_text;
	}

	/**
	 * Sanitize (and validate) an input for a specific setting instance.
	 *
	 * @see update_metadata()
	 *
	 * @param string                        $page_template The value to sanitize.
	 * @param WP_Customize_Postmeta_Setting $setting       Setting.
	 * @return mixed|WP_Error Sanitized value or WP_Error if invalid valid.
	 */
	public function sanitize_setting( $raw_meta_text, WP_Customize_Postmeta_Setting $setting ) {
		$meta_text = sanitize_text_field($raw_meta_text);
		return $meta_text;
	}
}
