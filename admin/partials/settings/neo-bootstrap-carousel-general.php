<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/admin/partials/settings
 */

?>
<div id="settings-general" class="neo-bootstrap-carousel-vtabs-content">
	<form id="neo_bootstrap_carousel_setting_form" name="neo_bootstrap_carousel_setting_form" method="post">
		<input type="hidden" value="1" name="nbc_admin_notices">
		<div class="neo-bootstrap-carousel-vtabs-header">
			<div class="neo-bootstrap-carousel-vtabs-title">
				<h2><?php esc_html_e( 'General Settings', 'neo-bootstrap-carousel' ); ?></h2>
			</div>
			<div class="neo-bootstrap-carousel-vtabs-btn-toolbar">
				<?php submit_button( esc_html__( 'Save Changes', 'neo-bootstrap-carousel' ), 'button-primary', 'save', false ); ?>
			</div>
		</div>
		<div class="neo-bootstrap-carousel-vtabs-body">
			<h3 class="neo-bootstrap-carousel-form-section-title"><?php esc_html_e( 'Content', 'neo-bootstrap-carousel' ); ?></h3>
			<table class="form-table neo-bootstrap-carousel-form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="show_caption"><?php esc_html_e( 'Show Caption', 'neo-bootstrap-carousel' ); ?></label></th>
						<td>
							<div class="switch">
								<input type="checkbox" name="nbc_general_settings[show_caption]" id="show_caption" <?php echo ( isset( $show_caption ) && ! empty( $show_caption ) ) ? 'checked="checked"' : ''; ?> />
								<label for="show_caption"><?php esc_html_e( '&nbsp;', 'neo-bootstrap-carousel' ); ?></label>
								<div class="description"><p><?php esc_html_e( 'This setting will turn on and off the caption.', 'neo-bootstrap-carousel' ); ?></p></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<h3 class="neo-bootstrap-carousel-form-section-title"><?php esc_html_e( 'Elements', 'neo-bootstrap-carousel' ); ?></h3>
			<table class="form-table neo-bootstrap-carousel-form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="show_arrows"><?php esc_html_e( 'Show Arrows', 'neo-bootstrap-carousel' ); ?></label></th>
						<td>
							<div class="switch">
								<input type="checkbox" name="nbc_general_settings[show_arrows]" id="show_arrows" <?php echo ( isset( $show_arrows ) && ! empty( $show_arrows ) ) ? 'checked="checked"' : ''; ?> />
								<label for="show_arrows"><?php esc_html_e( '&nbsp;', 'neo-bootstrap-carousel' ); ?></label>
								<div class="description"><p><?php esc_html_e( 'This setting will turn on and off the navigation arrows.', 'neo-bootstrap-carousel' ); ?></p></div>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="show_controls"><?php esc_html_e( 'Show Controls', 'neo-bootstrap-carousel' ); ?></label></th>
						<td>
							<div class="switch">
								<input type="checkbox" name="nbc_general_settings[show_controls]" id="show_controls" <?php echo ( isset( $show_controls ) && ! empty( $show_controls ) ) ? 'checked="checked"' : ''; ?> />
								<label for="show_controls"><?php esc_html_e( '&nbsp;', 'neo-bootstrap-carousel' ); ?></label>
								<div class="description"><p><?php esc_html_e( 'This setting will turn on and off the circle buttons at the bottom of the slider.', 'neo-bootstrap-carousel' ); ?></p></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="neo-bootstrap-carousel-vtabs-footer">
			<div class="neo-bootstrap-carousel-vtabs-title">
				<h2><?php esc_html_e( 'General Settings', 'neo-bootstrap-carousel' ); ?></h2>
			</div>
			<div class="neo-bootstrap-carousel-vtabs-btn-toolbar">
				<?php submit_button( esc_html__( 'Save Changes', 'neo-bootstrap-carousel' ), 'button-primary', 'save', false ); ?>
			</div>
		</div>
	</form>
</div>
