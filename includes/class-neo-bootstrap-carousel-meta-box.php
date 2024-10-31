<?php
/**
 * Neo_Bootstrap_Carousel_Meta_Box class
 *
 * @link       https://pixelspress.com
 * @since      1.0.3
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/shortcodes
 */

/**
 * Neo_Bootstrap_Carousel_Meta_Box class
 * The class is used to define Neo Bootstrap Carousel Post Meta.
 *
 * @link        https://pixelspress.com
 * @since       1.0.0
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes
 * @author      PixelsPress <support@pixelspress.com>
 */
abstract class Neo_Bootstrap_Carousel_Meta_Box {

	/**
	 * Add NEO Bootstrap Carousel Meta Box.
	 */
	public static function add() {
		$screens = array( 'neo_carousel' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				'neo-bootstrap-carousel-meta-box',
				'Slides',
				array( self::class, 'html' ),
				$screen
			);
		}
	}

	/**
	 * Save NEO Bootstrap Carousel Meta Box.
	 *
	 * @param int $post_id Post ID.
	 */
	public static function save( $post_id ) {

		// Verify Nonce.
		$nbc_nonce = filter_input( INPUT_POST, '_nbc_nonce' );

		if ( ! isset( $nbc_nonce ) || ! wp_verify_nonce( $nbc_nonce, 'nbc-carousel' ) ) {
			return $post_id;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', (int) $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', (int) $post_id ) ) {
				return;
			}
		}

		$slide_source = filter_input( INPUT_POST, 'slide_source' );

		if ( 'media' === $slide_source ) { // If Source is Media.
			// Slide Detail.
			$slide_details = array();

			// Get Attachment's/Slide's IDs.
			$nbc_slide_ids  = filter_input( INPUT_POST, 'nbc_slides' );
			$attachment_ids = isset( $_POST['nbc_slides'] ) ? array_filter( explode( ',', $nbc_slide_ids ) ) : array();

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $id ) {
					$slide_details[] = $id . '|' . filter_input( INPUT_POST, 'overlay_' . $id ) . '|' . filter_input( INPUT_POST, 'overlay_opacity_' . $id ) . '|' . filter_input( INPUT_POST, 'slide_url_' . $id );

					$carousel_post = array(
						'ID'           => intval( $id ),
						'post_title'   => sanitize_text_field( filter_input( INPUT_POST, 'slide_title_' . $id ) ),
						'post_excerpt' => sanitize_textarea_field( filter_input( INPUT_POST, 'slide_description_' . $id ) ),
					);

					// Update the post into the database.
					wp_update_post( $carousel_post );
				}
				update_post_meta( (int) $post_id, sanitize_key( '_neo_bootstrap_carousel' ), implode( ',', $slide_details ) );
			}
		} elseif ( 'posts' === $slide_source ) { // If Source is Post.

			// Slide Detail.
			$slide_details = array();

			// Get Attachment's/Slide's IDs.
			$nbc_slides     = filter_input( INPUT_POST, 'nbc_post_slides' );
			$attachment_ids = isset( $nbc_slides ) ? array_filter( explode( ',', $nbc_slides ) ) : array();

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $id ) {
					$slide_details[] = $id . '|' . filter_input( INPUT_POST, 'overlay_' . $id ) . '|' . filter_input( INPUT_POST, 'overlay_opacity_' . $id );
				}
				update_post_meta( (int) $post_id, sanitize_key( '_neo_bootstrap_carousel' ), implode( ',', $slide_details ) );
			}
		}
		update_post_meta( (int) $post_id, sanitize_key( '_neo_bootstrap_carousel_slide_source' ), $slide_source );
	}

	/**
	 * Display NEO Bootstrap Carousel Meta Box HTML.
	 *
	 * @param object $post Post object.
	 */
	public static function html( $post ) {
		$nbc_slides_source      = get_post_meta( $post->ID, '_neo_bootstrap_carousel_slide_source', true );
		$neo_bootstrap_carousel = get_post_meta( $post->ID, '_neo_bootstrap_carousel', true );

		if ( empty( $nbc_slides_source ) && ! empty( $neo_bootstrap_carousel ) ) {
			$nbc_slides_source = 'media';
		}

		include NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/meta-box/neo-bootstrap-carousel-display.php';
	}

}

add_action( 'add_meta_boxes', array( 'Neo_Bootstrap_Carousel_Meta_Box', 'add' ) );
add_action( 'save_post', array( 'Neo_Bootstrap_Carousel_Meta_Box', 'save' ) );
