<?php
/**
 * The admin-specific functionality for creating a custom post type.
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 */

/**
 * The admin-specific functionality for creating a custom post type.
 *
 * Defines all the functionality related to creating and managing a custom post type.
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides_CPT {

	/**
	 * Creates a new custom post type
	 *
	 * @since 1.0.0
	 * @access public
	 * @uses register_post_type()
	 */
	public static function new_cpt_slide() {

		$cap_type = 'post';
		$cpt_name = 'mnsp_slide';

		$labels = array(
			'name'                  => esc_html_x( 'Slides', 'Post Type General Name', 'monospace-slides' ),
			'singular_name'         => esc_html_x( 'Slide', 'Post Type Singular Name', 'monospace-slides' ),
			'menu_name'             => esc_html__( 'Slides', 'monospace-slides' ),
			'name_admin_bar'        => esc_html__( 'Slide', 'monospace-slides' ),
			'archives'              => esc_html__( 'Slide Archives', 'monospace-slides' ),
			'attributes'            => esc_html__( 'Slide Attributes', 'monospace-slides' ),
			'parent_item_colon'     => esc_html__( 'Parent Slide:', 'monospace-slides' ),
			'all_items'             => esc_html__( 'All Slides', 'monospace-slides' ),
			'add_new_item'          => esc_html__( 'Add New Slide', 'monospace-slides' ),
			'add_new'               => esc_html__( 'Add New', 'monospace-slides' ),
			'new_item'              => esc_html__( 'New Slide', 'monospace-slides' ),
			'edit_item'             => esc_html__( 'Edit Slide', 'monospace-slides' ),
			'update_item'           => esc_html__( 'Update Slide', 'monospace-slides' ),
			'view_item'             => esc_html__( 'View Slide', 'monospace-slides' ),
			'view_items'            => esc_html__( 'View Slides', 'monospace-slides' ),
			'search_items'          => esc_html__( 'Search Slide', 'monospace-slides' ),
			'not_found'             => esc_html__( 'Not found', 'monospace-slides' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'monospace-slides' ),
			'featured_image'        => esc_html__( 'Featured Image', 'monospace-slides' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'monospace-slides' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'monospace-slides' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'monospace-slides' ),
			'insert_into_item'      => esc_html__( 'Insert into Slide', 'monospace-slides' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Slide', 'monospace-slides' ),
			'items_list'            => esc_html__( 'Slides list', 'monospace-slides' ),
			'items_list_navigation' => esc_html__( 'Slides list navigation', 'monospace-slides' ),
			'filter_items_list'     => esc_html__( 'Filter Slides list', 'monospace-slides' ),
		);

		$args = array(
			'label'               => esc_html__( 'Slide', 'monospace-slides' ),
			'description'         => esc_html__( 'A content type for creating image slides', 'monospace-slides' ),
			'labels'              => $labels,
			'menu_icon'           => 'dashicons-welcome-view-site',
			'supports'            => array( 'title', 'thumbnail', 'revisions' ),
			'taxonomies'          => array( 'mnsp_slider' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'show_in_rest'        => true,
			'publicly_queryable'  => false,
			'capability_type'     => $cap_type,
		);

		$args = apply_filters( 'monospace_slides_cpt_options', $args );

		register_post_type( strtolower( $cpt_name ), $args );

	}

}
