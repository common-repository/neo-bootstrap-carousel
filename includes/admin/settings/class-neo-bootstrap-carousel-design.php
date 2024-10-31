<?php
/**
 * This is used to define NEO Bootstrap Carousel Design Setting.
 *
 * @link       https://pixelspress.com
 * @since      1.4.0
 *
 * @package    Neo_Bootstrap_Carousel
 * @subpackage Neo_Bootstrap_Carousel/includes/admin/settings
 */

/**
 * Neo_Bootstrap_Carousel_Design Class
 *
 * This is used to define NEO Bootstrap Carousel Design Setting.
 *
 * @link        https://pixelspress.com
 * @since       1.4.0
 *
 * @package     Neo_Bootstrap_Carousel
 * @subpackage  Neo_Bootstrap_Carousel/includes/admin/settings
 * @author      PixelsPress <support@pixelspress.com>
 */
class Neo_Bootstrap_Carousel_Design {

	/**
	 * The css animations that's responsible for keeping the values of animations
	 * the plugin.
	 *
	 * @since   1.1.1
	 * @access  private
	 * @var     Neo_Bootstrap_Carousel_Settings_Css_Animations  $css_animations keep all the animations for the plugin.
	 */
	private $css_animations;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.0
	 */
	public function __construct() {

		// Filter -> Add Design Setting Tab.
		add_filter( 'nbc_settings_tab_menus', array( $this, 'nbc_add_design_tab' ) );

		// Action -> Display Design Setting.
		add_action( 'nbc_settings_tab_section', array( $this, 'nbc_add_design_settings' ) );

		// Action -> Save Design Setting.
		add_action( 'nbc_save_setting_sections', array( $this, 'nbc_save_design_settings' ) );
	}

	/**
	 * Add Design Setting Tab
	 *
	 * @param   array $tabs  Setting Tab.
	 * @since   1.4.0
	 *
	 * @return  array  $tabs  Merge array of Setting Tab with Design Tab.
	 */
	public function nbc_add_design_tab( $tabs ) {

		$tabs['design'] = __( '<i class="neo-bootstrap-carousel-admin-icon-settings-1"></i><span>Design</span>', 'neo-bootstrap-carousel' );
		return $tabs;
	}

	/**
	 * Display Design Setting
	 *
	 * This function is used to display settings general section & also display
	 * the stored settings.
	 *
	 * @since       1.4.0
	 */
	public function nbc_add_design_settings() {

		$this->css_animations = array(
			''                   => array(
				'' => __( 'None', 'neo-bootstrap-carousel' ),
			),
			__( 'Attention Seekers', 'neo-bootstrap-carousel' ) => array(
				'bounce'     => __( 'Bounce', 'neo-bootstrap-carousel' ),
				'flash'      => __( 'Flash', 'neo-bootstrap-carousel' ),
				'pulse'      => __( 'Pulse', 'neo-bootstrap-carousel' ),
				'rubberBand' => __( 'Rubber Band', 'neo-bootstrap-carousel' ),
				'shake'      => __( 'Shake', 'neo-bootstrap-carousel' ),
				'swing'      => __( 'Swing', 'neo-bootstrap-carousel' ),
				'tada'       => __( 'Tada', 'neo-bootstrap-carousel' ),
				'wobble'     => __( 'Wobble', 'neo-bootstrap-carousel' ),
				'jello'      => __( 'Jello', 'neo-bootstrap-carousel' ),
			),
			'Bouncing Entrances' => array(
				'bounceIn'      => 'bounceIn',
				'bounceInDown'  => 'bounceInDown',
				'bounceInLeft'  => 'bounceInLeft',
				'bounceInRight' => 'bounceInRight',
				'bounceInUp'    => 'bounceInUp',
			),
			'Fading Entrances'   => array(
				'fadeIn'         => 'fadeIn',
				'fadeInDown'     => 'fadeInDown',
				'fadeInDownBig'  => 'fadeInDownBig',
				'fadeInLeft'     => 'fadeInLeft',
				'fadeInLeftBig'  => 'fadeInLeftBig',
				'fadeInRight'    => 'fadeInRight',
				'fadeInRightBig' => 'fadeInRightBig',
				'fadeInUp'       => 'fadeInUp',
				'fadeInUpBig'    => 'fadeInUpBig',
			),
		);

		// Get Design Setting.
		$animation_style = '';

		if ( get_option( 'nbc_design_settings' ) ) {

			$nbc_design_settings = get_option( 'nbc_design_settings' );
			$animation_style     = ( isset( $nbc_design_settings['animation_style'] ) && ! empty( $nbc_design_settings['animation_style'] ) ) ? $nbc_design_settings['animation_style'] : '';
		}

		// Load View.
		require_once NEO_BOOTSTRAP_CAROUSEL_DIR_PATH . 'admin/partials/settings/neo-bootstrap-carousel-design.php';
	}

	/**
	 * Save Design Setting
	 *
	 * @since   1.4.0
	 */
	public function nbc_save_design_settings() {

		$nbc_design_settings = filter_input_array( INPUT_POST );

		if ( $nbc_design_settings ) :
			foreach ( $nbc_design_settings as $key => $value ) {
				if ( strstr( $key, 'design_settings' ) ) {
					update_option( sanitize_key( $key ), $value );
				}
			}
		endif;
	}
}

new Neo_Bootstrap_Carousel_Design();
