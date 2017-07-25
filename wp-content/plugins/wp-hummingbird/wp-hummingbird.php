<?php
/**
Plugin Name: Hummingbird Pro
Version: 1.5.5
Plugin URI:  https://premium.wpmudev.org/project/wp-hummingbird/
Description: Hummingbird zips through your site finding new ways to make it load faster, from file compression and minification to browser caching – because when it comes to pagespeed, every millisecond counts.
Author: WPMU DEV
Author URI: http://premium.wpmudev.org
Network: true
Text Domain: wphb
Domain Path: /languages/
WDP ID: 1081721
 */

/*
Copyright 2007-2016 Incsub (http://incsub.com)
Author – Ignacio Cruz (igmoweb), Ricardo Freitas (rtbfreitas)
Contributors –

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 – GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

if ( ! defined( 'WPHB_VERSION' ) ) {
	define( 'WPHB_VERSION', '1.5.5' );
}

if ( file_exists( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'free-mods.php' ) ) {
	include_once( 'free-mods.php' );
}

if ( defined( 'WPHB_WPORG' ) && WPHB_WPORG && 'wp-hummingbird/wp-hummingbird.php' != plugin_basename( __FILE__ ) ) {
	// Add notice to rate the free version.
	$free_installation = get_site_option( 'wphb-free-install-date' );
	if ( empty( $free_installation ) ) {
		update_site_option( 'wphb-notice-free-rated-show', 'yes' );
		update_site_option( 'wphb-free-install-date', current_time( 'timestamp' ) );
	}

	// This plugin is the free version so if the Pro version is activated we need to deactivate this one.
	if ( ! function_exists( 'is_plugin_active' ) ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$pro_installed = get_plugins( '/wp-hummingbird' );

	// Check if the pro version exists and is activated.
	if ( is_plugin_active( 'wp-hummingbird/wp-hummingbird.php' ) ) {
		// Pro is activated, deactivate this one.
		deactivate_plugins( plugin_basename( __FILE__ ) );
		update_site_option( 'wphb-notice-free-deactivated-show', 'yes' );
		return;
	} elseif ( ! empty( $pro_installed ) ) {
		// Pro is installed but not activated, let's activate it.
		deactivate_plugins( plugin_basename( __FILE__ ) );
		activate_plugin( 'wp-hummingbird/wp-hummingbird.php' );
	}
}

/**
 * Class WP_Hummingbird
 *
 * Main Plugin class. Acts as a loader of everything else and intializes the plugin
 */
