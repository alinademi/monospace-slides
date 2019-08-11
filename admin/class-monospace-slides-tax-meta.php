<?php
/**
 * The admin-specific functionality for the slider taxonomy term metadata.
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 */

/**
 * The admin-specific functionality for the slider taxonomy term metadata.
 *
 * Defines all the functionality related to the slider taxonomy term metadata options.
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/admin
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides_TAX_Meta {

	/**
	 * Defines metadata fields.
	 *
	 * @since    1.0.0
	 */
	public function meta_fields() {

		return array(
			array(
				'label'   => esc_html__( 'Transition Type', 'monospace-slides' ),
				'id'      => 'mnsp-slider-transition-type',
				'default' => 'slide',
				'type'    => 'select',
				'options' => array(
					'slide' => esc_html__( 'Slide', 'monospace-slides' ),
				),
			),
			array(
				'label'   => esc_html__( 'Transition Duration', 'monospace-slides' ),
				'id'      => 'mnsp-slider-transition-duration',
				'default' => 300,
				'type'    => 'number',
			),
			array(
				'label'   => esc_html__( 'Timeout Between Slides', 'monospace-slides' ),
				'id'      => 'mnsp-slider-timeout',
				'default' => 3000,
				'type'    => 'number',
			),
			array(
				'label'   => esc_html__( 'Show Navigation Controls', 'monospace-slides' ),
				'id'      => 'mnsp-slider-show-nav',
				'default' => 'controls',
				'type'    => 'checkbox',
			),
			array(
				'label'   => esc_html__( 'Pause Slider On Hover Over Slide', 'monospace-slides' ),
				'id'      => 'mnsp-slider-pause-hover',
				'default' => 'pause',
				'type'    => 'checkbox',
			),
			array(
				'label'   => esc_html__( 'Autoplay', 'monospace-slides' ),
				'id'      => 'mnsp-slider-autoplay',
				'default' => 'autoplay',
				'type'    => 'checkbox',
			),
			array(
				'label'   => esc_html__( 'Aspect Ratio', 'monospace-slides' ),
				'id'      => 'mnsp-slider-aspect',
				'default' => 'wide',
				'type'    => 'radio',
				'options' => array(
					'wide'    => esc_html__( 'Wide 16:9', 'monospace-slides' ),
					'classic' => esc_html__( 'Classic 4:3', 'monospace-slides' ),
					'square'  => esc_html__( 'Square 1:1', 'monospace-slides' ),
				),
			),
		);

	}

	/**
	 * Loops through all the defined fields and builds the HTML needed to show each field.
	 *
	 * @since 1.0.0
	 * @param string $taxonomy    The taxonomy being used.
	 */
	public function create_fields( $taxonomy ) {

		$output = '';

		foreach ( $this->meta_fields() as $meta_field ) {

			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';

			$meta_value = $meta_field['default'];

			switch ( $meta_field['type'] ) {
				case 'checkbox':
					$input = sprintf(
						'<input id="%s" name="%s" type="checkbox" value="%s" %s>',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						checked( $meta_value, $meta_value, false )
					);
					break;
				case 'radio':
					$input  = '<fieldset>';
					$input .= '<legend class="screen-reader-text">' . $meta_field['label'] . '</legend>';

					foreach ( $meta_field['options'] as $key => $value ) {
						$input .= sprintf(
							'<label><input id="%s" name="%s" type="radio" value="%s" %s> %s</label>%s',
							$meta_field['id'],
							$meta_field['id'],
							$key,
							checked( $meta_value, $key, false ),
							$value,
							end( array_keys( $meta_field['options'] ) ) !== $key ? '<br>' : ''
						);
					}

					$input .= '</fieldset>';
					break;
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$meta_field['id'],
						$meta_field['id']
					);

					foreach ( $meta_field['options'] as $key => $value ) {
						$input .= sprintf(
							'<option value="%s" %s>%s</option>',
							$key,
							selected( $meta_value, $key, false ),
							$value
						);
					}

					$input .= '</select>';
					break;
				case 'number':
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" value="%s">',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
					break;
				default:
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" value="%s">',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}

			$output .= '<div class="form-field">' . $this->format_rows( $label, $input ) . '</div>';

		}

		wp_kses( $output, Monospace_Slides::expanded_alowed_tags() );
	}

	/**
	 * Manages the editing and updating of the metadata fields.
	 *
	 * @since 1.0.0
	 * @param string $term        The taxonomy temr being used.
	 * @param string $taxonomy    The taxonomy being used.
	 */
	public function edit_fields( $term, $taxonomy ) {

		wp_nonce_field( 'monospace_slides_admin_termmeta_data', 'monospace_slides_admin_termmeta_nonce' );

		$output = '';

		foreach ( $this->meta_fields() as $meta_field ) {

			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';

			$meta_value = get_term_meta( $term->term_id, $meta_field['id'], true );

			if ( 'checkbox' !== $meta_field['type'] && empty( $meta_value ) ) {
				if ( isset( $meta_field['default'] ) ) {
					$meta_value = $meta_field['default'];
				} else {
					$meta_value = '';
				}
			}

			switch ( $meta_field['type'] ) {
				case 'checkbox':
					$input = sprintf(
						'<input id="%s" name="%s" type="checkbox" value="%s" %s>',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['default'],
						checked( $meta_field['default'], $meta_value, false )
					);
					break;
				case 'radio':
					$input  = '<fieldset>';
					$input .= '<legend class="screen-reader-text">' . $meta_field['label'] . '</legend>';

					foreach ( $meta_field['options'] as $key => $value ) {
						$input .= sprintf(
							'<label><input id="%s" name="%s" type="radio" value="%s" %s> %s</label>%s',
							$meta_field['id'],
							$meta_field['id'],
							$key,
							checked( $meta_value, $key, false ),
							$value,
							end( array_keys( $meta_field['options'] ) ) !== $key ? '<br>' : ''
						);
					}

					$input .= '</fieldset>';
					break;
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$meta_field['id'],
						$meta_field['id']
					);

					foreach ( $meta_field['options'] as $key => $value ) {
						$input .= sprintf(
							'<option value="%s" %s>%s</option>',
							$key,
							selected( $meta_value, $key, false ),
							$value
						);
					}

					$input .= '</select>';
					break;
				case 'number':
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" value="%s">',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
					break;
				default:
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" value="%s">',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}

			$output .= $this->format_rows( $label, $input );

		}

		echo '<div class="form-field">' . wp_kses( $output, Monospace_Slides::expanded_alowed_tags() ) . '</div>';

	}

	/**
	 * Formats each row of metadata options.
	 *
	 * @since 1.0.0
	 * @param string $label    The label for the input.
	 * @param string $input    The input being used.
	 */
	public function format_rows( $label, $input ) {

		return '<tr class="form-field"><th>' . $label . '</th><td>' . $input . '</td></tr>';

	}

}
