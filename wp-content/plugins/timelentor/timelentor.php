<?php
/*
 * Plugin Name: Timelentor - Timeline Layouts for Elementor
 * Description: Timeline Layouts for Elementor showcase your timeline in the best way. It is an effective and user-friendly way to beautify website with timeline concept.
 * Plugin URI: https://www.coderkart.com/downloads/timelentor
 * Author: Coderkart Technologies
 * Version: 1.0
 * Author URI: https://www.coderkart.com
 * Text Domain: timelentor

 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/*
 * Define Plugin URL and Directory Path
 */
define('TMLE_URL', plugins_url('/', __FILE__));  // Define Plugin URL
define('TMLE_PATH', plugin_dir_path(__FILE__));  // Define Plugin Directory Path
define('TMLE_DOMAIN', 'timelentor'); // Define Text Domain
define('TMLE_SITE', home_url()); 
define('TMLE_NAME', 'Timelentor');
/**
 * Main Plugin timelentor-for-elementor class.
 * 
 * @access public
 * @since  1.0
 */
if (!class_exists('TMLE_Timelentor')) :
    class TMLE_Timelentor {
    
    /**
     * TMLE constructor.
     * The main plugin actions registered for WordPress
     * 
     * @access public
     * @since  1.0
    */
    public function __construct() {
        $this->hooks();
        require_once TMLE_PATH . 'widgets/elementor-helper.php';
        require_once TMLE_PATH . 'widgets/elementor-dependency.php';
    }

    /**
	* Initialize
	*/
	public function hooks() {
		// Add Elementor Widgets if plugin activate
		add_action('elementor/widgets/register', array($this, 'tmle_widget_register'));
		add_action('wp_enqueue_scripts', array($this, 'tmle_widget_script_register'));
        add_action('plugins_loaded', array($this, 'tmle_plugin_load'));
	}
	
	/*
	 * Register the widgets file in elementor widgets.
	 */
	public function tmle_widget_register() {
		require_once TMLE_PATH . 'widgets/timelentor-widget.php';
	}
	
	/**
	 * Load scripts and styles
	 */
	public function tmle_widget_script_register() { 
		wp_enqueue_style('tmle-style', TMLE_URL . 'assets/css/timelentor.css');
		wp_enqueue_style('slick', TMLE_URL . 'assets/css/slick.css');
		wp_enqueue_style('slick-theme', TMLE_URL . 'assets/css/slick-theme.css');
		wp_enqueue_script('tmle-script', TMLE_URL . 'assets/js/tmle-custom.js', array('jquery'), time(), true);		
		wp_enqueue_script('slick', TMLE_URL . 'assets/js/slick.js', array('jquery'), time(), true);
	}

	/*
	 * Check for Elementor
	 */
	public function tmle_plugin_load() {
		// Load plugin textdomain
		load_plugin_textdomain( TMLE_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', array($this, 'tmle_widget_fail_load'));
			return;
		} 
	}

	/*
	 * This notice will appear if Elementor is not installed or activated or both
	 */
	public function tmle_widget_fail_load() {
		$screen = get_current_screen();
		if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
			return;
		}

		$plugin = 'elementor/elementor.php';

		if (tmle_elementor_installed()) {
			if (!current_user_can('activate_plugins')) {
				return;
			}
			$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);

			$message = '<p><strong>' . esc_html__('Timelentor', TMLE_DOMAIN).'</strong>'. esc_html__(' not working because you need to activate the Elementor plugin.', TMLE_DOMAIN) . '</p>';
			$message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', TMLE_DOMAIN)) . '</p>';
		} else {
			if (!current_user_can('install_plugins')) {
				return;
			}

			$install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

			$message = '<p><strong>' . esc_html__('Timelentor', TMLE_DOMAIN).'</strong>'. esc_html__(' not working because you need to install the Elementor plugin', TMLE_DOMAIN) . '</p>';
			$message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', TMLE_DOMAIN)) . '</p>';
		}

		echo '<div class="error"><p>' . $message . '</p></div>';
	}

	
}
endif;

/**
 * Initialize Plugin Class
 *
 * @access public
 * @since  1.0
 */
new TMLE_Timelentor();
