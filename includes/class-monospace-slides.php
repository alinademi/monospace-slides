<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.mikeinmonospace.com/
 * @since      1.0.0
 *
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Monospace_Slides
 * @subpackage Monospace_Slides/includes
 * @author     Mike In Monospace <mikeinmonospace@gmail.com>
 */
class Monospace_Slides {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Monospace_Slides_Loader $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		if ( defined( 'MONOSPACE_SLIDES_VERSION' ) ) {
			$this->version = MONOSPACE_SLIDES_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->plugin_name = 'monospace-slides';

		$this->load_dependencies();
		$this->set_locale();

		$this->define_admin_hooks();
		$this->define_cpt_hooks();
		$this->define_tax_hooks();
		$this->define_metabox_hooks();
		$this->define_term_meta_hooks();
		$this->define_shortcodes_hooks();

		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Monospace_Slides_Loader    Orchestrates the hooks of the plugin.
	 * - Monospace_Slides_I18n      Defines internationalization functionality.
	 * - Monospace_Slides_Admin     Defines all hooks for the admin area.
	 * - Monospace_Slides_Public    Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-monospace-slides-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-monospace-slides-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-monospace-slides-admin.php';

		/**
		 * The class responsible for the functionality of the custom post type.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-monospace-slides-cpt.php';

		/**
		 * The class responsible for the functionality of the custom taxonomy.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-monospace-slides-tax.php';

		/**
		 * The class responsible for the functionality of the custom post type meta box.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-monospace-slides-cpt-meta.php';

		/**
		 * The class responsible for the functionality of the custom taxonomy term meta.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-monospace-slides-tax-meta.php';

		/**
		 * The class responsible for the functionality of the shortcodes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-monospace-slides-shortcodes.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-monospace-slides-public.php';

		$this->loader = new Monospace_Slides_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Monospace_Slides_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function set_locale() {

		$plugin_i18n = new Monospace_Slides_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Monospace_Slides_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to registering and managing a custom post type
	 * as well as customizing the admin columns.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_cpt_hooks() {

		$plugin_cpt = new Monospace_Slides_CPT();

		$this->loader->add_action( 'init', $plugin_cpt, 'new_cpt_slide' );

		$this->loader->add_filter( 'manage_edit-mnsp_slide_columns', $plugin_cpt, 'add_slide_columns' );
		$this->loader->add_filter( 'manage_mnsp_slide_posts_custom_column', $plugin_cpt, 'add_slide_columns_content', 10, 2 );

	}

	/**
	 * Register all of the hooks related to registering a custom taxonomy.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_tax_hooks() {

		$plugin_tax = new Monospace_Slides_TAX();

		$this->loader->add_action( 'init', $plugin_tax, 'new_tax_slider' );

	}

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_metabox_hooks() {

		$plugin_metaboxes = new Monospace_Slides_CPT_Meta( $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_metaboxes, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_metaboxes, 'enqueue_scripts' );

		$this->loader->add_action( 'add_meta_boxes', $plugin_metaboxes, 'add_meta_boxes' );

		$this->loader->add_action( 'save_post', $plugin_metaboxes, 'save_fields' );

	}

	/**
	 * Register all of the hooks related to taxonomy term meta
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_term_meta_hooks() {

		$plugin_term_meta = new Monospace_Slides_TAX_Meta();

		if ( is_admin() ) {
			$this->loader->add_action( 'mnsp_slider_add_form_fields', $plugin_term_meta, 'create_fields', 10, 2 );
			$this->loader->add_action( 'mnsp_slider_edit_form_fields', $plugin_term_meta, 'edit_fields', 10, 2 );
			$this->loader->add_action( 'created_mnsp_slider', $plugin_term_meta, 'save_fields', 10, 1 );
			$this->loader->add_action( 'edited_mnsp_slider', $plugin_term_meta, 'save_fields', 10, 1 );
		}

	}

	/**
	 * Register all the hooks needed for shortcodes functionality
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function define_shortcodes_hooks() {

		$plugin_shortcodes = new Monospace_Slides_Shortcodes();

		$this->loader->add_action( 'init', $plugin_shortcodes, 'register_slide_shortcode' );
		$this->loader->add_action( 'init', $plugin_shortcodes, 'register_slider_shortcode' );

		$this->loader->add_filter( 'manage_edit-mnsp_slide_columns', $plugin_shortcodes, 'add_slide_columns' );
		$this->loader->add_filter( 'manage_mnsp_slide_posts_custom_column', $plugin_shortcodes, 'add_slide_columns_content', 10, 2 );

		$this->loader->add_filter( 'manage_edit-mnsp_slider_columns', $plugin_shortcodes, 'add_slider_columns' );
		$this->loader->add_filter( 'manage_mnsp_slider_custom_column', $plugin_shortcodes, 'add_slider_columns_content', 10, 3 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_public_hooks() {

		$plugin_public = new Monospace_Slides_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Defines the allowed HTML tags and attributes.
	 *
	 * @since 1.0.0
	 */
	public static function expanded_alowed_tags() {
		$my_allowed = wp_kses_allowed_html( 'post' );

		$my_allowed['input'] = array(
			'class'       => array(),
			'id'          => array(),
			'name'        => array(),
			'value'       => array(),
			'type'        => array(),
			'style'       => array(),
			'min'         => array(),
			'max'         => array(),
			'step'        => array(),
			'checked'     => array(),
			'placeholder' => array(),
		);

		$my_allowed['textarea'] = array(
			'class'       => array(),
			'id'          => array(),
			'name'        => array(),
			'style'       => array(),
			'rows'        => array(),
			'cols'        => array(),
			'placeholder' => array(),
		);

		$my_allowed['select'] = array(
			'class' => array(),
			'id'    => array(),
			'name'  => array(),
			'type'  => array(),
		);

		$my_allowed['option'] = array(
			'selected' => array(),
			'value'    => array(),
		);

		$my_allowed['style'] = array(
			'type' => array(),
		);

		return $my_allowed;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since  1.0.0
	 * @return Monospace_Slides_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since  1.0.0
	 * @return string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
