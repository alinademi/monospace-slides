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

	/**
	 * Create and register the 'mnsp_slider' shortcode for displaying multiple slides in a slider.
	 *
	 * @since 1.0.0
	 */
	public function register_slider_shortcode() {

		/**
		 * Handler function for the 'mnsp_slider' shortcode.
		 *
		 * @since 1.0.0
		 * @param array $atts    Shortcode attributes.
		 */
		function slider_shortcode( $atts ) {

			$args = shortcode_atts(
				array(
					'id' => '',
				),
				$atts
			);

			$id = (int) $args['id'];

			$transition_type     = esc_attr( get_term_meta( $id, 'mnsp-slider-transition-type', true ) );
			$transition_duration = esc_attr( get_term_meta( $id, 'mnsp-slider-transition-duration', true ) );
			$timeout             = esc_attr( get_term_meta( $id, 'mnsp-slider-timeout', true ) );

			$show_nav = esc_attr( get_term_meta( $id, 'mnsp-slider-show-nav', true ) ) ? 'data-mnsp-slider-show-nav' : '';

			$pause_hover = esc_attr( get_term_meta( $id, 'mnsp-slider-pause-hover', true ) ) ? 'data-mnsp-slider-pause-hover' : '';

			$autoplay = esc_attr( get_term_meta( $id, 'mnsp-slider-autoplay', true ) ) ? 'data-mnsp-slider-autoplay' : '';

			$ratio = esc_attr( get_term_meta( $id, 'mnsp-slider-aspect', true ) );

			$args = array(
				'post_type' => 'mnsp_slide',
				'tax_query' => array( // WPCS: slow query ok.
					array(
						'taxonomy'         => 'mnsp_slider',
						'field'            => 'term_id',
						'terms'            => $id,
						'include_children' => false,
					),
				),
			);

			$slides = get_posts( $args );

			if ( ! empty( $slides ) ) :

				$slider = '<div 
					id="mnsp-slider-' . $id . '" 
					data-mnsp-slider-transition-type="' . $transition_type . '" 
					data-mnsp-slider-transition-duration="' . $transition_duration . '"
					data-mnsp-slider-timeout="' . $timeout . '"
					data-mnsp-slider-ratio="' . $ratio . '"
					' . $show_nav . '
					' . $pause_hover . '
					' . $autoplay . '
					class="mnsp-slider">';

				if ( ! empty( $show_nav ) ) {
					$slider .= '<div class="mnsp-slider-controls" data-glide-el="controls">';
					$slider .= '<button data-glide-dir="<">&lsaquo;</button>';
					$slider .= '<button data-glide-dir=">">&rsaquo;</button>';
					$slider .= '</div>';
				}

				$slider .= '<div class="glide__track" data-glide-el="track">';

				$slider .= '<div class="glide__slides">';

				foreach ( $slides as $slide_post ) {

					$slide_id = $slide_post->ID;

					$title       = esc_html( get_post_meta( $slide_id, 'mnsp-slide-title', true ) );
					$title_color = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-title-color', true ) );

					$subtitle       = esc_html( get_post_meta( $slide_id, 'mnsp-slide-subtitle', true ) );
					$subtitle_color = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-subtitle-color', true ) );

					$desc       = esc_textarea( get_post_meta( $slide_id, 'mnsp-slide-desc', true ) );
					$desc_color = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-desc-color', true ) );

					$cta_text           = esc_html( get_post_meta( $slide_id, 'mnsp-slide-cta-text', true ) );
					$cta_text_color     = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-cta-text-color', true ) );
					$cta_bg_color       = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-cta-bg-color', true ) );
					$cta_hover_bg_color = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-cta-hover-bg-color', true ) );
					$cta_url            = esc_url( get_post_meta( $slide_id, 'mnsp-slide-cta-url', true ) );
					$cta_target         = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-cta-target', true ) ) ? '_blank' : '_self';

					$image = esc_url( get_post_meta( $slide_id, 'mnsp-slide-image', true ) );

					$horiz_align = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-horiz-align', true ) );

					// We're using the ratio from the slider taxonomy term meta.
					// The ratio of each individual slide is not necessary.
					/* $slide_ratio = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-ratio', true ) ); */ // phpcs:ignore

					$feat_img_opacity = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-featured-opacity', true ) );

					$bg_color = esc_attr( get_post_meta( $slide_id, 'mnsp-slide-bg-color', true ) );

					$has_thumbnail = has_post_thumbnail( $slide_id ) ? ' mnsp-slide-has-thumbnail' : '';

					$slide = '<div 
						id="mnsp-slide-' . $slide_id . '" 
						class="glide__slide mnsp-slide' . $has_thumbnail . '" 
						data-mnsp-slide-title-color="' . $title_color . '" 
						data-mnsp-slide-subtitle-color="' . $subtitle_color . '" 
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
						$slide .= '<a class="mnsp-slide-cta" href="' . $cta_url . '" target"' . $cta_target . '">' . $cta_text . '</a>';
					}

					$slide .= '</div>';

					$slide .= get_the_post_thumbnail( $slide_id, 'mnsp-image-' . $ratio, array( 'class' => 'mnsp-slide-featured' ) );

					$slide .= '</div>';

					$slider .= $slide;

				}

				wp_reset_postdata();

				$slider .= '</div></div></div>';

			else :

				$slider = '<p><strong>' . __( 'This slider does not contain any posts.', 'monospace-slides' ) . '</strong></p>';

			endif;

			return $slider;

		}

		add_shortcode( 'mnsp_slider', 'slider_shortcode' );

	}

	/**
	 * Creates a new admin column on the custom post type listing screen that will display the slide shortcode.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param array $columns    Screen columns.
	 */
	public function add_slide_columns( $columns ) {

		$columns['shortcode'] = __( 'Shortcode', 'monospace-slides' );

		return $columns;

	}

	/**
	 * Displays the slide shortcode in an admin column called 'shortcode'.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param string $column    Shortcode column name identifier.
	 * @param int    $post_id   The id of the post.
	 */
	public function add_slide_columns_content( $column, $post_id ) {

		if ( 'shortcode' === $column ) {
			echo '[mnsp_slide id="' . esc_attr( $post_id ) . '"]';
		}

	}

	/**
	 * Creates a new admin column on the custom taxonomy listing screen that will display the slider shortcode.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param array $columns    Screen columns.
	 */
	public function add_slider_columns( $columns ) {

		$columns['shortcode'] = __( 'Shortcode', 'monospace-slides' );

		return $columns;

	}

	/**
	 * Displays the slider shortcode in an admin column called 'shortcode'.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param string $content        The content of the shortcode.
	 * @param string $column_name    Shortcode column name identifier.
	 * @param int    $term_id        The id of the taxonomy term id.
	 */
	public function add_slider_columns_content( $content, $column_name, $term_id ) {

		if ( 'shortcode' === $column_name ) {
			$content = '[mnsp_slider id="' . $term_id . '"]';
		}

		return $content;
	}

}
