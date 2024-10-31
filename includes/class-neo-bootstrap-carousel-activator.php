<?php
/**
 * Fired during plugin activation
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 */

/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Activator {

	/**
	 * Setup the default value of plugins on activation.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		do_action( 'nbc_default_configurations' );
	}
}
