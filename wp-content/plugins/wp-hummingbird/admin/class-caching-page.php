<?php

class WP_Hummingbird_Caching_Page extends WP_Hummingbird_Admin_Page {

	/**
	 * Run Performance, Minification, Uptime...
	 *
	 * @param string $type
     * @since 1.4.5
	 */
	private function run_actions( $type ) {

		check_admin_referer( 'wphb-run-caching' );

		if ( ! current_user_can( wphb_get_admin_capability() ) )
			return;

		if ( 'cf-deactivate' === $type ) {
			wphb_cloudflare_disconnect();
			wp_redirect( remove_query_arg( array( 'run', '_wpnonce' ) ) );
			exit;
		}
	}

	public function render_header() {
        ?>
        <?php if ( ! wphb_is_htaccess_written( 'caching' ) ): ?>
            <div class="wphb-notice wphb-notice-success hidden" id="wphb-notice-code-snippet-updated">
                <p><?php _e( 'Code snippet updated', 'wphb' ); ?></p>
            </div>
        <?php endif; ?>

		<div class="wphb-notice wphb-notice-error <?php echo ! isset( $_GET['htaccess-error'] ) ? 'hidden' : ''; ?>" id="wphb-notice-code-snippet-htaccess-error">
			<p><?php _e( 'Hummingbird could not update or write your .htaccess file. Please, make .htaccess writable or paste the code yourself.', 'wphb' ); ?></p>
		</div>

		<div class="wphb-notice wphb-notice-success hidden" id="wphb-notice-code-snippet-htaccess-updated">
			<p><?php _e( 'Apache <strong>.htaccess</strong> file updated. Please, wait while Hummingbird recheck expirations...', 'wphb' ); ?></p>
		</div>

        <div class="wphb-notice wphb-notice-success hidden" id="wphb-notice-cloudflare-purge-cache">
            <p><?php _e( 'CloudFlare cache successfully purged. Please wait 30 seconds for the purge to complete.', 'wphb' ); ?></p>
        </div>

        <?php
        if ( isset( $_GET['caching-updated'] ) && ! isset( $_GET['htaccess-error'] ) ) {
	        if ( wphb_is_htaccess_written( 'caching' ) ) {
		        $this->show_notice( 'updated', __( 'Your .htaccess file has been updated', 'wphb' ), 'success', true );
            } else {
		        $this->show_notice( 'updated', __( 'Code snippet updated', 'wphb' ), 'success', true );
            }
        }

        if ( isset( $_GET['cache-enabled'] ) ) {
			$this->show_notice( 'updated', __( 'Browser cache enabled. Your .htaccess file has been updated', 'wphb' ), 'success', true );
        }

		if ( isset( $_GET['cache-disabled'] ) ) {
			$this->show_notice( 'updated', __( 'Browser cache disabled. Your .htaccess file has been updated', 'wphb' ), 'success', true );
        }

		parent::render_header(); // TODO: Change the autogenerated stub
	}

