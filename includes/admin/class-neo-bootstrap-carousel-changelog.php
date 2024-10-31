<?php
/**
 * This is used to define NEO Bootstrap Carousel Changelog Page.
 *
 * @link       https://pixelspress.com
 * @since      1.4.1
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin
 */

/**
 * Neo_Bootstrap_Carousel_Changelog Class
 *
 * This is used to define NEO Bootstrap Carousel Changelog Page.
 *
 * @link        https://pixelspress.com
 * @since       1.4.1
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Changelog {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.1
	 */
	public function __construct() {

		// Hook - Add Changelog Menu.
		add_action( 'admin_menu', array( $this, 'nbc_admin_menu' ), 60 );
	}

	/**
	 * Add Changelog Page Menu Under NEO Bootstrap Carousel Admin Menu.
	 *
	 * @since   1.4.1
	 */
	public function nbc_admin_menu() {
		add_submenu_page(
			'neo-bootstrap-carousel-welcome',
			__( 'Changelog', 'neo-bootstrap-carousel' ),
			__( 'Changelog', 'neo-bootstrap-carousel' ),
			'manage_options',
			'neo-bootstrap-carousel-changelog',
			array( $this, 'nbc_changelog' )
		);
	}

	/**
	 * Changelog Admin View.
	 *
	 * @Since   1.4.1
	 */
	public function nbc_changelog() {

		$page      = filter_input( INPUT_GET, 'page' );
		$changelog = array(
			'1.4.3 – 2020-04-30' => array(
				__( 'Note: Overall code improvements using WordPress Coding Standards.', 'neo-bootstrap-carousel' ),
			),

			'1.4.2 – 2019-11-04' => array(
				__( 'Feature: Added Gutenberg Block', 'neo-bootstrap-carousel' ),
				__( 'Note: Improved code.', 'neo-bootstrap-carousel' ),
			),
			'1.4.1 – 2019-03-15' => array(
				__( 'Note: Used CDATA inside JavaScript Tag', 'neo-bootstrap-carousel' ),
				__( 'Fix: Resolve caption keep showing on slider even when it is disabled from settings panel', 'neo-bootstrap-carousel' ),
			),
			'1.4.0 – 2019-03-13' => array(
				__( 'Tweak: Improved Admin UI/UX', 'neo-bootstrap-carousel' ),
				__( 'Note: PHP 7.2 compatible', 'neo-bootstrap-carousel' ),
				__( 'Fix – Hide empty elements of carousel If no slider is define', 'neo-bootstrap-carousel' ),
			),
			'1.3.2 – 2018-06-19' => array(
				__( 'Fix – When hide display navigation, It hide direction arrows too which is fixed now', 'neo-bootstrap-carousel' ),
				__( 'Fix – Slide URL label was wrong, when adding a new slide. It is fixed now.', 'neo-bootstrap-carousel' ),
			),
			'1.3.1 – 2017-11-08' => array(
				__( 'Fix – Resolved plugin carousel height conflict with Bootstrap based themes.', 'neo-bootstrap-carousel' ),
			),
			'1.3 – 2017-11-08'   => array(
				__( 'Feature – You can add 3 recent posts', 'neo-bootstrap-carousel' ),
				__( 'Feature – Added a link field in media slides to link slides to internal/external pages/posts.', 'neo-bootstrap-carousel' ),
				__( 'Note – Structure Improvement.', 'neo-bootstrap-carousel' ),
				__( 'Note – CSS Improvement for better loading speed.', 'neo-bootstrap-carousel' ),
				__( 'Note – At activation hook, defined the default settings of the plugin', 'neo-bootstrap-carousel' ),
				__( 'Note – Removed pause slide', 'neo-bootstrap-carousel' ),
			),
			'1.2.1 – 2016-12-30' => array(
				__( 'Note – Security implemented.', 'neo-bootstrap-carousel' ),
				__( 'Fix – Resolved Delete Slide bug', 'neo-bootstrap-carousel' ),
			),
			'1.2.0 – 2016-10-30' => array(
				__( 'Feature - Added Slide Overlay with Opacity Control Attribute', 'neo-bootstrap-carousel' ),
				__( 'Tweak - Complete structure revised.', 'neo-bootstrap-carousel' ),
				__( 'Fix - Resolved the unsaved title & description content bug.', 'neo-bootstrap-carousel' ),
			),
			'1.1.2'              => array(
				__( 'Fix - Undefined variable version and plugin name in class class-neo-bootstrap-carousel-shortcode.php', 'neo-bootstrap-carousel' ),
			),
			'1.1.1 – 2016-08-27' => array(
				__( 'Feature - Added More Animations to Caption & Description', 'neo-bootstrap-carousel' ),
			),
			'1.1.0 – 2016-08-08' => array(
				__( 'Feature - Added Animations to Caption & Description', 'neo-bootstrap-carousel' ),
				__( 'Tweak - Changed Slider Content Area Layout at Admin Panel', 'neo-bootstrap-carousel' ),
			),
			'1.0.0 – 2016-07-30' => array(
				__( 'Initial version', 'neo-bootstrap-carousel' ),
			),
		);
		?>
		<div class="neo-bootstrap-carousel">
			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-header.php'; ?>

			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-changelog.php'; ?>
		</div>
		<?php
	}

}

new Neo_Bootstrap_Carousel_Changelog();
