<?php
/**
 * The admin-specific functionality for the slide options metabox.
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 */

/**
 * The admin-specific functionality for the slide options metabox.
 *
 * Defines all the functionality related to the slide options metabox.
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides_CPT_Meta {

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The post type screen on which the metabox will be visible.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    array   $version    The post type screen on which the metabox will be visible.
	 */
	private $screen = array( 'mnsp_slide' );

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $version    The version of this plugin.
	 */
	public function __construct( $version ) {

		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin-facing side of the custom post type meta box.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {

		// CSS rules for Color Picker.
		wp_enqueue_style( 'wp-color-picker' );

	}

	/**
	 * Register the Javascript for the admin-facing side of the custom post type meta box.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

	}

	/**
	 * Add the meta box on the screens defined in the 'screen' propery.
	 *
	 * @since 1.0.0
	 */
	public function add_meta_boxes() {

		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'monospace_slides_admin_metabox',
				esc_html__( 'Slide Options', 'monospace-slides' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'high'
			);
		}

	}

	/**
	 * Generate the fields of the custom meta box.
	 *
	 * @since 1.0.0
	 * @param object $post    The post object.
	 */
	public function meta_box_callback( $post ) {

		wp_nonce_field( 'monospace_slides_admin_metabox_data', 'monospace_slides_admin_metabox_nonce' );
		esc_html_e( 'Set the options for the current slide.', 'monospace-slides' );
		$this->field_generator( $post );

	}

}
