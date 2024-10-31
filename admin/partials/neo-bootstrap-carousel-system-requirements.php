<?php
/**
 * System Requirements Admin View
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/admin/partials
 */

?>
<div class="neo-bootstrap-carousel-content-wrap">
	<div class="neo-bootstrap-carousel-content-header">
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'System Requirements', 'neo-bootstrap-carousel' ); ?></h2>
	</div>

	<div class="neo-bootstrap-carousel-content-body neo-bootstrap-carousel-system-requirements">
		<!-- System Requirements - START -->
		<table class="widefat neo-bootstrap-carousel-table neo-bootstrap-carousel-help-table" cellspacing="0">
			<tbody>
				<tr>
					<td data-export-label="<?php esc_html_e( 'Uploads folder writable:', 'neo-bootstrap-carousel' ); ?>"><?php esc_html_e( 'Uploads folder writable:', 'neo-bootstrap-carousel' ); ?></td>
					<td class="help">
						<?php
						echo nbc_help_tip(
							sprintf(
								/* translators: %1$s: Modify File Permission Article URL. */
								esc_html__( 'wp-content\'s "uploads" directory folder should have its permissions set to "755". This can be done using an FTP program along with these <a href="%1$s">instructions</a>.', 'neo-bootstrap-carousel' ),
								esc_url( 'https://wordpress.org/support/article/changing-file-permissions/' )
							)
						); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */
						?>
					</td>
					<td><?php echo ( $writeable_boolean ) ? '&#10004;' : '&#10060;'; ?></td>
					<td></td>
				</tr>
				<tr>
					<td data-export-label="<?php esc_html_e( 'Memory Limit', 'neo-bootstrap-carousel' ); ?>"><?php esc_html_e( 'Memory Limit', 'neo-bootstrap-carousel' ); ?>:</td>
					<td class="help">
						<?php
						echo nbc_help_tip(
							sprintf(
								/* translators: %1$s: Increasing memory allocated to PHP Article URL. */
								esc_html__( 'Default WordPress Memory eseful for the plugin\'s admin to work smoothly. Memory can be increased by <a href="%1$s">editing your "wp-config.php" file</a>.', 'neo-bootstrap-carousel' ),
								esc_url( 'https://wordpress.org/support/article/editing-wp-config-php/#increasing-memory-allocated-to-php' )
							)
						); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */
						?>
					</td>
					<td><?php echo ( $mem_limit_byte_boolean ) ? '&#10060;' : '&#10004;'; ?></td>
					<td><?php esc_html_e( 'Currently:', 'neo-bootstrap-carousel' ); ?> <?php echo esc_attr( $mem_limit ); ?></td>
				</tr>
				<tr>
					<td data-export-label="<?php esc_html_e( 'Upload Max. Filesize', 'neo-bootstrap-carousel' ); ?>"><?php esc_html_e( 'Upload Max. Filesize', 'neo-bootstrap-carousel' ); ?>:</td>
					<td class="help">
					<?php
					echo nbc_help_tip(
						sprintf(
							/* translators: %1$s: Maximum allowed size for uploaded files article URL. */
							esc_html__( 'Important for the ability to upload large image files, and also import templates. <a href="%1$s">Click here</a> to learn how this can be increased..', 'neo-bootstrap-carousel' ),
							esc_url( 'https://pixelspress.com/knowledge-base/recommended-php-configuration-resource-limits-for-wordpress/' )
						)
					); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */
					?>
					</td>
					<td><?php echo ( $upload_max_filesize_byte_boolean ) ? '&#10060;' : '&#10004;'; ?></td>
					<td><?php esc_html_e( 'Currently:', 'neo-bootstrap-carousel' ); ?> <?php echo esc_attr( $upload_max_filesize ); ?></td>
				</tr>
				<tr>
					<td data-export-label="<?php esc_html_e( 'Max. Post Size', 'neo-bootstrap-carousel' ); ?>"><?php esc_html_e( 'Max. Post Size', 'neo-bootstrap-carousel' ); ?>:</td>
					<td class="help"></td>
					<td><?php echo ( $post_max_size_byte_boolean ) ? '&#10060;' : '&#10004;'; ?></td>
					<td><?php esc_html_e( 'Currently:', 'neo-bootstrap-carousel' ); ?> <?php echo esc_attr( $post_max_size ); ?></td>
				</tr>
				<tr>
					<td data-export-label="<?php esc_html_e( 'Contact WordPress Server', 'neo-bootstrap-carousel' ); ?>"><?php esc_html_e( 'Contact WordPress Server', 'neo-bootstrap-carousel' ); ?>:</td>
					<td class="help">
<?php echo nbc_help_tip( esc_html__( 'Outbound communications (i.e. "dialing out") to the following urls are necessary for automatic updates.', 'neo-bootstrap-carousel' ) ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
					</td>
					<td> <?php echo ( $can_connect ) ? '&#10060;' : '&#10004;'; ?> </td>
				</tr>
			</tbody>
		</table>
		<!-- System Requirements - END -->
	</div>

	<div class="neo-bootstrap-carousel-content-footer">
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'System Requirements', 'neo-bootstrap-carousel' ); ?></h2>
	</div>
</div>
