<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/admin/partials/settings
 */

?>
<div id="settings-advanced" class="neo-bootstrap-carousel-vtabs-content">
	<form id="neo_bootstrap_carousel_setting_form" name="neo_bootstrap_carousel_setting_form" method="post">
		<input type="hidden" value="1" name="nbc_admin_notices">
		<input type="hidden" value="1" name="nbc_advanced_settings[css_class]">
		<div class="neo-bootstrap-carousel-vtabs-header">
			<div class="neo-bootstrap-carousel-vtabs-title">
				<h2><?php esc_html_e( 'Advanced Settings', 'neo-bootstrap-carousel' ); ?></h2>
			</div>
			<div class="neo-bootstrap-carousel-vtabs-btn-toolbar">
				<?php submit_button( esc_html__( 'Save Changes', 'neo-bootstrap-carousel' ), 'button-primary', 'save', false ); ?>
			</div>
		</div>
		<div class="neo-bootstrap-carousel-vtabs-body">
			<h3 class="neo-bootstrap-carousel-form-section-title"><?php esc_html_e( 'Visibility', 'neo-bootstrap-carousel' ); ?></h3>
			<table class="form-table neo-bootstrap-carousel-form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="show_content_on_mobile"><?php esc_html_e( 'Show Content On Mobile', 'neo-bootstrap-carousel' ); ?></label></th>
						<td>
							<div class="switch">
								<input type="checkbox" name="nbc_advanced_settings[show_content_on_mobile]" id="show_content_on_mobile" <?php echo ( isset( $show_content_on_mobile ) && ! empty( $show_content_on_mobile ) ) ? 'checked="checked"' : ''; ?> />
								<label for="show_content_on_mobile"><?php esc_html_e( '&nbsp;', 'neo-bootstrap-carousel' ); ?></label>
								<div class="description"><p><?php esc_html_e( 'This setting will turn on and off the caption in mobile.', 'neo-bootstrap-carousel' ); ?></p></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="neo-bootstrap-carousel-vtabs-footer">
			<div class="neo-bootstrap-carousel-vtabs-title">
				<h2><?php esc_html_e( 'Advanced Settings', 'neo-bootstrap-carousel' ); ?></h2>
			</div>
			<div class="neo-bootstrap-carousel-vtabs-btn-toolbar">
				<?php submit_button( esc_html__( 'Save Changes', 'neo-bootstrap-carousel' ), 'button-primary', 'save', false ); ?>
			</div>
		</div>
	</form>
</div>
