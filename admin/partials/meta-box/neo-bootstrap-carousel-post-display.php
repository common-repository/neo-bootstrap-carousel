<?php
/**
 * Provide a admin area view for the Meta Box "Media"
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.3
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$neo_bootstrap_carousel_slide_ids = array_filter( explode( ',', $neo_bootstrap_carousel ) );

$updated_post_ids = array();
$arg              = array(
	'post_type'      => 'post',
	'post_status'    => array( 'publish' ),
	'has_password'   => false,
	'posts_per_page' => 3,
	'meta_query'     => array( // WPCS: slow query ok.
		array(
			'key'     => '_thumbnail_id',
			'compare' => 'EXISTS',
		),
	),
);
$the_query        = new WP_Query( $arg );
?>
<div id="nbc-post-container">
	<ul class="nbc-slides">
		<?php
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$attachment_overlay         = '';
				$attachment_overlay_opacity = '';

				$get_post_id = get_the_ID();
				if ( in_array( $get_post_id, $neo_bootstrap_carousel_slide_ids ) ) :

					$found_key = array_search( $get_post_id, $neo_bootstrap_carousel_slide_ids );
					if ( false !== $found_key ) :
						$nbc_slide_array = explode( '|', $neo_bootstrap_carousel_slide_ids[ $found_key ] );

						if ( $nbc_slide_array[0] == $get_post_id ) :
							$attachment_overlay         = isset( $nbc_slide_array[1] ) ? $nbc_slide_array[1] : '';
							$attachment_overlay_opacity = isset( $nbc_slide_array[2] ) ? $nbc_slide_array[2] : '';
						endif;
					endif;
				endif;
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail', false, '' );
				?>
				<li class="slide" data-attachment_id="<?php echo intval( $get_post_id ); ?>">
					<table class="form-table neo-bootstrap-carousel-form-table">
						<tbody>
							<tr>
								<td><img src="<?php echo esc_url( $src[0] ); ?>" alt="" /></td>
								<td>
									<label for="slide_title_<?php echo intval( $get_post_id ); ?>"><?php esc_html_e( 'Title', 'neo-bootstrap-carousel' ); ?></label>
									<input type="text" name="slide_title_<?php echo intval( $get_post_id ); ?>" id="slide_title_<?php echo intval( $get_post_id ); ?>" value="<?php the_title(); ?>" class="regular-text" disabled="disabled" />

									<label for="slide_description_<?php echo intval( $get_post_id ); ?>"><?php esc_html_e( 'Description', 'neo-bootstrap-carousel' ); ?></label>
									<textarea name="slide_description_<?php echo intval( $get_post_id ); ?>" id="slide_description_<?php echo intval( $get_post_id ); ?>"  rows="3" class="large-text" disabled="disabled"><?php echo esc_textarea( get_the_excerpt() ); ?></textarea>

									<label for="overlay_<?php echo intval( $get_post_id ); ?>"><?php esc_html_e( 'Overlay', 'neo-bootstrap-carousel' ); ?></label>
									<select name="overlay_<?php echo intval( $get_post_id ); ?>" id="overlay_<?php echo intval( $get_post_id ); ?>" class="neo-bootstrap-carousel-select">
										<option value="" <?php echo ( empty( $attachment_overlay ) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'None', 'neo-bootstrap-carousel' ); ?></option>
										<option value="dark" <?php echo ( 'dark' === $attachment_overlay ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Dark', 'neo-bootstrap-carousel' ); ?></option>
										<option value="light" <?php echo ( ( 'light' === $attachment_overlay ) ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'Light', 'neo-bootstrap-carousel' ); ?></option>
									</select>

									<label for="overlay_opacity_<?php echo intval( $get_post_id ); ?>"><?php esc_html_e( 'Overlay Opacity', 'neo-bootstrap-carousel' ); ?></label>
									<select name="overlay_opacity_<?php echo intval( $get_post_id ); ?>" id="overlay_opacity_<?php echo intval( $get_post_id ); ?>" class="neo-bootstrap-carousel-select">
									<option value="0.05" <?php echo ( ( '0.05' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>5%</option>
										<option value="0.10" <?php echo ( ( '0.10' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>10%</option>
										<option value="0.15" <?php echo ( ( '0.15' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>15%</option>
										<option value="0.20" <?php echo ( ( '0.20' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>20%</option>
										<option value="0.25" <?php echo ( ( '0.25' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>25%</option>
										<option value="0.30" <?php echo ( ( '0.30' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>30%</option>
										<option value="0.35" <?php echo ( ( '0.35' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>35%</option>
										<option value="0.40" <?php echo ( ( '0.40' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>40%</option>
										<option value="0.45" <?php echo ( ( '0.45' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>45%</option>
										<option value="0.50" <?php echo ( ( '0.50' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>50%</option>
										<option value="0.55" <?php echo ( ( '0.55' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>55%</option>
										<option value="0.60" <?php echo ( ( '0.60' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>60%</option>
										<option value="0.65" <?php echo ( ( '0.65' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>65%</option>
										<option value="0.70" <?php echo ( ( '0.70' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>70%</option>
										<option value="0.75" <?php echo ( ( '0.75' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>75%</option>
										<option value="0.80" <?php echo ( ( '0.80' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>80%</option>
										<option value="0.85" <?php echo ( ( '0.85' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>85%</option>
										<option value="0.90" <?php echo ( ( '0.90' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>90%</option>
										<option value="0.95" <?php echo ( ( '0.95' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>95%</option>
										<option value="1" <?php echo ( ( '1' === $attachment_overlay_opacity ) ? 'selected="selected"' : '' ); ?>>100%</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
				<?php
				// Rebuild IDs to be Saved.
				$updated_post_ids[] = $get_post_id;
			endwhile;
		endif;
		?>
	</ul>
</div>
