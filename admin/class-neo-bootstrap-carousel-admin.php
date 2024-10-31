<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/admin
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Admin {

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
	 * @since       1.0.0
	 * @access      private
	 * @var         string      $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since       1.0.0
	 * @param       string $plugin_name       The name of this plugin.
	 * @param       string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		/**
		 * Redirect to NEO Bootstrap Carousel's Welcome Page after Activation
		 */
		add_action( 'admin_init', array( $this, 'nbc_redirect_to_welcome_page' ) );

		/**
		 * Setting link displayed for NEO Bootstrap Carousel in the Plugins list table.
		 */
		add_filter( 'plugin_action_links_' . plugin_basename( NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . $this->plugin_name . '.php' ), array( $this, 'nbc_action_links' ) );

		/**
		 * Rating Meta displayed for NEO Bootstrap Carousel in the Plugins list table.
		 */
		add_filter( 'plugin_row_meta', array( $this, 'nbc_rating_meta' ), 10, 2 );

		/**
		 * The class responsible for defining all the plugin settings that occur in the front end area.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/class-neo-bootstrap-carousel-welcome.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/class-neo-bootstrap-carousel-settings.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/class-neo-bootstrap-carousel-help.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/class-neo-bootstrap-carousel-system-requirements.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/admin/class-neo-bootstrap-carousel-changelog.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'admin/css/neo-bootstrap-carousel-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'select2', NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'admin/js/select2.js', array( 'jquery' ), '4.0.6', true );
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, NEO_BOOTSTRAP_CAROUSEL_DIR_URL . 'admin/js/neo-bootstrap-carousel-admin.js', array( 'jquery', 'jquery-ui-sortable', 'thickbox', 'media-upload' ), $this->version, true );
		wp_localize_script(
			$this->plugin_name,
			'nbc',
			array(
				'success_language' => __( 'Success', 'neo-bootstrap-carousel' ),
				'copied_language'  => __( 'Item was copied to your clipboard', 'neo-bootstrap-carousel' ),
			)
		);
	}

	/**
	 * Redirect to NEO Bootstrap Carousel's Welcome Page after Activation
	 *
	 * @since   1.4.0
	 */
	public function nbc_redirect_to_welcome_page() {
		$redirect = get_transient( '_nbc_page_welcome_redirect' );
		delete_transient( '_nbc_page_welcome_redirect' );
		$redirect && wp_safe_redirect( add_query_arg( array( 'page' => 'neo-bootstrap-carousel-welcome' ), 'admin.php' ) );
	}

	/**
	 * Setting link displayed for NEO Bootstrap Carousel in the Plugins list table.
	 *
	 * @param   array $links An array of plugin action links.
	 * @since   1.4.0
	 *
	 * @return  array
	 */
	public function nbc_action_links( $links ) {
		return array_merge(
			array( 'settings' => '<a href="' . esc_url( add_query_arg( array( 'page' => 'neo-bootstrap-carousel-settings' ), 'admin.php' ) ) . '">' . __( 'Settings', 'neo-bootstrap-carousel' ) . '</a>' ),
			$links
		);
	}

	/**
	 * Rating Meta displayed for NEO Bootstrap Carousel in the Plugins list table.
	 *
	 * @param string[] $meta_fields An array of the plugin's metadata, including the version, author, author URI, and plugin URI.
	 * @param string   $file Path to the plugin file relative to the plugins directory.
	 * @since 1.4.0
	 *
	 * @return  string
	 */
	public function nbc_rating_meta( $meta_fields, $file ) {

		if ( strpos( $file, 'neo-bootstrap-carousel.php' ) !== false ) {
			$meta_fields[] = "<span class='neo-bootstrap-carousel'><a href='https://wordpress.org/support/plugin/neo-bootstrap-carousel/reviews/#new-post' target='_blank' title='" . __( 'Share The Love!', 'neo-bootstrap-carousel' ) . "'>
				  <i class='neo-bootstrap-carousel-star-rating'>"
					. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
					. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
					. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
					. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
					. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
					. '</i></a></span>';
		}
		return $meta_fields;
	}
}
