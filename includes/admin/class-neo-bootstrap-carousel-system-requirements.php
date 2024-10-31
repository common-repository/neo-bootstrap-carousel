<?php
/**
 * This is used to define NEO Bootstrap Carousel System Requirements Page.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin
 */

/**
 * Neo_Bootstrap_Carousel_System_Requirements Class
 *
 * This is used to define NEO Bootstrap Carousel System Requirements Page.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_System_Requirements {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.4.0
	 */
	public function __construct() {

		// Hook - Add System Requirements Menu.
		add_action( 'admin_menu', array( $this, 'nbc_admin_menu' ), 50 );
	}

	/**
	 * Add System Requirements Menu Under NEO Bootstrap Carousel Admin Menu.
	 *
	 * @since   1.4.0
	 */
	public function nbc_admin_menu() {
		add_submenu_page(
			'neo-bootstrap-carousel-welcome',
			'System Requirements',
			'System Requirements',
			'manage_options',
			'neo-bootstrap-carousel-system-requirements',
			array( $this, 'nbc_system_requirements' )
		);
	}

	/**
	 * System Requirements Admin View.
	 *
	 * @Since   1.4.0
	 */
	public function nbc_system_requirements() {
		$page = filter_input( INPUT_GET, 'page' );

		$dir                      = wp_upload_dir();
		$mem_limit                = ini_get( 'memory_limit' );
		$mem_limit_byte           = wp_convert_hr_to_bytes( $mem_limit );
		$upload_max_filesize      = ini_get( 'upload_max_filesize' );
		$upload_max_filesize_byte = wp_convert_hr_to_bytes( $upload_max_filesize );
		$post_max_size            = ini_get( 'post_max_size' );
		$post_max_size_byte       = wp_convert_hr_to_bytes( $post_max_size );

		$writeable_boolean                = wp_is_writable( $dir['basedir'] . '/' );
		$can_connect                      = get_option( 'nbc-connection', false );
		$mem_limit_byte_boolean           = $mem_limit_byte < 268435456;
		$upload_max_filesize_byte_boolean = ( $upload_max_filesize_byte < 33554432 );
		$post_max_size_byte_boolean       = ( $post_max_size_byte < 33554432 );
		$dash_rr_status                   = ( true === $writeable_boolean && true === $can_connect && false === $mem_limit_byte_boolean && false === $upload_max_filesize_byte_boolean && false === $post_max_size_byte_boolean ) ? 'rs-status-green-wrap' : 'rs-status-red-wrap';
		$img_editor_test                  = ( wp_image_editor_supports( array( 'methods' => array( 'resize', 'save' ) ) ) ) ? true : false;
		?>
		<div class="neo-bootstrap-carousel">
			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-header.php'; ?>

			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-system-requirements.php'; ?>
		</div>
		<?php
	}

}

new Neo_Bootstrap_Carousel_System_Requirements();
