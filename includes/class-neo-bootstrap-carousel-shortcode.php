<?php
/**
 * Neo_Bootstrap_Carousel_Shortcode class
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 */

/**
 * Neo_Bootstrap_Carousel_Shortcode Class
 *
 * This file contains shortcode of 'neo_carousel' post type.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Shortcode {

	/**
	 * Initialize the class and set it's properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		// Hook-> 'neo_carousel_shortcode' Shortcode.
		add_shortcode( 'neo_carousel_shortcode', array( $this, 'nbc_shortcode' ) );

		// Hook-> 'edit_form_after_title' Shortcode.
		add_action( 'add_meta_boxes', array( $this, 'nbc_helper_meta_box' ) );

		add_filter( 'the_content', array( $this, 'nbc_empty_paragraph_fix' ) );
	}

	/**
	 * NEO Bootstrap Carousel Shortcode - nbc_shortcode function.
	 *
	 * @param mixed  $atts the shortcode attributes.
	 * @param string $content the shortcode content (if any).
	 *
	 * @return 'nbc_shortcode_filter' filter
	 */
	public function nbc_shortcode( $atts = array(), $content = null ) {

		// Normalize attribute keys, lowercase.
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		// Override default attributes with user defined attributes.
		$shortcode_args = shortcode_atts(
			array(
				'id'          => '',
				'exclude_ids' => '',
				'interval'    => 5000,
				'pause'       => 'null',
				'wrap'        => 'true',
			),
			$atts
		);

		$shortcode_args['boolAttr'] = filter_var( $shortcode_args['wrap'], FILTER_VALIDATE_BOOLEAN );

		$nbc_general_settings = get_option( 'nbc_general_settings' );

		// Check if caption is enabled.
		$show_caption = ( isset( $nbc_general_settings['show_caption'] ) && ! empty( $nbc_general_settings['show_caption'] ) ) ? $nbc_general_settings['show_caption'] : '';

		// Check if navigation arrows are enabled.
		$show_arrows = ( isset( $nbc_general_settings['show_arrows'] ) && ! empty( $nbc_general_settings['show_arrows'] ) ) ? $nbc_general_settings['show_arrows'] : '';

		// Check if controls are enabled.
		$show_controls = ( isset( $nbc_general_settings['show_controls'] ) && ! empty( $nbc_general_settings['show_controls'] ) ) ? $nbc_general_settings['show_controls'] : '';

		$nbc_design_settings = get_option( 'nbc_design_settings' );

		// Check If animation style is set.
		$animation_style = ( isset( $nbc_design_settings['animation_style'] ) && ! empty( $nbc_design_settings['animation_style'] ) ) ? $nbc_design_settings['animation_style'] : '';

		$nbc_advanced_settings = get_option( 'nbc_advanced_settings' );

		// Check If content is hidden on mobile.
		$show_content_on_mobile = ( isset( $nbc_advanced_settings['show_content_on_mobile'] ) && ! empty( $nbc_advanced_settings['show_content_on_mobile'] ) ) ? $nbc_advanced_settings['show_content_on_mobile'] : '';

		/**
		 * Parameters
		 *
		 * - Slide Source
		 * - Slides
		 * - Slide Data Array
		 */
		$nbc_slide_source = get_post_meta( intval( $shortcode_args['id'] ), sanitize_key( '_neo_bootstrap_carousel_slide_source' ), true );
		$nbc_slider       = array_filter( explode( ',', get_post_meta( intval( $shortcode_args['id'] ), sanitize_key( '_neo_bootstrap_carousel' ), true ) ) );
		$slide_data       = array();
		$first_active     = 'active';

		if ( $nbc_slider ) :
			foreach ( $nbc_slider as $slides ) {
				$nbc_slides = array_filter( explode( '|', $slides ) );
				$slide_id   = $nbc_slides[0];
				$slide_meta = get_post( (int) $slide_id ); // Get post by ID.

				if ( 'media' === $nbc_slide_source ) :
					$slide_image_url = wp_get_attachment_url( (int) $slide_id, 'full' );
					$slide_url       = ( ! empty( $nbc_slides[3] ) ) ? $nbc_slides[3] : '';
				else :
					$src             = wp_get_attachment_image_src( get_post_thumbnail_id( $slide_id ), 'full', false, '' );
					$slide_image_url = $src[0];
					$slide_url       = get_permalink( (int) $slide_id );
				endif;

				$slide_data[] = array(
					'slide_image_url'       => $slide_image_url,
					'slide_url'             => $slide_url,
					'slide_title'           => $slide_meta->post_title,
					'slide_excerpt'         => $slide_meta->post_excerpt,
					'slide_overlay'         => ( ! empty( $nbc_slides[1] ) ) ? $nbc_slides[1] : '',
					'slide_overlay_opacity' => ( ! empty( $nbc_slides[2] ) ) ? $nbc_slides[2] : '',
				);
			}
			ob_start();
			require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'public/partials/neo-bootstrap-carousel-public-display.php';
			$html = ob_get_clean();

			/**
			 * Filter -> Modify the NEO Bootstrap Carousel Shortcode
			 *
			 * @since   1.4.0
			 *
			 * @param   HTML    $html    NEO Bootstrap Carousel HTML Structure.
			 */
			return apply_filters( 'nbc_shortcode_filter', $html . do_shortcode( $content ), $atts );
		endif;
	}

	/**
	 * Init NEO Bootstrap Carousel Helper Meta Box
	 *
	 * @since   1.4.0
	 *
	 * @global  object  $post   Post Object
	 * @return  void
	 */
	public function nbc_helper_meta_box() {

		add_meta_box(
			'nbc-help',
			esc_html__( 'How to Use', 'neo-bootstrap-carousel' ),
			array( $this, 'nbc_helper_meta_box_output' ),
			array(
				'neo_carousel',
			),
			'side',
			'low'
		);
	}

	/**
	 * Add NEO Bootstrap Carousel data meta box options.
	 *
	 * @since   1.4.0
	 */
	public static function nbc_helper_meta_box_output() {
		global $post;

		echo '<p>' . esc_html__( 'To display your slider, add the following shortcode (in violet) to your page. If adding the slider to your theme files, additionally include the surrounding PHP function (in gray). ', 'neo-bootstrap-carousel' ) . '</p>';

		// Shortcode.
		echo '<pre class="nbc-entire" id="nbc-entire-code">&lt;?php echo do_shortcode(\'<br>&emsp;&emsp;<div class="nbc-shortcode">[neo_carousel_shortcode <span id="nbc-shortcode-id">id="' . intval( $post->ID ) . '"</span><span style="display:none" id="nbc-shortcode-title">title="' . esc_attr( get_the_title( intval( $post->ID ) ) ) . '"</span>]</div><br>\'); ?&gt;</pre>';
	}

	/**
	 * Filters the content to remove any extra paragraph or break tags
	 * caused by shortcodes.
	 *
	 * @since   1.0.0
	 *
	 * @param   string $content  String of HTML content.
	 * @return  string  $content Amended string of HTML content.
	 */
	public function nbc_empty_paragraph_fix( $content ) {

		$array = array(
			'<p>['    => '[',
			']</p>'   => ']',
			']<br />' => ']',
		);
		return strtr( $content, $array );
	}

}

new Neo_Bootstrap_Carousel_Shortcode();
