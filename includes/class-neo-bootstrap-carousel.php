<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 */

/**
 * The file that defines the core plugin class
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     Neo_Bootstrap_Carousel_Loader   $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string      $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string      $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'neo-bootstrap-carousel';
		if ( defined( 'NEO_BOOTSTRAP_CAROUSEL_VERSION' ) ) {
			$this->version = NEO_BOOTSTRAP_CAROUSEL_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Neo_Bootstrap_Carousel_Loader. Orchestrates the hooks of the plugin.
	 * - Neo_Bootstrap_Carousel_i18n. Defines internationalization functionality.
	 * - Neo_Bootstrap_Carousel_Admin. Defines all hooks for the admin area.
	 * - Neo_Bootstrap_Carousel_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * All Function Files
		 *
		 * - Core Functions
		 * - Formatting Functions
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/functions/neo-bootstrap-carousel-core-functions.php';
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/functions/neo-bootstrap-carousel-formatting-functions.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/class-neo-bootstrap-carousel-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'includes/class-neo-bootstrap-carousel-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/class-neo-bootstrap-carousel-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'public/class-neo-bootstrap-carousel-public.php';

		$this->loader = new Neo_Bootstrap_Carousel_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Neo_Bootstrap_Carousel_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function set_locale() {
		$plugin_i18n = new Neo_Bootstrap_Carousel_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Neo_Bootstrap_Carousel_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function define_public_hooks() {
		$plugin_public = new Neo_Bootstrap_Carousel_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since   1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since   1.0.0
	 * @return  string  The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since   1.0.0
	 * @return  Neo_Bootstrap_Carousel_Loader   Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since   1.0.0
	 * @return  string  The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
