<?php
/**
 * Neo_Bootstrap_Carousel_Post_Type class
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 */

/**
 * Neo_Bootstrap_Carousel_Post_Type Class
 *
 * This class is used to create custom post type for NEO Bootstrap Carousel.
 *
 * @link       https://pixelspress.com
 * @since      1.0.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes
 * @author     PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Post_Type {

	/**
	 * Initialize the class and set it's properties.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
		// Add Hook into the 'init()' Action.
		add_action( 'init', array( $this, 'nbc_init' ) );

		// Add Hook into the 'init()' action.
		add_action( 'admin_init', array( $this, 'nbc_admin_init' ) );
	}

	/**
	 * WordPress core launches at 'init' points
	 *
	 * @since   1.0.0
	 */
	public function nbc_init() {
		$this->create_post_type();

		// Flush Rewrite Rules.
		flush_rewrite_rules();
	}

	/**
	 * Create_post_type function.
	 *
	 * @since   1.0.0
	 */
	public function create_post_type() {
		if ( post_type_exists( 'neo_carousel' ) ) {
			return;
		}

		/**
		 * Post Type -> NEO Bootstrap Carousel.
		 */
		$singular = __( 'Slider', 'neo-bootstrap-carousel' );
		$plural   = __( 'Sliders', 'neo-bootstrap-carousel' );

		// Post Type -> NEO Bootstrap Carousel -> Labels.
		$slider_labels = array(
			'name'               => $plural,
			'singular_name'      => $singular,
			'menu_name'          => __( 'NEO Bootstrap Carousel', 'neo-bootstrap-carousel' ),
			'all_items'          => sprintf(
					/* Translators: %s: Sliders */
				__( '%s', 'neo-bootstrap-carousel' ),
				$plural
			),
			'add_new'            => __( 'Add New', 'neo-bootstrap-carousel' ),
			'add_new_item'       => sprintf(
					/* Translators: %s: Slider */
				__( 'Add %s', 'neo-bootstrap-carousel' ),
				$singular
			),
			'edit'               => __( 'Edit', 'neo-bootstrap-carousel' ),
			'edit_item'          => sprintf(
					/* Translators: %s: Slider */
				__( 'Edit %s', 'neo-bootstrap-carousel' ),
				$singular
			),
			'new_item'           => sprintf(
					/* Translators: %s: Slider */
				__( 'New %s', 'neo-bootstrap-carousel' ),
				$singular
			),
			'view'               => sprintf(
					/* Translators: %s: Slider */
				__( 'View %s', 'neo-bootstrap-carousel' ),
				$singular
			),
			'view_item'          => sprintf(
					/* Translators: %s: Slider */
				__( 'View %s', 'neo-bootstrap-carousel' ),
				$singular
			),
			'search_items'       => sprintf(
					/* Translators: %s: Sliders */
				__( 'Search %s', 'neo-bootstrap-carousel' ),
				$plural
			),
			'not_found'          => sprintf(
					/* Translators: %s: Sliders */
				__( 'No %s found', 'neo-bootstrap-carousel' ),
				$plural
			),
			'not_found_in_trash' => sprintf(
					/* Translators: %s: Sliders */
				__( 'No %s found in trash', 'neo-bootstrap-carousel' ),
				$plural
			),
			'parent'             => sprintf(
					/* Translators: %s: Slider */
				__( 'Parent %s', 'neo-bootstrap-carousel' ),
				$singular
			),
		);

		// Post Type -> NEO Bootstrap Carousel -> Rewrite Parameter.
		$rewrite = array(
			'slug'         => _x( 'neo-carousel', 'NEO Bootstrap Carousel permalink - resave permalinks after changing this', 'neo-bootstrap-carousel' ),
			'with_front'   => false,
			'feeds'        => false,
			'pages'        => false,
			'hierarchical' => false,
		);

		// Post Type -> NEO Bootstrap Carousel -> Arguments.
		$slider_args = array(
			'labels'              => $slider_labels,
			'description'         => sprintf(
					/* Translators: %s: Sliders */
				__( 'This is where you can create and manage %s.', 'neo-bootstrap-carousel' ),
				$plural
			),
			'public'              => true,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => 'neo-bootstrap-carousel-welcome',
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-slides',
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'supports'            => array( 'title' ),
			'rewrite'             => $rewrite,
			'query_var'           => true,
			'can_export'          => true,
		);

		// Register NEO Bootstrap Carousel Post Type.
		register_post_type( 'neo_carousel', apply_filters( 'register_post_type_neo_carousel', $slider_args ) );
	}

	/**
	 * A Function Hook That the WP Core Launches at 'admin_init' Points
	 *
	 * @since   1.0.0
	 */
	public function nbc_admin_init() {

		// Hook - Shortcode -> Add New Column.
		add_filter( 'manage_neo_carousel_posts_columns', array( $this, 'nbc_columns' ) );

		// Hook - Shortcode -> Add Value to New Column.
		add_action( 'manage_neo_carousel_posts_custom_column', array( $this, 'nbc_columns_value' ) );
	}

	/**
	 * Add custom column for 'NEO Bootstrap Column' shortcode
	 *
	 * @since   1.0.0
	 * @param array $columns   Custom Column.
	 *
	 * @return array $columns   Custom Column.
	 */
	public function nbc_columns( $columns ) {
		$columns['shortcode'] = __( 'Shortcode', 'neo-bootstrap-carousel' );
		return $columns;
	}

	/**
	 * Add custom column's value
	 *
	 * @since   1.0.0
	 * @param string $name custom column's name.
	 *
	 * @return  void
	 */
	public function nbc_columns_value( $name ) {
		global $post;
		switch ( $name ) {
			case 'shortcode':
				echo '[neo_carousel_shortcode id="' . intval( $post->ID ) . '"]';
				break;
		}
	}

}

new Neo_Bootstrap_Carousel_Post_Type();