	public function register_meta_boxes() {
		$redirect = false;

		if ( isset( $_GET['enable'] ) && current_user_can( wphb_get_admin_capability() ) ) {
			// Enable caching in htaccess (only for apache servers)
			$result = wphb_save_htaccess( 'caching' );
			if ( $result ) {
				wphb_get_caching_status( true );
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-disabled', 'htaccess-error' ) );
				$redirect_to = add_query_arg( 'cache-enabled', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
			else {
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-enabled', 'cache-disabled' ) );
				$redirect_to = add_query_arg( 'htaccess-error', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
		}

		if ( isset( $_GET['disable'] ) && current_user_can( wphb_get_admin_capability() ) ) {
			// Disable caching in htaccess (only for apache servers)
			$result = wphb_unsave_htaccess( 'caching' );
			if ( $result ) {
				wphb_get_caching_status( true );
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-enabled', 'htaccess-error' ) );
				$redirect_to = add_query_arg( 'cache-disabled', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
			else {
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-enabled', 'cache-disabled' ) );
				$redirect_to = add_query_arg( 'htaccess-error', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
		}

		if ( isset( $_GET['run'] ) && current_user_can( wphb_get_admin_capability() ) ) {
			// Force a refresh of the data
			wphb_get_caching_status( true );
			$redirect = true;
		}

		if ( isset( $_GET['run'] ) && isset( $_GET['type'] ) ) {
			$this->run_actions( $_GET['type'] );
		}

		if ( $redirect ) {
			wp_redirect( remove_query_arg( array( 'run', 'enable', 'disable', 'htaccess-error', 'cache-disabled', 'cache-enabled' ) ) );
			exit;
		}

		$disable_enable_button = ! wphb_is_htaccess_written( 'caching' ) && $this->is_caching_fully_enabled();
		$footer_class = $disable_enable_button ? '' : 'box-footer buttons buttons-on-left';
		$this->add_meta_box( 'caching-summary', __( 'Summary', 'wphb' ), array( $this, 'caching_summary_metabox' ), array( $this, 'caching_summary_metabox_header' ), null, 'box-caching-left', array( 'box_content_class' => 'box-content side-padding' ) );
		$this->add_meta_box( 'caching-enable', __( 'Enable Caching', 'wphb' ), array( $this, 'caching_enable_metabox' ), array( $this, 'caching_enable_metabox_header' ), array( $this, 'caching_enable_metabox_footer'), 'box-caching-right', array( 'box_footer_class' => $footer_class) );
		$this->add_meta_box( 'caching-cloudflare', __( 'CloudFlare', 'wphb' ), array( $this, 'caching_cloudflare_metabox' ), array( $this, 'caching_cloudflare_header' ), null, 'box-caching-right', array( 'box_class' => 'dev-box content-box content-box-one-col-center') );
	}


	protected function render_inner_content() {
		$server_name = wphb_get_server_type();
		$server_type = array_search( $server_name, wphb_get_servers() );
		$this->view( $this->slug . '-page', array( 'server_type' => $server_type, 'server_name' => $server_name ) );
	}


	public function caching_summary_metabox() {
		$options = wphb_get_settings();
		$expires = array(
			'css' => $options['caching_expiry_css'],
			'javascript' => $options['caching_expiry_javascript'],
			'media' => $options['caching_expiry_media'],
			'images' => $options['caching_expiry_images'],
		);

		$recommended = wphb_get_recommended_caching_values();

		$results = wphb_get_caching_status();
		if ( false === $results ) {
			// Force only when we don't have any data yet
			$results = wphb_get_caching_status( true );
		}
		$human_results = array_map( 'wphb_human_read_time_diff', $results );

		$external_problem = false;
		$htaccess_written = wphb_is_htaccess_written( 'caching' );
		if ( $htaccess_written && in_array( false, $results ) ) {
			$external_problem = true;
		}

		/** @var WP_Hummingbird_Module_Cloudflare $cf_module */
		$cf_module = wphb_get_module( 'cloudflare' );
		$cf_active = false;
		$cf_current_human = '';
		$cf_tooltip = '';
		$cf_current = '';
		if ( $cf_module->is_active() && $cf_module->is_connected() && $cf_module->is_zone_selected() ) {
			$cf_active = true;
			$cf_current = $cf_module->get_caching_expiration();
			if ( is_wp_error( $cf_current ) ) {
				$cf_current = '';
			}

			$cf_tooltip = $cf_current == 691200 ? __('Caching is enabled', 'wphb') : __('Caching is enabled but you aren\'t using our recommended value', 'wphb');
			$cf_current_human = wphb_human_read_time_diff( $cf_current );
		}

		$args = compact( 'expires', 'results', 'recommended', 'external_problem', 'human_results', 'cf_active', 'cf_tooltip', 'cf_current_human', 'cf_current' );
		$this->view( 'caching/summary-meta-box', $args );
	}

	public function caching_summary_metabox_header() {
		$recheck_url = add_query_arg( 'run', 'true' );
		$this->view( 'caching/summary-meta-box-header', array( 'recheck_url' => $recheck_url, 'title' => __( 'Summary', 'wphb' ) ) );
	}

	public function caching_enable_metabox() {
		$snippets = array(
			'apache' => wphb_get_code_snippet( 'caching', 'apache' ),
			'litespeed' => wphb_get_code_snippet( 'caching', 'LiteSpeed' ),
			'nginx' => wphb_get_code_snippet( 'caching', 'nginx' ),
			'iis' => wphb_get_code_snippet( 'caching', 'iis' ),
			'iis-7' => wphb_get_code_snippet( 'caching', 'iis-7' ),
		);

		$htaccess_written = wphb_is_htaccess_written( 'caching' );
		$htaccess_writable = wphb_is_htaccess_writable();
		$already_enabled = $this->is_caching_fully_enabled() && ! wphb_is_htaccess_written( 'caching' );

		$this->view( 'caching/enable-meta-box', array( 'snippets' => $snippets, 'htaccess_written' => $htaccess_written, 'htaccess_writable' => $htaccess_writable, 'already_enabled' => $already_enabled ) );
	}

	public function caching_enable_metabox_header() {
		$this->view( 'caching/enable-meta-box-header', array( 'gzip_server_type' => wphb_get_server_type(), 'title' => __( 'Enable Caching', 'wphb' ) ) );
	}

	public function caching_enable_metabox_footer() {
		$disable_enable_button = ! wphb_is_htaccess_written( 'caching' ) && $this->is_caching_fully_enabled();
		$enable_link = add_query_arg( array( 'run' => 'true', 'enable' => 'true' ) );
		$disable_link = add_query_arg( array( 'run' => 'true', 'disable' => 'true' ) );

		$cf_active = wphb_cloudflare_is_active();

		$args = array(
			'server_type' => wphb_get_server_type(),
            'enable_link' => $enable_link,
            'disable_link' => $disable_link,
            'disable_enable_button' => $disable_enable_button,
            'cloudflare_enabled' => $cf_active,
        );

		$this->view( 'caching/enable-meta-box-footer', $args );
	}

	public function is_caching_fully_enabled() {
		$recommended = wphb_get_recommended_caching_values();

		$results = wphb_get_caching_status();
		if ( false === $results ) {
			// Force only when we don't have any data yet
			$results = wphb_get_caching_status( true );
		}

		$result_sum = 0;

		foreach ( $results as $key => $result ) {
			if ( $result >= $recommended[ $key ]['value'] ) {
				$result_sum++;
			}
		}

		return $result_sum === count( $results );

	}

	/**
	 * CLOUDFLARE
	 */
	public function caching_cloudflare_metabox() {
		$this->view( 'caching/cloudflare-meta-box' );
	}

	/**
	 * Display Cloudflare header
     *
     * @since 1.4.5
	 */
	public function caching_cloudflare_header() {
	    $title = __( 'CloudFlare', 'wphb' );
		$deactivate_url = add_query_arg( array(
			'type' => 'cf-deactivate',
			'run' => 'true'
		));
		$deactivate_url = wp_nonce_url( $deactivate_url, 'wphb-run-caching' ) . '#wphb-box-dashboard-cloudflare';

		$cf_active = wphb_cloudflare_is_active();

		$this->view( 'caching/cloudflare-meta-box-header', compact( 'title', 'deactivate_url', 'cf_active' ) );
    }

}