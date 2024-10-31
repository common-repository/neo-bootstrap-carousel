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

$nav_array = array(
	array(
		'menu-title'      => __( 'Welcome', 'neo-bootstrap-carousel' ),
		'menu-page-class' => 'neo-bootstrap-carousel-welcome',
		'menu-url'        => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-welcome' ), 'admin.php' ),
		'menu-class'      => 'welcome',
	),
	array(
		'menu-title'      => __( 'Sliders', 'neo-bootstrap-carousel' ),
		'menu-page-class' => 'neo-bootstrap-carousel-sliders',
		'menu-url'        => add_query_arg( array( 'post_type' => 'neo_carousel' ), 'edit.php' ),
		'menu-class'      => 'sliders',
	),
	array(
		'menu-title'      => __( 'Settings', 'neo-bootstrap-carousel' ),
		'menu-page-class' => 'neo-bootstrap-carousel-settings',
		'menu-url'        => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
		'menu-class'      => 'settings',
		'sub-menu-links'  => array(
			'general-url'      => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
			'layout-url'       => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings#settings-layout' ), 'admin.php' ),
			'social-links-url' => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
			'analytics-url'    => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
			'translation-url'  => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
			'notice-bar-url'   => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
			'gdpr-url'         => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ),
		),
	),
	array(
		'menu-title'      => __( 'Help', 'neo-bootstrap-carousel' ),
		'menu-page-class' => 'neo-bootstrap-carousel-help',
		'menu-url'        => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-help' ), 'admin.php' ),
		'menu-class'      => 'help',
	),
	array(
		'menu-title'      => __( 'System Requirements', 'neo-bootstrap-carousel' ),
		'menu-page-class' => 'neo-bootstrap-carousel-system-requirements',
		'menu-url'        => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-system-requirements' ), 'admin.php' ),
		'menu-class'      => 'system-requirements',
	),
	array(
		'menu-title'      => __( 'Changelog', 'neo-bootstrap-carousel' ),
		'menu-page-class' => 'neo-bootstrap-carousel-changelog',
		'menu-url'        => add_query_arg( array( 'page' => 'neo-bootstrap-carousel-changelog' ), 'admin.php' ),
		'menu-class'      => 'changelog',
	),
);

$neo_bootstrap_carousel_wordpress_version_check = nbc_version_check_using_wpapi();
?>

<!-- Start Header -->
<div class="neo-bootstrap-carousel-header">
	<div class="neo-bootstrap-carousel-logo">
		<img src="<?php echo esc_url( NEO_BOOTSTRAP_CAROUSEL_DIR_URL ); ?>admin/images/neo-bootstrap-carousel-logo.png" alt="<?php echo esc_attr( NEO_BOOTSTRAP_CAROUSEL_NAME ); ?>" />
	</div>
	<div class="neo-bootstrap-carousel-title">
		<h1><?php echo esc_attr( NEO_BOOTSTRAP_CAROUSEL_NAME ); ?></h1>
		<div class="neo-bootstrap-carousel-version">
			<h4 class="neo-bootstrap-carousel-v-i">
				<?php esc_html_e( 'Installed: ', 'neo-bootstrap-carousel' ); ?>
				<strong>
					<?php
					printf(
					/* translators: %s: Installed Plugin Version Number. */
						__( 'v%s', 'neo-bootstrap-carousel' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						esc_attr( NEO_BOOTSTRAP_CAROUSEL_VERSION )
					);
					?>
					</strong>
			</h4>
			<h4 class="neo-bootstrap-carousel-v-sep"><?php esc_html_e( '|', 'neo-bootstrap-carousel' ); ?></h4>
			<h4 class="neo-bootstrap-carousel-v-l">
				<?php esc_html_e( 'Latest: ', 'neo-bootstrap-carousel' ); ?>
				<strong>
				<?php
				printf(
					/* translators: %s: Latest Plugin Version Number. */
					__( 'v%s', 'neo-bootstrap-carousel' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					esc_attr( $neo_bootstrap_carousel_wordpress_version_check )
				);
				?>
				</strong>
				<?php if ( $neo_bootstrap_carousel_wordpress_version_check > NEO_BOOTSTRAP_CAROUSEL_VERSION ) { ?>
					<a href="<?php echo esc_url( admin_url( 'update-core.php' ) ); ?>"><?php esc_html_e( 'Update(s) available!', 'neo-bootstrap-carousel' ); ?></a>
				<?php } ?>
			</h4>
		</div>
	</div>
</div>

<hr class="neo-bootstrap-carousel-section-sep">

<div class="neo-bootstrap-carousel-htabs">
	<?php
	$i = 1;
	foreach ( $nav_array as $val ) :
		?>
		<a href="<?php echo esc_url( $val['menu-url'] ); ?>" class="nav-tab <?php echo sanitize_html_class( $val['menu-class'] ); ?> <?php echo ( sanitize_html_class( $val['menu-page-class'] ) === $page ) ? 'nav-tab-active' : ''; ?>"><span><?php echo intval( $i ); ?></span><?php echo esc_attr( $val['menu-title'] ); ?></a>
		<?php
		$i++;
	endforeach;
	?>
</div>
<hr class="neo-bootstrap-carousel-section-sep">
<!-- End Header -->
