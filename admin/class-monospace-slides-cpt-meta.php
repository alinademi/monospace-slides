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

	/**
	 * Defines the fields of the meta box.
	 *
	 * @since 1.0.0
	 */
	public function meta_fields() {

		return array(
			array(
				'label'       => esc_html__( 'Title', 'monospace-slides' ),
				'id'          => 'mnsp-slide-title',
				'placeholder' => esc_html__( 'The title for the current slide.', 'monospace-slides' ),
				'type'        => 'text',
			),
			array(
				'label'   => esc_html__( 'Title Text Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-title-color',
				'default' => '#000000',
				'type'    => 'color',
			),
			array(
				'label'       => esc_html__( 'Subtitle', 'monospace-slides' ),
				'id'          => 'mnsp-slide-subtitle',
				'placeholder' => esc_html__( 'The subtitle for the current slide.', 'monospace-slides' ),
				'type'        => 'text',
			),
			array(
				'label'   => esc_html__( 'Subtitle Text Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-subtitle-color',
				'default' => '#000000',
				'type'    => 'color',
			),
			array(
				'label'       => esc_html__( 'Description', 'monospace-slides' ),
				'id'          => 'mnsp-slide-desc',
				'placeholder' => esc_html__( 'The description of the current slide.', 'monospace-slides' ),
				'type'        => 'textarea',
			),
			array(
				'label'   => esc_html__( 'Description Text Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-desc-color',
				'default' => '#000000',
				'type'    => 'color',
			),
			array(
				'label'       => esc_html__( 'Call To Action Text', 'monospace-slides' ),
				'id'          => 'mnsp-slide-cta-text',
				'placeholder' => esc_html__( 'The text for the Call To Action button.', 'monospace-slides' ),
				'type'        => 'text',
			),
			array(
				'label'   => esc_html__( 'Call To Action Text Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-cta-text-color',
				'default' => '#ffffff',
				'type'    => 'color',
			),
			array(
				'label'   => esc_html__( 'Call To Action Background Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-cta-bg-color',
				'default' => '#000000',
				'type'    => 'color',
			),
			array(
				'label'   => esc_html__( 'Call To Action Hover Background Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-cta-hover-bg-color',
				'default' => '#777777',
				'type'    => 'color',
			),
			array(
				'label'       => esc_html__( 'Call To Action URL', 'monospace-slides' ),
				'id'          => 'mnsp-slide-cta-url',
				'placeholder' => esc_html__( 'http://', 'monospace-slides' ),
				'type'        => 'url',
			),
			array(
				'label'   => esc_html__( 'Open Call To Action URL In A New Window', 'monospace-slides' ),
				'id'      => 'mnsp-slide-cta-target',
				'default' => 'target',
				'type'    => 'checkbox',
			),
			array(
				'label' => esc_html__( 'Image', 'monospace-slides' ),
				'id'    => 'mnsp-slide-image',
				'type'  => 'media',
			),
			array(
				'label'   => esc_html__( 'Horizontal Alignment', 'monospace-slides' ),
				'id'      => 'mnsp-slide-horiz-align',
				'default' => 'center',
				'type'    => 'select',
				'options' => array(
					'left'   => esc_attr__( 'Left', 'monospace-slides' ),
					'center' => esc_attr__( 'Center', 'monospace-slides' ),
					'right'  => esc_attr__( 'Right', 'monospace-slides' ),
				),
			),
			array(
				'label'   => esc_html__( 'Aspect Ratio', 'monospace-slides' ),
				'id'      => 'mnsp-slide-ratio',
				'default' => 'wide',
				'type'    => 'select',
				'options' => array(
					'wide'    => esc_attr__( 'Wide', 'monospace-slides' ),
					'classic' => esc_attr__( 'Classic', 'monospace-slides' ),
					'square'  => esc_attr__( 'Square', 'monospace-slides' ),
				),
			),
			array(
				'label'   => esc_html__( 'Featured Image Opacity', 'monospace-slides' ),
				'id'      => 'mnsp-slide-featured-opacity',
				'default' => '1',
				'type'    => 'range',
				'options' => array(
					'min'  => '0.1',
					'max'  => '1',
					'step' => '0.1',
				),
			),
			array(
				'label'   => esc_html__( 'Background Color', 'monospace-slides' ),
				'id'      => 'mnsp-slide-bg-color',
				'default' => '#000000',
				'type'    => 'color',
			),
		);

	}

	/**
	 * Loops through all the defined fields and builds the HTML needed to show each field.
	 *
	 * @since 1.0.0
	 * @param object $post    The post object.
	 */
	public function field_generator( $post ) {

		$output = '';

		foreach ( $this->meta_fields() as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';

			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );

			if ( 'checkbox' !== $meta_field['type'] && empty( $meta_value ) ) {
				if ( isset( $meta_field['default'] ) ) {
					$meta_value = $meta_field['default'];
				} else {
					$meta_value = '';
				}
			}

			switch ( $meta_field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input id="%s" name="%s" type="text" value="%s"><input class="button monospace_slides_admin_metabox-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				case 'checkbox':
					$input = sprintf(
						'<input id="%s" name="%s" type="checkbox" value="%s" %s>',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['default'],
						checked( $meta_field['default'], $meta_value, false )
					);
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
				case 'range':
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" min="%s" max="%s" step="%s" value="%s">',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_field['options']['min'],
						$meta_field['options']['max'],
						$meta_field['options']['step'],
						$meta_value
					);
					break;
				case 'textarea':
					$input = sprintf(
						'<textarea %s id="%s" name="%s" rows="5" placeholder="%s">%s</textarea>',
						'style="width: 100%"',
						$meta_field['id'],
						$meta_field['id'],
						isset( $meta_field['placeholder'] ) ? $meta_field['placeholder'] : '',
						$meta_value
					);
					break;
				case 'color':
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
						'<input %s id="%s" name="%s" type="%s" placeholder="%s" value="%s">',
						'style="width: 100%"',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						isset( $meta_field['placeholder'] ) ? $meta_field['placeholder'] : '',
						$meta_value
					);
			}

			$output .= $this->format_rows( $label, $input );

		}

		echo '<table class="monospace-slides-admin-metabox-form form-table"><tbody>' . wp_kses( $output, Monospace_Slides::expanded_alowed_tags() ) . '</tbody></table>';

	}

	/**
	 * Formats each row of the metabox
	 *
	 * @since    1.0.0
	 * @param string $label    The label of the field.
	 * @param string $input    The input of the field.
	 */
	public function format_rows( $label, $input ) {

		return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';

	}

	/**
	 * Saves the information from the meta box fields into the database.
	 *
	 * @since 1.0.0
	 * @param int $post_id    The id of the post.
	 */
	public function save_fields( $post_id ) {

		if ( ! isset( $_POST['monospace_slides_admin_metabox_nonce'] ) ) {
			return $post_id;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['monospace_slides_admin_metabox_nonce'] ) ), 'monospace_slides_admin_metabox_data' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		foreach ( $this->meta_fields() as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'text':
						$meta_value = sanitize_text_field( wp_unslash( $_POST[ $meta_field['id'] ] ) );
						break;
					case 'textarea':
						$meta_value = sanitize_textarea_field( wp_unslash( $_POST[ $meta_field['id'] ] ) );
						break;
					default:
						$meta_value = sanitize_meta( $meta_field['id'], wp_unslash( $_POST[ $meta_field['id'] ] ), 'post' );
				}

				update_post_meta( $post_id, $meta_field['id'], $meta_value );
			} elseif ( 'checkbox' === $meta_field['type'] ) {
				delete_post_meta( $post_id, $meta_field['id'] );
			}
		}

	}

}
