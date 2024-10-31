<?php
/**
 * The public-specific functionality of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/admin
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/public
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Setup Initial Configurations for AMP WP.
		add_action( 'nbc_default_configurations', array( $this, 'default_configurations' ) );

		/**
		 * The class is responsible for defining the post type 'neo_carousel'.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/class-neo-bootstrap-carousel-post-type.php';

		/**
		 * The class is responsible for defining post meta options under 'neo_carousel' post type
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/class-neo-bootstrap-carousel-meta-box.php';

		/**
		 * The class is responsible for defining the shortcode for 'NEO Bootstrap Carousel'.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/class-neo-bootstrap-carousel-shortcode.php';

		/**
		 * The class is responsible for converting NEO Bootstrap Carousel shortcode to Gutenberg Block
		 */
		if ( function_exists( 'register_block_type' ) ) {
			require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/class-neo-bootstrap-carousel-gutenberg.php';
			new Neo_Bootstrap_Carousel_Gutenberg( $this );
		}
	}

	/**
	 * Setup Initial Configurations for NEO Bootstrap Carousel
	 *
	 * @since       1.4.2
	 */
	public function default_configurations() {

		update_option( '_nbc_plugin_version', '1.4.2' );

		// General Settings.
		$general_default_settings = array(
			'show_caption'  => 1,
			'show_arrows'   => 1,
			'show_controls' => 1,
		);

		$general_stored_settings   = get_option( 'nbc_general_settings', array() );
		$general_settings_to_store = array_merge( $general_default_settings, $general_stored_settings );
		update_option( 'nbc_general_settings', $general_settings_to_store );

		// Design Settings.
		$design_default_settings = array(
			'animation_style' => 'fadeInUp',
		);

		$design_stored_settings   = get_option( 'nbc_design_settings', array() );
		$design_settings_to_store = array_merge( $design_default_settings, $design_stored_settings );
		update_option( 'nbc_design_settings', $design_settings_to_store );

		// Advance Settings.
		$advance_default_settings = array(
			'show_content_on_mobile' => 1,
		);

		$advance_stored_settings   = get_option( 'nbc_advanced_settings', array() );
		$advance_settings_to_store = array_merge( $advance_default_settings, $advance_stored_settings );
		update_option( 'nbc_advanced_settings', $advance_settings_to_store );

		// Remove rewrite rules and then recreate rewrite rules.
		flush_rewrite_rules();

		if ( ! is_network_admin() ) {
			set_transient( '_nbc_page_welcome_redirect', 1, 30 );
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '-animate', NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'public/css/animate.css', array(), '3.1.1', 'all' );
		wp_enqueue_style( $this->plugin_name, NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'public/css/neo-bootstrap-carousel-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'public/js/neo-bootstrap-carousel-public.js', array( 'jquery', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-api-fetch' ), $this->version, true );
	}

}
