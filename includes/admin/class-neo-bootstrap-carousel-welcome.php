<?php
/**
 * This is used to define NEO Bootstrap Carousel Welcome Page.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin
 */

/**
 * Neo_Bootstrap_Carousel_Welcome Class
 *
 * This is used to define NEO Bootstrap Carousel Welcome Page.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Welcome {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.0
	 */
	public function __construct() {

		// Hook - Add Welcome Menu.
		add_action( 'admin_menu', array( $this, 'nbc_admin_menu' ), 10 );
	}

	/**
	 * Add Welcome Page Under NEO Bootstrap Carousel Admin Menu.
	 *
	 * @since   1.4.0
	 */
	public function nbc_admin_menu() {
		add_menu_page(
			'NEO Bootstrap Carousel',
			'NEO Bootstrap Carousel',
			'manage_options',
			'neo-bootstrap-carousel-welcome',
			array( $this, 'nbc_welcome' ),
			'dashicons-slides',
			3
		);
		add_submenu_page(
			'neo-bootstrap-carousel-welcome',
			__( 'Welcome', 'neo-bootstrap-carousel' ),
			__( 'Welcome', 'neo-bootstrap-carousel' ),
			'manage_options',
			'neo-bootstrap-carousel-welcome',
			'',
			0
		);
	}

	/**
	 * Welcome Admin View.
	 *
	 * @Since   1.4.0
	 */
	public function nbc_welcome() {
		$page = filter_input( INPUT_GET, 'page' );

		$getting_started = array(
			array(
				'box-title'       => __( 'Add New Slider', 'neo-bootstrap-carousel' ),
				'box-image'       => NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'admin/images/hand-gesture.png',
				'box-description' => __( 'To add a new slider on your site, please click below to go to New Slider panel.', 'neo-bootstrap-carousel' ),
				'box-cta-url'     => add_query_arg( array( 'post_type' => 'neo_carousel' ), 'edit.php' ),
				'box-cta-title'   => __( 'New Slider', 'neo-bootstrap-carousel' ),
			),
			array(
				'box-title'       => __( 'Configure General Settings', 'neo-bootstrap-carousel' ),
				'box-image'       => NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'admin/images/settings.png',
				'box-description' => __( 'To configure general settings of the plugin, please click below to go to General settings panel.', 'neo-bootstrap-carousel' ),
				'box-cta-url'     => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
				'box-cta-title'   => __( 'General Settings', 'neo-bootstrap-carousel' ),
			),
			array(
				'box-title'       => __( 'Configure Design Settings', 'neo-bootstrap-carousel' ),
				'box-image'       => NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'admin/images/design-settings.png',
				'box-description' => __( 'To configure design settings of the plugin, please click below to go to Design settings panel.', 'neo-bootstrap-carousel' ),
				'box-cta-url'     => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings#settings-design' ), 'admin.php' ),
				'box-cta-title'   => __( 'Design Settings', 'neo-bootstrap-carousel' ),
			),
		);

		$credit_leader = array(
			'0' => array(
				'name'  => __( 'Mohsin Rafique', 'neovantage-core' ),
				'role'  => 'Backend Engineer',
				'email' => 'mohsin.rafique@gmail.com',
				'url'   => 'https://profiles.wordpress.org/mohsinrafique',
			),
		);
		?>
		<div class="neo-bootstrap-carousel">
			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-header.php'; ?>

			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-welcome.php'; ?>

			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-rating-box.php'; ?>
		</div>
		<?php
	}

}

new Neo_Bootstrap_Carousel_Welcome();
