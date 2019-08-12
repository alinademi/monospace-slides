<?php
/**
 * The functionality for creating and managing shortcodes.
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/includes
 */

/**
 * The functionality for creating and managing shortcodes.
 *
 * Defines all the functionality related to the creation and managing of shortcodes.
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/includes
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides_Shortcodes {

	/**
	 * Create and register the 'mnsp_slide' shortcode for displaying a single slide.
	 *
	 * @since 1.0.0
	 */
	public function register_slide_shortcode() {

		/**
		 * Handler function for the 'mnsp_slide' shortcode.
		 *
		 * @since 1.0.0
		 * @param array $atts    Shortcode attributes.
		 */
		function slide_shortcode( $atts ) {

			$args = shortcode_atts(
				array(
					'id' => '',
				),
				$atts
			);

			$id = (int) $args['id'];

			$title       = esc_html( get_post_meta( $id, 'mnsp-slide-title', true ) );
			$title_color = esc_attr( get_post_meta( $id, 'mnsp-slide-title-color', true ) );

			$subtitle       = esc_html( get_post_meta( $id, 'mnsp-slide-subtitle', true ) );
			$subtitle_color = esc_attr( get_post_meta( $id, 'mnsp-slide-subtitle-color', true ) );

			$desc       = esc_textarea( get_post_meta( $id, 'mnsp-slide-desc', true ) );
			$desc_color = esc_attr( get_post_meta( $id, 'mnsp-slide-desc-color', true ) );

			$cta_text           = esc_html( get_post_meta( $id, 'mnsp-slide-cta-text', true ) );
			$cta_text_color     = esc_attr( get_post_meta( $id, 'mnsp-slide-cta-text-color', true ) );
			$cta_bg_color       = esc_attr( get_post_meta( $id, 'mnsp-slide-cta-bg-color', true ) );
			$cta_hover_bg_color = esc_attr( get_post_meta( $id, 'mnsp-slide-cta-hover-bg-color', true ) );
			$cta_url            = esc_url( get_post_meta( $id, 'mnsp-slide-cta-url', true ) );
			$cta_target         = esc_attr( get_post_meta( $id, 'mnsp-slide-cta-target', true ) ) ? '_blank' : '_self';

			$image = esc_url( get_post_meta( $id, 'mnsp-slide-image', true ) );

			$horiz_align = esc_attr( get_post_meta( $id, 'mnsp-slide-horiz-align', true ) );

			$ratio = esc_attr( get_post_meta( $id, 'mnsp-slide-ratio', true ) );

			$feat_img_opacity = esc_attr( get_post_meta( $id, 'mnsp-slide-featured-opacity', true ) );

			$bg_color = esc_attr( get_post_meta( $id, 'mnsp-slide-bg-color', true ) );

			$has_thumbnail = has_post_thumbnail( $id ) ? ' mnsp-slide-has-thumbnail' : '';

			$slide = '<div 
				id="mnsp-slide-' . $id . '" 
				class="mnsp-slide' . $has_thumbnail . '" 
				data-mnsp-slide-title-color="' . $title_color . '" 
				data-mnsp-slide-subtitle-color="' . $subtitle_color . '"
				data-mnsp-slide-desc-color="' . $desc_color . '" 
				data-mnsp-slide-cta-text-color="' . $cta_text_color . '" 
				data-mnsp-slide-cta-bg-color="' . $cta_bg_color . '" 
				data-mnsp-slide-cta-hover-bg-color="' . $cta_hover_bg_color . '" 
				data-mnsp-slide-horiz-align="' . $horiz_align . '" 
				data-mnsp-slide-ratio="' . $ratio . '" 
				data-mnsp-slide-featured-opacity="' . $feat_img_opacity . '" 
				data-mnsp-slide-bg-color="' . $bg_color . '">';

			$slide .= '<div class="mnsp-slide-caption">';

			if ( ! empty( $image ) ) {
				$slide .= '<img class="mnsp-slide-image" src="' . $image . '" />';
			}

			if ( ! empty( $title ) ) {
				$slide .= '<p class="mnsp-slide-title">' . $title . '</p>';
			}

			if ( ! empty( $subtitle ) ) {
				$slide .= '<p class="mnsp-slide-subtitle">' . $subtitle . '</p>';
			}

			if ( ! empty( $desc ) ) {
				$slide .= '<p class="mnsp-slide-desc">' . $desc . '</p>';
			}

			if ( ! empty( $cta_text ) && ! empty( $cta_url ) ) {
				$slide .= '<a class="mnsp-slide-cta" href="' . $cta_url . '" target="' . $cta_target . '">' . $cta_text . '</a>';
			}

			$slide .= '</div>';

			$slide .= get_the_post_thumbnail( $id, 'mnsp-image-' . $ratio, array( 'class' => 'mnsp-slide-featured' ) );

			$slide .= '</div>';

			return $slide;

		}

		add_shortcode( 'mnsp_slide', 'slide_shortcode' );

	}

}
