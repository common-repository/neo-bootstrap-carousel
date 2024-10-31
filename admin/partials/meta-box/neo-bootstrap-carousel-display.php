<?php
/**
 * Provide a admin area view for the Meta Box
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
<div class="neo-bootstrap-carousel">
	<p class="description"><?php esc_html_e( 'Choose Slide Source:', 'neo-bootstrap-carousel' ); ?></p>
	<div class="slide-source-wrapper">
		<input type="radio" name="slide_source" id="slide_source1" value="media" <?php echo ( isset( $nbc_slides_source ) && 'media' === $nbc_slides_source ) ? 'checked="checked"' : ''; ?> class="slide_source" />
		<label for="slide_source1"><?php esc_html_e( 'Media', 'neo-bootstrap-carousel' ); ?></label>
	</div>
	<div style="display: inline-block;">
		<input type="radio" name="slide_source" id="slide_source2" value="posts" <?php echo ( isset( $nbc_slides_source ) && 'posts' === $nbc_slides_source ) ? 'checked="checked"' : ''; ?> class="slide_source" />
		<label for="slide_source2"><?php esc_html_e( 'Posts', 'neo-bootstrap-carousel' ); ?></label>
	</div>

	<!-- Media Slides -->
	<div id="media-source" class="add-slide hide-if-no-js <?php echo ( isset( $nbc_slides_source ) && 'media' === $nbc_slides_source ) ? 'slider-source-show' : 'slider-source-hide'; ?>">
		<a href="javascript:void(0);" data-choose="<?php esc_attr_e( 'Add Slide to Slider', 'neo-bootstrap-carousel' ); ?>" data-update="<?php esc_attr_e( 'Add to Slider', 'neo-bootstrap-carousel' ); ?>" data-delete="<?php esc_attr_e( 'Delete Slide', 'neo-bootstrap-carousel' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'neo-bootstrap-carousel' ); ?>"><?php esc_html_e( 'Add Slide to Slider', 'neo-bootstrap-carousel' ); ?></a>
		<br />
		<?php require plugin_dir_path( __DIR__ ) . 'meta-box/neo-bootstrap-carousel-media-display.php'; ?>
	</div>

	<!-- Post Slides -->
	<div id="post-source" class="<?php echo ( isset( $nbc_slides_source ) && 'posts' === $nbc_slides_source ) ? 'slider-source-show' : 'slider-source-hide'; ?>">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="post_to_show"><?php esc_html_e( 'Post to Show', 'neo-bootstrap-carousel' ); ?></label></th>
				<td>
					<select name="post_to_show" id="post_to_show" class="neo-bootstrap-carousel-select">
						<option value="recent" <?php ( isset( $post_to_show ) && ( 'recent' === $post_to_show ) ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'Most Recent', 'neo-bootstrap-carousel' ); ?></option>
					</select>
				</td>
			</tr>
		</table>
		<?php require plugin_dir_path( __DIR__ ) . 'meta-box/neo-bootstrap-carousel-post-display.php'; ?>
	</div>
	<input type="hidden" name="_nbc_nonce" value="<?php echo wp_create_nonce( 'nbc-carousel' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" />
	<input type="hidden" name="nbc_slides" id="nbc_slides" value="<?php echo esc_attr( implode( ',', $updated_gallery_ids ) ); ?>" />
	<input type="hidden" name="nbc_post_slides" value="<?php echo esc_attr( implode( ',', $updated_post_ids ) ); ?>" />
</div>
