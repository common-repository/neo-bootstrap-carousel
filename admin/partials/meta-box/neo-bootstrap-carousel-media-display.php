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
$updated_gallery_ids              = array();
$update_meta                      = false;
?>
<div id="nbc-slider-container">
	<ul class="nbc-slides">
		<?php
		if ( ! empty( $neo_bootstrap_carousel_slide_ids ) ) {
			foreach ( $neo_bootstrap_carousel_slide_ids as $nbc_slide ) {
				$nbc_slide_array            = explode( '|', $nbc_slide );
				$attachment_id              = $nbc_slide_array[0];
				$attachment_overlay         = ( isset( $nbc_slide_array[1] ) ) ? $nbc_slide_array[1] : '';
				$attachment_overlay_opacity = ( isset( $nbc_slide_array[2] ) ) ? $nbc_slide_array[2] : '';
				$attachment_url             = ( isset( $nbc_slide_array[3] ) ) ? $nbc_slide_array[3] : '';

				$attachment      = wp_get_attachment_image( $attachment_id, 'thumbnail' );
				$attachment_meta = get_post( $attachment_id ); // Get post by ID.

				// Skip Empty Attachment.
				if ( empty( $attachment ) ) {
					$update_meta = true;
					continue;
				}
				?>
				<li class="slide" data-attachment_id="<?php echo intval( $attachment_id ); ?>">
					<table class="form-table neo-bootstrap-carousel-form-table">
						<tbody>
							<tr>
								<td class="slide-thumbnail"><?php echo $attachment; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
								<td>
									<label for="slide_title_<?php echo intval( $attachment_id ); ?>"><?php esc_html_e( 'Title', 'neo-bootstrap-carousel' ); ?></label>
									<input type="text" name="slide_title_<?php echo intval( $attachment_id ); ?>" id="slide_title_<?php echo intval( $attachment_id ); ?>" value="<?php echo esc_attr( $attachment_meta->post_title ); ?>" class="regular-text">

									<label for="slide_description_<?php echo intval( $attachment_id ); ?>"><?php esc_html_e( 'Description', 'neo-bootstrap-carousel' ); ?></label>
									<textarea name="slide_description_<?php echo intval( $attachment_id ); ?>" id="slide_description_<?php echo intval( $attachment_id ); ?>" rows="3" class="large-text"><?php echo esc_textarea( $attachment_meta->post_excerpt ); ?></textarea>

									<label for="slide_url_<?php echo intval( $attachment_id ); ?>"><?php esc_html_e( 'URL', 'neo-bootstrap-carousel' ); ?></label>
									<input type="url" name="slide_url_<?php echo intval( $attachment_id ); ?>" id="slide_url_<?php echo intval( $attachment_id ); ?>" value="<?php echo esc_url( $attachment_url ); ?>" class="regular-text code">

									<label for="overlay_<?php echo intval( $attachment_id ); ?>"><?php esc_html_e( 'Overlay', 'neo-bootstrap-carousel' ); ?></label>
									<select name="overlay_<?php echo intval( $attachment_id ); ?>" id="overlay_<?php echo intval( $attachment_id ); ?>" class="neo-bootstrap-carousel-select">
										<option value="" <?php echo empty( $attachment_overlay ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'None', 'neo-bootstrap-carousel' ); ?></option>
										<option value="dark" <?php echo ( 'dark' === $attachment_overlay ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Dark', 'neo-bootstrap-carousel' ); ?></option>
										<option value="light" <?php echo ( 'light' === $attachment_overlay ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Light', 'neo-bootstrap-carousel' ); ?></option>
									</select>

									<label for="overlay_opacity_<?php echo intval( $attachment_id ); ?>"><?php esc_html_e( 'Overlay Opacity', 'neo-bootstrap-carousel' ); ?></label>
									<select name="overlay_opacity_<?php echo intval( $attachment_id ); ?>" id="overlay_opacity_<?php echo intval( $attachment_id ); ?>" class="neo-bootstrap-carousel-select">
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
					<a href="javascript:void(0);" class="delete" title="<?php esc_attr_e( 'Delete Slide', 'neo-bootstrap-carousel' ); ?>"><?php esc_attr_e( 'X', 'neo-bootstrap-carousel' ); ?></a>
				</li>
				<?php
				// Rebuild IDs to be Saved.
				$updated_gallery_ids[] = $attachment_id;
			}
		}
		?>
	</ul>
</div>
