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
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'Getting Started', 'neo-bootstrap-carousel' ); ?></h2>
	</div>

	<div class="neo-bootstrap-carousel-content-body">
		<h3><?php esc_html_e( 'Thank you for installing our plugin.', 'neo-bootstrap-carousel' ); ?></h3>
		<p><?php esc_html_e( 'Please complete the following steps to configure the plugin:', 'neo-bootstrap-carousel' ); ?></p>

		<hr class="neo-bootstrap-carousel-section-sep">

		<div class="neo-bootstrap-carousel-welcome">
			<div class="neo-bootstrap-carousel-boxes neo-bootstrap-carousel-boxes-3-col">
				<?php
				$i = 1;
				foreach ( $getting_started as $value ) :
					?>
					<div class="neo-bootstrap-carousel-box neo-bootstrap-carousel-box-num-icon">
						<div class="neo-bootstrap-carousel-num-icon-title">
							<div class="neo-bootstrap-carousel-num"><?php echo intval( $i ); ?></div>
							<div class="neo-bootstrap-carousel-icon-title">
								<img src="<?php echo esc_attr( $value['box-image'] ); ?>" alt="<?php echo esc_attr( $value['box-title'] ); ?>" />
								<h2><?php echo esc_attr( $value['box-title'] ); ?></h2>
							</div>
						</div>
						<p><?php echo wp_kses_post( $value['box-description'] ); ?></p>
						<div class="neo-bootstrap-carousel-action-buttons">
							<a href="<?php echo esc_url( $value['box-cta-url'] ); ?>" class="button-primary"><?php echo esc_attr( $value['box-cta-title'] ); ?></a>
						</div>
					</div>
					<?php
					$i++;
				endforeach;
				?>
			</div>
		</div>

		<hr class="neo-bootstrap-carousel-section-sep">
	</div>
</div>

<hr class="neo-bootstrap-carousel-section-sep">

<div class="neo-bootstrap-carousel-content-wrap">
	<div class="neo-bootstrap-carousel-content-footer">
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'Credits', 'neo-bootstrap-carousel' ); ?></h2>
	</div>

	<div class="neo-bootstrap-carousel-content-body">
		<p><?php esc_html_e( 'NEO Bootstrap Carousel was developed with ❤ by PixelsPress.', 'neo-bootstrap-carousel' ); ?></p>

		<hr class="neo-bootstrap-carousel-section-sep">

		<h3><?php esc_html_e( 'Project Leader', 'neo-bootstrap-carousel' ); ?></h3>
		<hr class="neo-bootstrap-carousel-section-sep">

		<div class="neo-bootstrap-carousel-team">
			<?php
			if ( $credit_leader ) :
				foreach ( $credit_leader as $leader ) :
					?>
					<a href="<?php echo esc_url( $leader['url'] ); ?>" target="_blank" class="neo-bootstrap-carousel-team-member">
						<?php echo get_avatar( sanitize_email( $leader['email'] ) ); ?>
						<div class="neo-bootstrap-carousel-member-info">
							<h4><?php echo esc_attr( $leader['name'] ); ?></h4>
							<p><?php echo esc_attr( $leader['role'] ); ?></p>
						</div>
					</a>
					<?php
				endforeach;
			endif;
			?>
		</div>

		<hr class="neo-bootstrap-carousel-section-sep">
	</div>
</div>
