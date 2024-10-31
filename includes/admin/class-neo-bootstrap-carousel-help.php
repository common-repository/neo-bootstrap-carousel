<?php
/**
 * This is used to define NEO Bootstrap Carousel Help Page.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin
 */

/**
 * Neo_Bootstrap_Carousel_Help Class
 *
 * This is used to define NEO Bootstrap Carousel Help Page.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Help {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.4.0
	 */
	public function __construct() {

		// Hook - Add Help Menu.
		add_action( 'admin_menu', array( $this, 'nbc_admin_menu' ), 40 );
	}

	/**
	 * Add Help Page Under NEO Bootstrap Carousel Menu.
	 *
	 * @since   1.4.0
	 */
	public function nbc_admin_menu() {
		add_submenu_page(
			'neo-bootstrap-carousel-welcome',
			__( 'Help', 'neo-bootstrap-carousel' ),
			__( 'Help', 'neo-bootstrap-carousel' ),
			'manage_options',
			'neo-bootstrap-carousel-help',
			array( $this, 'nbc_help' )
		);
	}

	/**
	 * Help Admin View.
	 *
	 * @Since   1.4.0
	 */
	public function nbc_help() {
		$page = filter_input( INPUT_GET, 'page' );
		?>
		<div class="neo-bootstrap-carousel">
			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-header.php'; ?>

			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-help.php'; ?>
		</div>
		<?php
	}

}

new Neo_Bootstrap_Carousel_Help();
