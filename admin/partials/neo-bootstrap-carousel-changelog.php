<?php
/**
 * Changelog Admin View
 *
 * @link        https://pixelspress.com
 * @since       1.4.1
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/admin/partials
 */

?>
<div class="neo-bootstrap-carousel-content-wrap">
	<div class="neo-bootstrap-carousel-content-header">
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'Changelog', 'neo-bootstrap-carousel' ); ?></h2>
	</div>

	<div class="neo-bootstrap-carousel-content-body">
		<?php if ( $changelog ) : ?>
			<?php foreach ( $changelog as $release_date => $data ) : ?>
				<h3><?php echo esc_attr( $release_date ); ?></h3>
				<ul>
					<?php foreach ( $data as $val ) : ?>
					<li><?php echo esc_attr( $val ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
