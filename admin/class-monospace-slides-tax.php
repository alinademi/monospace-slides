<?php
/**
 * The admin-specific functionality for creating a custom taxonomy.
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 */

/**
 * The admin-specific functionality for creating a custom taxonomy.
 *
 * Defines all the functions needed to register and manage a custom taxonomy.
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides_TAX {

	/**
	 * Registers a new taxonomy for a custom post type.
	 *
	 * @since  1.0.0
	 * @access public
	 * @uses   register_taxonomy()
	 */
	public static function new_tax_slider() {

		$tax_name = 'mnsp_slider';

		$labels = array(
			'name'              => esc_html_x( 'Sliders', 'taxonomy general name', 'monospace-slides' ),
			'singular_name'     => esc_html_x( 'Slider', 'taxonomy singular name', 'monospace-slides' ),
			'search_items'      => esc_html__( 'Search Sliders', 'monospace-slides' ),
			'all_items'         => esc_html__( 'All Sliders', 'monospace-slides' ),
			'parent_item'       => esc_html__( 'Parent Slider', 'monospace-slides' ),
			'parent_item_colon' => esc_html__( 'Parent Slider:', 'monospace-slides' ),
			'edit_item'         => esc_html__( 'Edit Slider', 'monospace-slides' ),
			'update_item'       => esc_html__( 'Update Slider', 'monospace-slides' ),
			'add_new_item'      => esc_html__( 'Add New Slider', 'monospace-slides' ),
			'new_item_name'     => esc_html__( 'New Slider Name', 'monospace-slides' ),
			'menu_name'         => esc_html__( 'Sliders', 'monospace-slides' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Group multiple slides into a slider', 'monospace-slides' ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'show_in_rest'       => true,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
		);

		$args = apply_filters( 'monospace_slides_taxonomy_options', $args );

		register_taxonomy( $tax_name, array( 'mnsp_slide' ), $args );

	}

}
