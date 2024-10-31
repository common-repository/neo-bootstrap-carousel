<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/public/partials
 */

?>
<div id="neo-bootstrap-carousel-<?php echo intval( $shortcode_args['id'] ); ?>" class="carousel slide" data-ride="carousel">

	<!-- Indicators -->
	<?php if ( $show_controls ) : ?>
		<ol class="carousel-indicators">
			<?php $slide_data_counter = count( $slide_data ); ?>
			<?php for ( $j = 0; $j < $slide_data_counter; $j++ ) : ?>
				<li data-target="#neo-bootstrap-carousel-<?php echo intval( $shortcode_args['id'] ); ?>" data-slide-to="<?php echo intval( $j ); ?>" class="<?php echo sanitize_html_class( $first_active ); ?>"></li>
				<?php
				$first_active = '';
			endfor;
			?>
		</ol>
	<?php endif; ?>

	<!-- Slide's Wrapper -->
	<?php $first_active = 'active'; ?>
	<div class="carousel-inner" role="listbox">
		<?php $data_delay = 0; ?>
		<?php $slide_data_counter = count( $slide_data ); ?>
		<?php for ( $i = 0; $i < $slide_data_counter; $i++ ) : ?>

			<div class="item <?php echo esc_attr( $first_active ); ?>" style="background-image: url( '<?php echo esc_url( $slide_data[ $i ]['slide_image_url'] ); ?>' );">
				<!-- Carousel Overlay -->
				<?php
				if ( ! empty( $slide_data[ $i ]['slide_overlay'] ) ) :
					$slide_overlay = ( 'dark' === $slide_data[ $i ]['slide_overlay'] ) ? 'rgba(0, 0, 0, ' . $slide_data[ $i ]['slide_overlay_opacity'] . ')' : 'rgba(255, 255, 255, ' . $slide_data[ $i ]['slide_overlay_opacity'] . ')';
					?>
					<div class="slide-overlay" style="background: <?php echo $slide_overlay; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> "></div>
				<?php endif; ?>

				<!-- Carousel Caption -->
				<?php if ( $show_caption ) : ?>
					<div class="carousel-caption-wrapper">
						<div class="carousel-caption<?php echo ( ! empty( $slide_data[ $i ]['slide_overlay'] ) && 'light' === $slide_data[ $i ]['slide_overlay'] ) ? ' light' : ' dark'; ?> <?php echo ( 1 === $show_content_on_mobile ) ? '' : ' carousel-caption-hide-mobile'; ?>">
							<?php if ( $slide_data[ $i ]['slide_title'] ) : ?>
							<h2 class="banner-title" data-animation="animated <?php echo esc_attr( $animation_style ); ?>"><?php echo esc_attr( $slide_data[ $i ]['slide_title'] ); ?></h2>
							<?php endif; ?>

							<?php if ( $slide_data[ $i ]['slide_excerpt'] ) : ?>
								<p class="lead" data-animation="animated <?php echo esc_attr( $animation_style ); ?>"><?php echo esc_textarea( $slide_data[ $i ]['slide_excerpt'] ); ?></p>
							<?php endif; ?>

							<?php if ( isset( $slide_data[ $i ]['slide_url'] ) && ! empty( $slide_data[ $i ]['slide_url'] ) ) : ?>
								<p data-animation="animated <?php echo esc_attr( $animation_style ); ?>"><a href="<?php echo esc_url( $slide_data[ $i ]['slide_url'] ); ?>" class="btn btn-link <?php echo ( ! empty( $slide_data[ $i ]['slide_overlay'] ) && 'light' === $slide_data[ $i ]['slide_overlay'] ) ? 'light' : 'dark'; ?>"><?php esc_html_e( 'Read More', 'neo-bootstrap-carousel' ); ?></a></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php
			$first_active = '';
		endfor;
		?>
	</div>

	<!-- Arrows - Left & Right Controls -->
	<?php if ( $show_arrows ) : ?>
		<a class="left carousel-control" href="#neo-bootstrap-carousel-<?php echo intval( $shortcode_args['id'] ); ?>" role="button" data-slide="prev">
			<span class="nbc-prev" aria-hidden="true"></span>
			<span class="sr-only"><?php esc_html_e( 'Previous', 'neo-bootstrap-carousel' ); ?></span>
		</a>
		<a class="right carousel-control" href="#neo-bootstrap-carousel-<?php echo intval( $shortcode_args['id'] ); ?>" role="button" data-slide="next">
			<span class="nbc-next" aria-hidden="true"></span>
			<span class="sr-only"><?php esc_html_e( 'Next', 'neo-bootstrap-carousel' ); ?></span>
		</a>
	<?php endif; ?>
</div>

<!-- Script Adding Settings/Attributes of Shortcode -->
<script type="text/javascript">
	/* <![CDATA[ */
	;(function ($) {
		'use strict';

		// Function to Animate Slider Captions.
		function doAnimations(elems) {

			// Cache the animationend event in a variable.
			var animEndEv = 'webkitAnimationEnd animationend';

			elems.each(function() {
				var $this = $(this),
					$animationType = $this.data('animation');
					$this.addClass($animationType).one(animEndEv, function() {
					$this.removeClass($animationType);
				});
			});
		}

		$(window).load(function () {
			var $myCarousel = $('#neo-bootstrap-carousel-<?php echo intval( $shortcode_args['id'] ); ?>'),
				$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

			//Initialize carousel
			$myCarousel.carousel();

			// Animate captions in first slide on page load
			doAnimations($firstAnimatingElems);

			// Pause carousel
			$myCarousel.carousel('pause');

			// Other Slides to be Animated on Carousel Slide Event
			$myCarousel.on('slide.bs.carousel', function (e) {
				var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
				doAnimations($animatingElems);
			});

			// Initialize Carousel with options
			$myCarousel.carousel({
				interval: <?php echo intval( $shortcode_args['interval'] ); ?>,
				pause: "<?php echo esc_attr( $shortcode_args['pause'] ); ?>",
				wrap: <?php echo $shortcode_args['wrap']; ?>,
				keyboard: true
			});
		});
	})(jQuery);
	/* ]]> */
</script>
