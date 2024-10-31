<?php
/**
 * NEO Bootstrap Carousel Formatting Functions
 *
 * Formatting functions available on both the front-end and admin.
 *
 * @category    Formatting
 * @package     Neo_Bootstrap_Carousel/Functions
 * @version     1.4.1
 * @author      Pixelspress <support@pixelspress.com>
 * @copyright   Copyright (c) 2018-2019, PixelsPress
 */

/**
 * Sanitize a string destined to be a tooltip.
 *
 * @param string $var Data to sanitize.
 * @since 1.4.1 Tooltips are encoded with htmlspecialchars to prevent XSS. Should not be used in conjunction with esc_attr()
 *
 * @return string
 */
function nbc_sanitize_tooltip( $var ) {
	return htmlspecialchars(
		wp_kses(
			html_entity_decode( $var ),
			array(
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'small'  => array(),
				'span'   => array(),
				'ul'     => array(),
				'li'     => array(),
				'ol'     => array(),
				'p'      => array(),
			)
		)
	);
}

/**
 * Notation to numbers.
 *
 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
 *
 * @param   string $size Size value.
 *
 * @return  int
 */
function nbc_let_to_num( $size ) {
	$l    = substr( $size, -1 );
	$ret  = substr( $size, 0, -1 );
	$byte = 1024;

	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
			// No break.
		case 'T':
			$ret *= 1024;
			// No break.
		case 'G':
			$ret *= 1024;
			// No break.
		case 'M':
			$ret *= 1024;
			// No break.
		case 'K':
			$ret *= 1024;
			// No break.
	}
	return $ret;
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 *
 * @param   string|array $var Data to sanitize.
 * @return  string|array
 */
function nbc_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'nbc_clean', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}

add_filter( 'widget_text', 'do_shortcode' );
