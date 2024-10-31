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
<div id="settings-design" class="neo-bootstrap-carousel-vtabs-content" style="display: none;">
	<form id="neo_bootstrap_carousel_setting_form" name="neo_bootstrap_carousel_setting_form" method="post">
		<input type="hidden" value="1" name="nbc_admin_notices">
		<div class="neo-bootstrap-carousel-vtabs-header">
			<div class="neo-bootstrap-carousel-vtabs-title">
				<h2><?php esc_html_e( 'Design Settings', 'neo-bootstrap-carousel' ); ?></h2>
			</div>
			<div class="neo-bootstrap-carousel-vtabs-btn-toolbar">
				<?php submit_button( esc_html__( 'Save Changes', 'neo-bootstrap-carousel' ), 'button-primary', 'save', false ); ?>
			</div>
		</div>
		<div class="neo-bootstrap-carousel-vtabs-body">
			<h3 class="neo-bootstrap-carousel-form-section-title"><?php esc_html_e( 'Animation', 'neo-bootstrap-carousel' ); ?></h3>
			<table class="form-table neo-bootstrap-carousel-form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="animation_style"><?php esc_html_e( 'Animation Style', 'neo-bootstrap-carousel' ); ?></label></th>
						<td>
							<select name="nbc_design_settings[animation_style]" id="animation_style" class="neo-bootstrap-carousel-select">
								<?php
								$animation_style_dom = '';
								foreach ( $this->css_animations as $group => $group_value ) {
									if ( $group ) {
										$animation_style_dom .= '<optgroup label="' . $group . '">'; }

									foreach ( $group_value as $animation_value => $animation_label ) {
										$selected             = ( $animation_style === $animation_value ) ? 'selected="selected"' : '';
										$animation_style_dom .= '<option value="' . $animation_value . '" ' . $selected . ' >' . $animation_label . '</option>';
									}
									if ( $group ) {
										$animation_style_dom .= '</optgroup>'; }
								}
								echo $animation_style_dom; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?>
							</select>
							<div class="description">
								<p><?php esc_html_e( 'Pick an animation style to enable animations for caption. To disable animations, choose the None option.', 'neo-bootstrap-carousel' ); ?></p>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="neo-bootstrap-carousel-vtabs-footer">
			<div class="neo-bootstrap-carousel-vtabs-title">
				<h2><?php esc_html_e( 'Design Settings', 'neo-bootstrap-carousel' ); ?></h2>
			</div>
			<div class="neo-bootstrap-carousel-vtabs-btn-toolbar">
				<?php submit_button( esc_html__( 'Save Changes', 'neo-bootstrap-carousel' ), 'button-primary', 'save', false ); ?>
			</div>
		</div>
	</form>
</div>
