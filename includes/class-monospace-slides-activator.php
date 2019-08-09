<?php
/**
 * Fired during plugin activation
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/includes
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides_Activator {

	/**
	 * Fired during plugin activation.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {

		/**
		 * The class responsible for defining the behavior of the custom post type.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-monospace-slides-cpt.php';

		Monospace_Slides_CPT::new_cpt_slide();

		flush_rewrite_rules();

	}

}
