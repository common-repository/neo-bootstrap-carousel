<?php
/**
 * This is used to define NEO Bootstrap Carousel Advanced Setting.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin/settings
 */

/**
 * Neo_Bootstrap_Carousel_Advanced Class
 *
 * This is used to define NEO Bootstrap Carousel Advanced Setting.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin/settings
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Advanced {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.0
	 */
	public function __construct() {

		// Filter -> Add Advanced Setting Tab.
		add_filter( 'nbc_settings_tab_menus', array( $this, 'nbc_add_advanced_tab' ) );

		// Action -> Display Advanced Setting.
		add_action( 'nbc_settings_tab_section', array( $this, 'nbc_add_advanced_settings' ) );

		// Action -> Save Advanced Setting.
		add_action( 'nbc_save_setting_sections', array( $this, 'nbc_save_advanced_settings' ) );
	}

	/**
	 * Add Advanced Setting Tab
	 *
	 * @param   array $tabs  Setting Tab.
	 * @since   1.4.0
	 *
	 * @return  array  $tabs  Merge array of Setting Tab with Advanced Tab.
	 */
	public function nbc_add_advanced_tab( $tabs ) {

		$tabs['advanced'] = __( '<i class="neo-bootstrap-carousel-admin-icon-settings-1"></i><span>Advanced</span>', 'neo-bootstrap-carousel' );
		return $tabs;
	}

	/**
	 * Display Advanced Setting
	 *
	 * This function is used to display settings advanced section & also display
	 * the stored settings.
	 *
	 * @since       1.4.0
	 */
	public function nbc_add_advanced_settings() {

		// Get Advanced Setting.
		$show_content_on_mobile = '';

		if ( get_option( 'nbc_advanced_settings' ) ) {
			$nbc_advanced_settings = get_option( 'nbc_advanced_settings' );

			$show_content_on_mobile = ( isset( $nbc_advanced_settings['show_content_on_mobile'] ) && ! empty( $nbc_advanced_settings['show_content_on_mobile'] ) ) ? $nbc_advanced_settings['show_content_on_mobile'] : '';
		}

		// Load View.
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/settings/neo-bootstrap-carousel-advanced.php';
	}

	/**
	 * Save Advanced Setting
	 *
	 * @since   1.4.0
	 */
	public function nbc_save_advanced_settings() {

		$nbc_advanced_settings = filter_input_array( INPUT_POST );

		if ( $nbc_advanced_settings ) :

			foreach ( $nbc_advanced_settings as $key => $value ) {

				if ( strstr( $key, 'advanced_settings' ) ) {

					if ( isset( $value['show_content_on_mobile'] ) ) {
						$value['show_content_on_mobile'] = 1;
					}

					update_option( sanitize_key( $key ), $value );
				}
			}
		endif;
	}
}

new Neo_Bootstrap_Carousel_Advanced();
