<?php
/**
 * Neo_Bootstrap_Carousel_Gutenberg Class
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 */

/**
 * Neo_Bootstrap_Carousel_Gutenberg Class
 *
 * This file contains block code of 'neo_carousel' post type.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Gutenberg {

	/**
	 * Initialize the class and set it's properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'nbc_block' ) );
	}

	/**
	 * Register block 'nbc/carousel'
	 *
	 * @return void
	 */
	public function nbc_block() {

		// Scripts.
		wp_register_script(
			'nbc-block-js', // Handle.
			NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'public/js/nbc-block.js', // Block Script.
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor', 'wp-api-fetch', 'jquery' ), // Dependencies, defined above.
			NEO_BOOTSTRAP_CAROUSEL_VERSION,
			true
		);

		// Style.
		wp_register_style(
			'nbc-block-editor',
			NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'public/css/neo-bootstrap-carousel-public.css', // Editor Style.
			array( 'wp-edit-blocks' ),
			NEO_BOOTSTRAP_CAROUSEL_VERSION
		);

		register_block_type(
			'nbc/carousel',
			array(
				'editor_script'   => 'nbc-block-js',
				'editor_style'    => 'nbc-block-editor',
				'render_callback' => 'nbc_block_shortcode_handler',
				'attributes'      => array(
					'id' => array( 'type' => 'string' ),
				),
			)
		);
	}

}

/**
 * NEO Bootstrap Carousel Shortcode Handler.
 *
 * @param array $atts Contains attribute array.
 *
 * @return string
 */
function nbc_block_shortcode_handler( $atts ) {
	if ( isset( $atts['id'] ) && ! empty( $atts['id'] ) ) {
		return do_shortcode( '[neo_carousel_shortcode id="' . intval( $atts['id'] ) . '"][/neo_carousel_shortcode]' );
	} else {
		$html          = '<div class="nbc-block">';
			$html     .= '<div class="nbc-block-label">';
				$html .= '<span class="dashicons dashicons-slides"></span> ' . esc_attr( NEO_BOOTSTRAP_CAROUSEL_NAME ) . '';
			$html     .= '</div>';
		$html         .= '</div>';

		return $html;
	}
}
