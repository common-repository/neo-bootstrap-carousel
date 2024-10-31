<?php
/**
 * This is used to define NEO Bootstrap Carousel Setting Page.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin
 */

/**
 * Neo_Bootstrap_Carousel_Settings Class
 *
 * This is used to define NEO Bootstrap Carousel Setting Page.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Settings {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {

		// Hook - Add Settings Menu.
		add_action( 'admin_menu', array( $this, 'nbc_admin_menu' ), 30 );

		/**
		 * Classes responsible for Following Below Settings
		 *
		 * - General
		 * - Design
		 * - Advanced
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/settings/class-neo-bootstrap-carousel-general.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/settings/class-neo-bootstrap-carousel-design.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/settings/class-neo-bootstrap-carousel-advanced.php';

		// Hook - Save Settings.
		add_action( 'admin_notices', array( $this, 'nbc_save_settings' ) );
	}

	/**
	 * Add Setting Page Under NEO Bootstrap Carousel Menu.
	 *
	 * @since   1.4.0
	 */
	public function nbc_admin_menu() {
		add_submenu_page(
			'neo-bootstrap-carousel-welcome',
			__( 'Settings', 'neo-bootstrap-carousel' ),
			__( 'Settings', 'neo-bootstrap-carousel' ),
			'manage_options',
			'neo-bootstrap-carousel-settings',
			array( $this, 'nbc_settings' )
		);
	}

	/**
	 * Settings Admin View.
	 *
	 * @Since   1.4.0
	 */
	public function nbc_settings() {
		$page = filter_input( INPUT_GET, 'page' );
		?>
		<div class="neo-bootstrap-carousel">
			<?php require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/neo-bootstrap-carousel-header.php'; ?>

			<div class="neo-bootstrap-carousel-vtabs">
				<div class="neo-bootstrap-carousel-vtabs-sidebar">
					<div class="neo-bootstrap-carousel-vtabs-menu">
						<?php
						/**
						 * Filter the Settings Tab Menus.
						 *
						 * @since 1.4.0
						 *
						 * @param array (){
						 *     @type array Tab Id => Settings Tab Name
						 * }
						 */
						$settings_tabs = apply_filters( 'nbc_settings_tab_menus', array() );

						$count = 1;
						if ( $settings_tabs ) {
							foreach ( $settings_tabs as $key => $tab_name ) {
								$active_tab = ( 1 === $count ) ? 'active' : '';
								echo '<a href="#settings-' . sanitize_key( $key ) . '" class="' . sanitize_html_class( $active_tab ) . ' ">' . wp_kses_post( $tab_name ) . '</a>';
								$count++;
							}
						}
						?>
					</div>
				</div>
				<div class="neo-bootstrap-carousel-vtabs-content-wrap">
					<?php
					/**
					 * Hook -> Display Settings Sections.
					 *
					 * @since 1.4.0
					 */
					do_action( 'nbc_settings_tab_section' );
					?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Save Settings.
	 *
	 * @since   1.4.0
	 */
	public function nbc_save_settings() {

		/**
		 * Hook -> Save Setting Sections.
		 *
		 * @since   1.4.0
		 */
		do_action( 'nbc_save_setting_sections' );

		// Admin Notices.
		if ( isset( $_POST['nbc_admin_notices'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			?>
			<div class="wrap">
				<div class="notice nbc-notice updated is-dismissible">
					<p><?php esc_html_e( 'Settings saved.', 'neo-bootstrap-carousel' ); ?></p>
				</div>
			</div>
			<?php
		}
	}
}

new Neo_Bootstrap_Carousel_Settings();
