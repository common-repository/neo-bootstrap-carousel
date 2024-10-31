<?php
/**
 * NEO Bootstrap Carousel Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @category    Core
 * @package     Neo_Bootstrap_Carousel/Functions
 * @version     1.0.0
 * @author      Pixelspress <support@pixelspress.com>
 * @copyright   Copyright (c) 2018-2019, PixelsPress
 */

if ( ! function_exists( 'nbc_version_check_using_wpapi' ) ) :
	/**
	 * NEO Bootstrap Carousel Version Check
	 *
	 * @since   1.4.0
	 */
	function nbc_version_check_using_wpapi() {
		$response = wp_safe_remote_get( 'https://api.wordpress.org/plugins/info/1.0/neo-bootstrap-carousel.json' );

		// Check for error.
		if ( is_wp_error( $response ) ) {
			return;
		}

		// Parse remote HTML file.
		$data = json_decode( wp_remote_retrieve_body( $response ) );

		// Check for error.
		if ( is_wp_error( $data ) ) {
			return;
		}

		if ( ! empty( $data ) ) {
			return $data->version;
		}
	}
endif;

if ( ! function_exists( 'nbc_help_tip' ) ) :

	/**
	 * Display a NEO Bootstrap Carousel help tip.
	 *
	 * @since   1.4.0
	 *
	 * @param   string $tip Help tip text.
	 * @param   bool   $allow_html Allow sanitized HTML if true or escape.
	 * @return  string
	 */
	function nbc_help_tip( $tip, $allow_html = false ) {
		if ( $allow_html ) {
			$tip = nbc_sanitize_tooltip( $tip );
		} else {
			$tip = esc_attr( $tip );
		}

		return '<span class="help_tip" data-tip="' . $tip . '"><i class="amp-wp-admin-icon-question"></i></span>';
	}

endif;