if ( ! class_exists( 'WP_Hummingbird' ) ) {
	class WP_Hummingbird {

		/**
		 * Plugin instance
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Admin main class
		 *
		 * @var WP_Hummingbird_Admin
		 */
		public $admin;

		/**
		 * @var WP_Hummingbird_Core
		 */
		public $core;

		/**
		 * Return the plugin instance
		 *
		 * @return WP_Hummingbird
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}


			return self::$instance;
		}

		public function __construct() {
			$this->includes();
			$this->init();

			// Load PRO side if it's available
			$loaded = wphb_load_pro();
			if ( $loaded ) {
				// Load cron module
				//$this->core->load_module( __( 'Cron', 'wphb' ), 'cron' );
				$this->pro = new WP_Hummingbird_Pro();
				$this->pro->init();
			}

			if ( is_admin() ) {
				add_action( 'admin_init', array( 'WP_Hummingbird_Installer', 'maybe_upgrade' ) );

				if ( is_multisite() ) {
					add_action( 'admin_init', array( 'WP_Hummingbird_Installer', 'maybe_upgrade_blog' ) );
				}
			}

			$this->load_textdomain();

			add_action( 'init', array( $this, 'maybe_clear_all_cache' ) );

			// This file should not exist in the official release. Just for development.
			if ( defined( 'WPHB_SAMPLE_DEV' ) && file_exists( wphb_plugin_dir() . '/sample-dev/sample-dev.php' ) ) {
				include_once( wphb_plugin_dir() . '/sample-dev/sample-dev.php' );
			}
		}

		public function maybe_clear_all_cache() {
			if ( isset( $_GET['wphb-clear'] ) && current_user_can( wphb_get_admin_capability() ) ) {
				wphb_flush_cache();

				delete_site_option( 'wphb-last-report-score' );
				delete_site_option( 'wphb-stop-report' );
				delete_site_option( 'wphb-last-report' );
				delete_site_option( 'wphb-doing-report' );

				if ( 'all' === $_GET['wphb-clear'] ) {
					wphb_update_settings( wphb_get_default_settings() );
					delete_option( 'wphb-quick-setup' );
				}

				if ( wphb_is_htaccess_written( 'gzip' ) ) {
					wphb_unsave_htaccess( 'gzip' );
				}

				if ( wphb_is_htaccess_written( 'caching' ) ) {
					wphb_unsave_htaccess( 'caching' );
				}


				wp_redirect( remove_query_arg( 'wphb-clear' ) );
				exit;
			}
		}

		private function load_textdomain() {
			load_plugin_textdomain( 'wphb', false, 'wp-hummingbird/languages' );
		}

		/**
		 * Load needed files for the plugin
		 */
		private function includes() {
			// Core files
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'core/class-installer.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'core/class-core.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'core/integration.php' );

			// Helpers files
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-core.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-cache.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-settings.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-modules.php' );

			if ( is_admin() ) {
				// Load only admin files
				/** @noinspection PhpIncludeInspection */
				include_once( wphb_plugin_dir() . 'admin/class-admin.php' );
			}

			// Dashboard Shared UI Library
			require_once( wphb_plugin_dir() . 'externals/shared-ui/plugin-ui.php' );
		}

		/**
		 * Initialize the plugin
		 */
		private function init() {
			// Initialize the plugin core
			$this->core = new WP_Hummingbird_Core();

			if ( is_admin() ) {
				// Initialize admin core files
				$this->admin = new WP_Hummingbird_Admin();
			}


			/**
			 * Triggered when WP Hummingbird is totally loaded
			 */
			do_action( 'wp_hummingbird_loaded' );
		}
	}
}


if ( ! function_exists( 'wp_hummingbird' ) ) {
	function wp_hummingbird() {
		return WP_Hummingbird::get_instance();
	}

	/**
	 * Init the plugin and load the plugin instance for the first time
	 */
	add_action( 'plugins_loaded', 'wp_hummingbird' );
}

if ( ! function_exists( 'wphb_get_current_user_info' ) ) {
	/**
	 * Get Current username info
	 */
	function wphb_get_current_user_info() {

		$current_user = wp_get_current_user();

		if ( !($current_user instanceof WP_User) )
			return false;

		if ( ! empty( $current_user->user_firstname ) ) { // First we try to grab user First Name
			$display_name = $current_user->user_firstname;
		} else { // Grab user nicename
			$display_name = $current_user->user_nicename;
		}

		return $display_name;

	}
}

if ( ! function_exists( 'wphb_plugin_url' ) ) {
	/**
	 * Return WP Hummingbird plugin URL
	 *
	 * @return string
	 */
	function wphb_plugin_url() {
		return trailingslashit( plugin_dir_url( __FILE__ ) );
	}
}

if ( ! function_exists( 'wphb_plugin_dir' ) ) {
	/**
	 * Return WP Hummingbird plugin path
	 *
	 * @return string
	 */
	function wphb_plugin_dir() {
		return trailingslashit( plugin_dir_path( __FILE__ ) );
	}
}

if ( ! function_exists( 'wphb_activate' ) ) {
	/**
	 * Activate the plugin
	 */
	function wphb_activate() {
		if ( ! class_exists( 'WP_Hummingbird_Installer' ) ) {
			include_once( 'core/class-installer.php' );
		}
		WP_Hummingbird_Installer::activate();
	}
	register_activation_hook( __FILE__, 'wphb_activate' );
}




if ( ! function_exists( 'wphb_deactivate' ) ) {
	/**
	 * Deactivate the plugin
	 */
	function wphb_deactivate() {
		if ( ! class_exists( 'WP_Hummingbird_Installer' ) ) {
			include_once( 'core/class-installer.php' );
		}
		WP_Hummingbird_Installer::deactivate();
	}

	register_deactivation_hook( __FILE__, 'wphb_deactivate' );
}