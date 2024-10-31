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
 * @subpackage Neo_Bootstrap_Carousel/admin/partials
 */

?>
<div class="neo-bootstrap-carousel-content-wrap">
	<div class="neo-bootstrap-carousel-content-header">
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'Help', 'neo-bootstrap-carousel' ); ?></h2>
	</div>

	<div class="neo-bootstrap-carousel-content-body neo-bootstrap-carousel-system-requirements">
		<button class="nbc-accordion"><?php esc_html_e( 'Is NEO Bootstrap Carousel responsive?', 'neo-bootstrap-carousel' ); ?></button>
		<div class="panel">
			<p><?php esc_html_e( 'Yes, the NEO Bootstrap Carousel is responsive and displays resized image for the mobile devices and tablets.', 'neo-bootstrap-carousel' ); ?></p>
		</div>

		<button class="nbc-accordion"><?php esc_html_e( 'How to add a Carousel?', 'neo-bootstrap-carousel' ); ?></button>
		<div class="panel">
			<p><?php esc_html_e( 'In your WordPress admin panel, go to "NEO Bootstrap Carousel" from menu and add a new carousel. All the NEO Bootstrap Carousel lists will be shown.', 'neo-bootstrap-carousel' ); ?></p>
		</div>

		<button class="nbc-accordion"><?php esc_html_e( 'Can I add Carousel into the theme in a custom location?', 'neo-bootstrap-carousel' ); ?></button>
		<div class="panel">
			<p><?php esc_html_e( 'Yes, that\'s possible to achieve. The plugin automatically generates a shortcode for each carousel, thus you can copy and paste the shortcode for the carousel to a custom location. The shortcode is listed next to the slider published date in NEO Bootstrao Carousel > Sliders section.', 'neo-bootstrap-carousel' ); ?></p>
		</div>

		<button class="nbc-accordion"><?php esc_html_e( 'How to show carousel on the front-end?', 'neo-bootstrap-carousel' ); ?></button>
		<div class="panel">
			<p><?php esc_html_e( 'For operational slider, add [neo_carousel_shortcode id=”put post id here”] shortcode in an existing page or add a new page and write shortcode anywhere in the page editor.', 'neo-bootstrap-carousel' ); ?></p>
		</div>

		<button class="nbc-accordion"><?php esc_html_e( 'How can you change the order of images (slides) within NEO Bootstrap Carousel?', 'neo-bootstrap-carousel' ); ?></button>
		<div class="panel">
			<p><?php esc_html_e( 'NEO Bootstrap Carousel uses easy drag feature. This allows to order the slides for each slider from the back end', 'neo-bootstrap-carousel' ); ?></p>
		</div>

		<button class="nbc-accordion"><?php esc_html_e( 'How do I report bugs and suggest new features?', 'neo-bootstrap-carousel' ); ?></button>
		<div class="panel">
			<p><?php esc_html_e( 'Yes, you can report bugs/suggestions via email support@pixelspress.com', 'neo-bootstrap-carousel' ); ?></p>
		</div>
	</div>

	<div class="neo-bootstrap-carousel-content-footer">
		<h2 class="neo-bootstrap-carousel-content-title"><?php esc_html_e( 'Help', 'neo-bootstrap-carousel' ); ?></h2>
	</div>
</div>
