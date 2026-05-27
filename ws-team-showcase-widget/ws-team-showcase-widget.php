<?php
/**
 * Plugin Name: WS Team Showcase Widget
 * Description: Custom Elementor widget for displaying responsive, searchable, filterable, and popup-enabled team member showcase cards. All rights reserved by Rahat Hoque. Contact: rahat.dev007@gmail.com.
 * Version: 0.1.0
 * Author: Rahat Hoque
 * Text Domain: ws-team-showcase-widget
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WS_TEAM_SHOWCASE_VERSION', '0.1.0' );
define( 'WS_TEAM_SHOWCASE_FILE', __FILE__ );
define( 'WS_TEAM_SHOWCASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'WS_TEAM_SHOWCASE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Main plugin bootstrap.
 */
final class WS_Team_Showcase_Plugin {

	/**
	 * Plugin singleton instance.
	 *
	 * @var self|null
	 */
	private static $instance = null;

	/**
	 * Get plugin instance.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Register hooks.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize plugin after WordPress loads plugins.
	 */
	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'elementor_missing_notice' ) );
			return;
		}

		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'wp_ajax_ws_team_showcase_filter', array( $this, 'ajax_filter_members' ) );
		add_action( 'wp_ajax_nopriv_ws_team_showcase_filter', array( $this, 'ajax_filter_members' ) );
	}

	/**
	 * Register frontend assets.
	 */
	public function register_assets() {
		wp_register_style(
			'ws-team-showcase',
			WS_TEAM_SHOWCASE_URL . 'assets/css/frontend.css',
			array(),
			WS_TEAM_SHOWCASE_VERSION
		);

		wp_register_script(
			'ws-team-showcase',
			WS_TEAM_SHOWCASE_URL . 'assets/js/frontend.js',
			array(),
			WS_TEAM_SHOWCASE_VERSION,
			true
		);

		wp_localize_script(
			'ws-team-showcase',
			'wsTeamShowcase',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'ws_team_showcase_filter' ),
			)
		);
	}

	/**
	 * Filter team members via AJAX.
	 */
	public function ajax_filter_members() {
		check_ajax_referer( 'ws_team_showcase_filter', 'nonce' );

		$search      = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
		$designation = isset( $_POST['designation'] ) ? sanitize_text_field( wp_unslash( $_POST['designation'] ) ) : '';
		$items       = isset( $_POST['items'] ) && is_array( $_POST['items'] ) ? wp_unslash( $_POST['items'] ) : array();
		$matches     = array();
		$search      = strtolower( $search );
		$designation = strtolower( $designation );

		foreach ( $items as $item ) {
			if ( ! is_array( $item ) || ! isset( $item['index'] ) ) {
				continue;
			}

			$item_index       = absint( $item['index'] );
			$item_name        = isset( $item['name'] ) ? strtolower( sanitize_text_field( $item['name'] ) ) : '';
			$item_designation = isset( $item['designation'] ) ? strtolower( sanitize_text_field( $item['designation'] ) ) : '';
			$item_department  = isset( $item['department'] ) ? strtolower( sanitize_text_field( $item['department'] ) ) : '';
			$item_bio         = isset( $item['bio'] ) ? strtolower( sanitize_text_field( $item['bio'] ) ) : '';
			$haystack         = $item_name . ' ' . $item_designation . ' ' . $item_department . ' ' . $item_bio;

			if ( '' !== $designation && $designation !== $item_designation ) {
				continue;
			}

			if ( '' !== $search && false === strpos( $haystack, $search ) ) {
				continue;
			}

			$matches[] = $item_index;
		}

		wp_send_json_success(
			array(
				'matches' => $matches,
			)
		);
	}

	/**
	 * Register Elementor widgets.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		require_once WS_TEAM_SHOWCASE_PATH . 'includes/widgets/class-ws-team-showcase-widget.php';

		$widgets_manager->register( new \WS_Team_Showcase_Widget() );
	}

	/**
	 * Admin notice shown when Elementor is not active.
	 */
	public function elementor_missing_notice() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		printf(
			'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
			esc_html__( 'WS Team Showcase Widget requires Elementor to be installed and active.', 'ws-team-showcase-widget' )
		);
	}
}

WS_Team_Showcase_Plugin::instance();
