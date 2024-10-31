<?php
/**
 * This is used to define NEO Bootstrap Carousel General Setting.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin/settings
 */

/**
 * Neo_Bootstrap_Carousel_General Class
 *
 * This is used to define NEO Bootstrap Carousel General Setting.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin/settings
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_General {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.0
	 */
	public function __construct() {

		// Filter -> Add General Setting Tab.
		add_filter( 'nbc_settings_tab_menus', array( $this, 'nbc_add_general_tab' ) );

		// Action -> Display General Setting.
		add_action( 'nbc_settings_tab_section', array( $this, 'nbc_add_general_settings' ) );

		// Action -> Save General Setting.
		add_action( 'nbc_save_setting_sections', array( $this, 'nbc_save_general_settings' ) );
	}

	/**
	 * Add General Setting Tab
	 *
	 * @param   array $tabs  Setting Tab.
	 * @since   1.4.0
	 *
	 * @return  array  $tabs  Merge array of Setting Tab with General Tab.
	 */
	public function nbc_add_general_tab( $tabs ) {

		$tabs['general'] = __( '<i class="neo-bootstrap-carousel-admin-icon-settings-1"></i><span>General</span>', 'neo-bootstrap-carousel' );
		return $tabs;
	}

	/**
	 * Display General Setting
	 *
	 * This function is used to display settings general section & also display
	 * the stored settings.
	 *
	 * @since       1.0.4
	 */
	public function nbc_add_general_settings() {

		// Get General Setting.
		$show_caption  = '';
		$show_arrows   = '';
		$show_controls = '';

		if ( get_option( 'nbc_general_settings' ) ) {
			$nbc_general_settings = get_option( 'nbc_general_settings' );

			$show_caption  = ( isset( $nbc_general_settings['show_caption'] ) && ! empty( $nbc_general_settings['show_caption'] ) ) ? $nbc_general_settings['show_caption'] : '';
			$show_arrows   = ( isset( $nbc_general_settings['show_arrows'] ) && ! empty( $nbc_general_settings['show_arrows'] ) ) ? $nbc_general_settings['show_arrows'] : '';
			$show_controls = ( isset( $nbc_general_settings['show_controls'] ) && ! empty( $nbc_general_settings['show_controls'] ) ) ? $nbc_general_settings['show_controls'] : '';
		}

		// Load View.
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/settings/neo-bootstrap-carousel-general.php';
	}

	/**
	 * Save General Setting
	 *
	 * @since   1.4.0
	 */
	public function nbc_save_general_settings() {

		$nbc_general_settings = filter_input_array( INPUT_POST );

		if ( $nbc_general_settings ) :
			foreach ( $nbc_general_settings as $key => $value ) {
				if ( strstr( $key, 'general_settings' ) ) {

					if ( isset( $value['show_caption'] ) ) {
						$value['show_caption'] = 1;
					}

					if ( isset( $value['show_arrows'] ) ) {
						$value['show_arrows'] = 1;
					}

					if ( isset( $value['show_controls'] ) ) {
						$value['show_controls'] = 1;
					}

					update_option( sanitize_key( $key ), $value );
				}
			}
		endif;
	}
}

new Neo_Bootstrap_Carousel_General();
