<?php
/**
 * @author: WPMUDEV, Ignacio Cruz (igmoweb)
 * @version:
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Hummingbird_Installer' ) ) {
	/**
	 * Class WP_Hummingbird_Installer
	 *
	 * Manages activation/deactivation and upgrades of Hummingbird
	 */
	class WP_Hummingbird_Installer {

		/**
		 * Plugin activation
		 */
		public static function activate() {
			if ( ! defined( 'WPHB_ACTIVATING' ) ) {
				define( 'WPHB_ACTIVATING', true );
			}

			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-core.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-settings.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-cache.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-modules.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'core/class-abstract-module.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'core/modules/class-module-uptime.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'core/modules/class-module-cloudflare.php' );

			// Check if Uptime is active in the server
			if ( wphb_is_uptime_remotely_enabled() ) {
				wphb_uptime_enable_locally();
			}
			else {
				wphb_uptime_disable_locally();
			}

			update_site_option( 'wphb_version', WPHB_VERSION );

			wphb_has_cloudflare( true );

			do_action( 'wphb_activate' );
		}

		/**
		 * Plugin activation in a blog (if the site is a multisite)
		 */
		public static function activate_blog() {
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-core.php' );
			/** @noinspection PhpIncludeInspection */
			include_once( wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-cache.php' );

			update_option( 'wphb_version', WPHB_VERSION );

			do_action( 'wphb_deactivate' );
		}

		/**
		 * Plugin deactivation
		 */
		public static function deactivate() {
			wphb_flush_cache( false );
			delete_site_option( 'wphb_version' );
			delete_option( 'wphb_cache_folder_error' );
			delete_site_option( 'wphb-last-report' );
			delete_site_option( 'wphb-last-report-score' );
			delete_site_option( 'wphb-server-type' );
			delete_site_transient( 'wphb-uptime-last-report' );
			delete_site_transient( 'wphb-uptime-remotely-enabled' );
			delete_site_option( 'wphb-is-cloudflare' );
			wphb_cloudflare_disconnect();
			delete_site_option( 'wphb-notice-free-deactivated-dismissed' );

			if ( wp_next_scheduled( 'wphb_minify_clear_files' ) ) {
				wp_clear_scheduled_hook( 'wphb_minify_clear_files' );
			}

			do_action( 'wphb_deactivate' );
		}

		/**
		 * Plugin upgrades
		 */
		public static function maybe_upgrade() {
			if ( defined( 'WPHB_ACTIVATING' ) ) {
				// Avoid to execute this over an over in same thread execution.
				return;
			}

			if ( defined( 'WPHB_UPGRADING' ) && WPHB_UPGRADING ) {
				return;
			}

			self::upgrade();
		}

		public static function upgrade() {
			$version = get_site_option( 'wphb_version' );

			if ( false === $version ) {
				self::activate();
				if ( ! is_multisite() ) {
					self::activate_blog();
				}
			}

			if ( is_multisite() ) {
				$blog_version = get_option( 'wphb_version' );
				if ( false === $blog_version ) {
					self::activate_blog();
				}
			}

			if ( $version != WPHB_VERSION ) {

				if ( ! defined( 'WPHB_UPGRADING' ) ) {
					define( 'WPHB_UPGRADING', true );
				}

				if ( version_compare( $version, '1.0-RC-7', '<' ) ) {
					delete_site_option( 'wphb-server-type' );
				}

				if ( version_compare( $version, '1.1', '<' ) ) {
					$options = wphb_get_settings();
					$defaults = wphb_get_default_settings();

					if ( isset ( $options['caching_expiry_css/javascript'] ) ) {
						$options['caching_expiry_css'] = $options['caching_expiry_css/javascript'];
						$options['caching_expiry_javascript'] = $options['caching_expiry_css/javascript'];
						unset( $options['caching_expiry_css/javascript'] );
					}
					else {
						$options['caching_expiry_css'] = $defaults['caching_expiry_css'];
						$options['caching_expiry_javascript'] = $defaults['caching_expiry_javascript'];
					}

					wphb_update_settings( $options );
					$module = new WP_Hummingbird_Module_Caching( 'caching', 'caching' );
					$module->get_analysis_data( true );
				}

				if ( version_compare( $version, '1.1.1', '<' ) ) {
					$options = wphb_get_setting( 'network_version' );
					if ( empty( $options ) ) {
						wphb_update_settings( wphb_get_default_settings() );
					}
				}

				if ( version_compare( $version, '1.3', '<' ) ) {
					wphb_has_cloudflare( true );
				}

				if ( version_compare( $version, '1.4', '<' ) ) {
					self::upgrade_1_4();
				}

				if ( version_compare( $version, '1.5', '<' ) ) {
					self::upgrade_1_5();
				}

				if ( version_compare( $version, '1.5.1-beta2', '<' ) ) {
					self::upgrade_1_5_1_beta_2();
				}

				if ( version_compare( $version, '1.5.3', '<' ) ) {
					self::upgrade_1_5_3();
				}

				if ( version_compare( $version, '1.5.4.beta.1', '<' ) ) {
					self::upgrade_1_5_4_beta_1();
				}

				if ( version_compare( $version, '1.5.4', '<' ) ) {
					self::upgrade_1_5_4();
				}

				if ( version_compare( $version, '1.5.5', '<' ) ) {
					self::upgrade_1_5_5();
				}

				update_site_option( 'wphb_version', WPHB_VERSION );
			} // End if().
		}

		/**
		 * Upgrades a single blog in a multisite
		 */
		public static function maybe_upgrade_blog() {
			// 1.3.9 is the first version when blog upgrades are executed
			$version = get_option( 'wphb_version', '1.3.9' );

			if ( WPHB_VERSION === $version ) {
				return;
			}

			if ( version_compare( $version, '1.4', '<' ) ) {
				self::upgrade_1_4();
			}

			if ( version_compare( $version, '1.5', '<' ) ) {
				self::upgrade_1_5();
			}

			if ( version_compare( $version, '1.5.4.beta.1', '<' ) ) {
				self::upgrade_1_5_4_beta_1();
			}

			if ( version_compare( $version, '1.5.4.beta.2', '<' ) ) {
				self::upgrade_1_5_4_beta_2();
			}

			update_option( 'wphb_version', WPHB_VERSION );
		}

		private static function upgrade_1_4() {
			global $wpdb;

			//Drop chart table
			$chart_table = $wpdb->prefix . 'minification_chart';
			$wpdb->query( "DROP TABLE $chart_table" );
			if ( ! function_exists( 'wphb_clear_minification_cache' ) ) {
				include_once wphb_plugin_dir() . 'helpers/wp-hummingbird-helpers-cache.php';
			}

			wphb_clear_minification_cache();

			// Move all those assets in header to default position
			$options = wphb_get_settings();
			$options['position'];

			unset( $options['max_files_in_group'] );

			wphb_update_settings( $options );

			delete_option( 'wphb_cache_folder_error' );
		}

		private static function upgrade_1_5() {
			// Move dont_combine list to a new combine list instead

			$options = wphb_get_settings();
			if ( ! isset( $options['dont_combine'] ) ) {
				return;
			}

			$dont_combine = $options['dont_combine'];
			unset( $options['dont_combine'] );

			$collection = wphb_minification_get_resources_collection();

			$options['combine'] = array( 'styles' => array(), 'scripts' => array() );
			foreach ( $dont_combine as $type => $handles ) {
				$options['combine'][ $type ] = array();
				$type_collection = wp_list_pluck( $collection[ $type ], 'handle' );
				foreach ( $type_collection as $type_handle ) {
					if ( ! in_array( $type_handle, $handles ) ) {
						$options['combine'][ $type ][] = $type_handle;
					}
				}
			}
			wphb_update_settings( $options );
		}

		private static function upgrade_1_5_1_beta_2() {
			// Transform recipient user IDs to email/names array
			$recipients = wphb_get_setting( 'email-recipients' );
			$new_recipients = array();
			foreach ( $recipients as $recipient ) {
				if ( is_array( $recipient ) ) {
					$new_recipients[] = $recipient;
					continue;
				}
				elseif ( is_int( $recipient ) ) {
					$user = get_user_by( 'id', $recipient );
					if ( ! $user ) {
						continue;
					}

					$new_recipients[] = array(
						'name' => wphb_get_display_name( $user->ID ),
						'email' => $user->user_email
					);
				}
			}

			wphb_update_setting( 'email-recipients', $new_recipients );
		}

		/**
		 * Upgrade to version 1.5.3.
		 *
		 * @since 1.5.3
		 */
		private static function upgrade_1_5_3() {
			// Welcome box deprecated since 1.5.0.
			delete_metadata( 'user', '', 'wphb-hide-welcome-box', '', true );
		}

		private static function upgrade_1_5_4_beta_1() {
			$options = wphb_get_settings();

			$scripts = array( 'jquery', 'jquery-migrate', 'jquery-core' );

			foreach ( $scripts as $script ) {
				// Remove jQuery from minification options
				$blocked = array_search( $script, $options['block']['scripts'] );
				if ( false !== $blocked ) {
					unset( $options['block']['scripts'][ $blocked ] );
					$options['block']['scripts'] = array_values( $options['block']['scripts'] );
				}
				$dont_minify = array_search( $script, $options['dont_minify']['scripts'] );
				if ( false !== $dont_minify ) {
					unset( $options['dont_minify']['scripts'][ $dont_minify ] );
					$options['dont_minify']['scripts'] = array_values( $options['dont_minify']['scripts'] );
				}
				$combine = array_search( $script, $options['combine']['scripts'] );
				if ( false !== $combine ) {
					unset( $options['combine']['scripts'][ $combine ] );
					$options['combine']['scripts'] = array_values( $options['combine']['scripts'] );
				}

				if ( isset( $options['position']['scripts'][ $script ] ) ) {
					unset( $options['position']['scripts'][ $script ] );
				}
			}

			wphb_update_settings( $options );
		}

		private static function upgrade_1_5_4() {
			// Delete old minification options
			delete_option( 'wphb-minification-check-files' );
			delete_option( 'wphb-minification-check-files-progress' );
		}

		private static function upgrade_1_5_5() {
			// Delete old minification options
			delete_option( 'wphb-minification-check-files' );
			delete_option( 'wphb-minification-check-files-progress' );
		}


		private static function upgrade_1_5_4_beta_2() {
			wphb_clear_minification_cache( false );
		}

	}
}