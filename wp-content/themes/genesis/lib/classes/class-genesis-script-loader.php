<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Assets
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

/**
 * Script loader class.
 *
 * @since 2.5.0
 *
 * @package Genesis\Assets
 */
class Genesis_Script_Loader {

	/**
	 * Holds script file name suffix.
	 *
	 * @since 2.5.0
	 *
	 * @var string suffix
	 */
	private $suffix = '';

	/**
	 * Hook into WordPress.
	 *
	 * @since 2.5.0
	 */
	public function add_hooks() {

		// Register scripts early to allow replacement by plugin/child theme.
		add_action( 'wp_enqueue_scripts',    array( $this, 'register_front_scripts' ), 0 );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ), 0 );

		// Enqueue the scripts.
		add_action( 'wp_enqueue_scripts',    array( $this, 'enqueue_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'maybe_enqueue_admin_scripts' ) );

	}

	/**
	 * Register front end scripts used by Genesis.
	 *
	 * @since 2.5.0
	 */
	public function register_front_scripts() {

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$this->suffix = '.min';
		}

		wp_register_script( 'superfish', GENESIS_JS_URL . "/menu/superfish{$this->suffix}.js", array( 'jquery', 'hoverIntent', ), '1.7.5', true );
		wp_register_script( 'superfish-args', apply_filters( 'genesis_superfish_args_url', GENESIS_JS_URL . "/menu/superfish.args{$this->suffix}.js" ), array( 'superfish' ), PARENT_THEME_VERSION, true );
		wp_register_script( 'superfish-compat', GENESIS_JS_URL . "/menu/superfish.compat{$this->suffix}.js", array( 'jquery' ), PARENT_THEME_VERSION, true );
		wp_register_script( 'skip-links', GENESIS_JS_URL . '/skip-links.js', array(), PARENT_THEME_VERSION, true );
		wp_register_script( 'drop-down-menu', GENESIS_JS_URL . '/drop-down-menu.js', array( 'jquery' ), PARENT_THEME_VERSION, true );
		wp_register_script( 'html5shiv', GENESIS_JS_URL . "/html5shiv{$this->suffix}.js", array(), '3.7.3' );

	}

	/**
	 * Register admin scripts used by Genesis.
	 *
	 * @since 2.5.0
	 */
	public function register_admin_scripts() {

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$this->suffix = '.min';
		}

		wp_register_script( 'genesis_admin_js', GENESIS_JS_URL . "/admin{$this->suffix}.js", array( 'jquery' ), PARENT_THEME_VERSION, true );

	}

	/**
	 * Enqueue the scripts used on the front-end of the site.
	 *
	 * Includes comment-reply, superfish and the superfish arguments.
	 *
	 * Applies the `genesis_superfish_enabled`, and `genesis_superfish_args_uri`. filter.
	 *
	 * @since 2.5.0
	 */
	public function enqueue_front_scripts() {

		// If a single post or page, threaded comments are enabled, and comments are open.
		if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// If superfish is enabled.
		if ( genesis_superfish_enabled() ) {

			wp_enqueue_script( 'superfish' );
			wp_enqueue_script( 'superfish-args' );

			// Load compatibility script if not running HTML5.
			if ( ! genesis_html5() ) {
				wp_enqueue_script( 'superfish-compat' );
			}

		}

		// If accessibility support enabled.
		if ( genesis_a11y( 'skip-links' ) ) {
			wp_enqueue_script( 'skip-links' );
		}

		// HTML5 shiv.
		wp_enqueue_script( 'html5shiv' );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	}

	/**
	 * Conditionally enqueue the scripts used in the admin.
	 *
	 * Includes Thickbox, theme preview and a Genesis script (actually enqueued in genesis_load_admin_js()).
	 *
	 * @since 2.5.0
	 *
	 * @param string $hook_suffix Admin page identifier.
	 */
	public function maybe_enqueue_admin_scripts( $hook_suffix ) {

		// Only add thickbox/preview if there is an update to Genesis available.
		if ( genesis_update_check() ) {

			add_thickbox();
			wp_enqueue_script( 'theme-preview' );
			$this->enqueue_and_localize_admin_scripts();
			return;

		}

		// If we're on a Genesis admin screen.
		if ( genesis_is_menu_page( 'genesis' ) || genesis_is_menu_page( 'seo-settings' ) || genesis_is_menu_page( 'design-settings' ) ) {

			$this->enqueue_and_localize_admin_scripts();
			return;

		}

		// If we're viewing an edit post page, make sure we need Genesis SEO JS.
		if (
			in_array( $hook_suffix, array( 'post-new.php', 'post.php' ), true )
			&& ! genesis_seo_disabled()
			&& post_type_supports( get_post_type(), 'genesis-seo' )
		) {
				$this->enqueue_and_localize_admin_scripts();
		}

	}

	/**
	 * Enqueues the custom script used in the admin, and localizes several strings or values used in the scripts.
	 *
	 * Applies the `genesis_toggles` filter to toggleable admin settings, so plugin developers can add their own without
	 * having to recreate the whole setup.
	 *
	 * @since 2.5.0
	 */
	public function enqueue_and_localize_admin_scripts() {

		wp_enqueue_script( 'genesis_admin_js' );

		$strings = array(
			'categoryChecklistToggle' => __( 'Select / Deselect All', 'genesis' ),
			'saveAlert'               => __( 'The changes you made will be lost if you navigate away from this page.', 'genesis' ),
			'confirmUpgrade'          => __( 'Updating Genesis will overwrite the current installed version of Genesis. Are you sure you want to update?. "Cancel" to stop, "OK" to update.', 'genesis' ),
			'confirmReset'            => __( 'Are you sure you want to reset?', 'genesis' ),
		);

		wp_localize_script( 'genesis_admin_js', 'genesisL10n', $strings );

		$toggles = array(
			// Checkboxes - when checked, show extra settings.
			'update'                    => array( '#genesis-settings\\[update\\]', '#genesis_update_notification_setting', '_checked' ),
			'content_archive_thumbnail' => array( '#genesis-settings\\[content_archive_thumbnail\\]', '#genesis_image_extras', '_checked' ),
			// Checkboxes - when unchecked, show extra settings.
			'semantic_headings'         => array( '#genesis-seo-settings\\[semantic_headings\\]', '#genesis_seo_h1_wrap', '_unchecked' ),
			// Select toggles.
			'nav_extras'                => array( '#genesis-settings\\[nav_extras\\]', '#genesis_nav_extras_twitter', 'twitter' ),
			'content_archive'           => array( '#genesis-settings\\[content_archive\\]', '#genesis_content_limit_setting', 'full' ),
		);

		wp_localize_script( 'genesis_admin_js', 'genesis_toggles', apply_filters( 'genesis_toggles', $toggles ) );

	}
}
