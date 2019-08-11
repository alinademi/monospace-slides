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

}
