<?php

/** @var WPMUDEVSnapshot_New_Ui_Tester $this */

if ( isset( $_GET['dropbox-authorize'] ) && wp_verify_nonce( sanitize_text_field( $_GET['dropbox-authorize'] ), 'snapshot-destination-dropbox-authorize' ) ) {
	$item = get_option( 'snapshot-dropbox-tokens' );
}


if ( isset( $_REQUEST['dropbox-authenticated'] ) && $_REQUEST['dropbox-authenticated'] && get_option( 'snapshot-dropbox-tokens' ) ) {
	$item = get_option( 'snapshot-dropbox-tokens' );
}

$item = array_merge( array(
	'name' => '',
	'directory' => '',
), $item );

// Store the Token - Request as hidden fields
if ( isset( $item['tokens']['request']['token'] ) ) { ?>

	<input type="hidden" name="snapshot-destination[tokens][request][token]" value="<?php echo esc_attr( $item['tokens']['request']['token'] ); ?>">

<?php }

if ( isset( $item['tokens']['request']['token_secret'] ) ) { ?>

	<input type="hidden" name="snapshot-destination[tokens][request][token_secret]" value="<?php echo esc_attr( $item['tokens']['request']['token_secret'] ); ?>">

<?php }

// Store the Token - Access as hidden fields
if ( isset( $item['tokens']['access']['token'] ) ) { ?>

	<input type="hidden" name="snapshot-destination[tokens][access][token]" value="<?php echo esc_attr( $item['tokens']['access']['token'] ); ?>">

<?php }

if ( isset( $item['tokens']['access']['token_secret'] ) ) { ?>

	<input type="hidden" name="snapshot-destination[tokens][access][token_secret]" value="<?php echo esc_attr( $item['tokens']['access']['token_secret'] ); ?>">

<?php } ?>

<div class="form-content">

	<div id="wps-destination-type" class="form-row">

		<div class="form-col-left">
			<label><?php esc_html_e( 'Type', SNAPSHOT_I18N_DOMAIN ); ?></label>
		</div>

		<div class="form-col">
			<i class="wps-typecon dropbox"></i>
			<label><?php esc_html_e( 'Dropbox', SNAPSHOT_I18N_DOMAIN ); ?></label>
		</div>

	</div>

	<div id="wps-destination-name" class="form-row">
		<div class="form-col-left">
			<label for="snapshot-destination-name">
				<?php esc_html_e( 'Name', SNAPSHOT_I18N_DOMAIN ); ?> <span class="required">*</span>
			</label>
		</div>

		<div class="form-col upload-progress">
			<input type="text" class="inline<?php $this->input_error_class( 'name' ); ?>" name="snapshot-destination[name]" id="snapshot-destination-name"
			       value="<?php echo esc_attr( stripslashes( $item['name'] ) ); ?>">
			<?php $this->input_error_message( 'name' ); ?>
		</div>

	</div>

	<?php if ( isset( $item['tokens']['access']['token'] ) ) : ?>

		<div id="wps-destination-dir" class="form-row">
			<div class="form-col-left">
				<label for="snapshot-destination-directory">
					<?php esc_html_e( 'Directory', SNAPSHOT_I18N_DOMAIN ); ?> <span class="required">*</span>
				</label>
			</div>

			<div class="form-col">
				<input type="text" class="<?php $this->input_error_class( 'directory' ); ?>" name="snapshot-destination[directory]" id="snapshot-destination-directory" value="<?php
					echo esc_attr( stripslashes( $item['directory'] ) ); ?>">
				<?php $this->input_error_message( 'directory' ); ?>
			</div>
		</div>

		<div id="wps-destination-auth" class="form-row">
			<div class="form-col-left">
				<label><?php esc_html_e( 'Authenticated', SNAPSHOT_I18N_DOMAIN ); ?></label>
			</div>

			<div class="form-col">

				<?php

				$auth_error = false;

				if ( isset( $_GET['dropbox-authorize'] ) && wp_verify_nonce( sanitize_text_field( $_GET['dropbox-authorize'] ), 'snapshot-destination-dropbox-authorize' ) ) { ?>

				<div class="wps-auth-message wps-notice">
					<p><?php esc_html_e( "You've authenticated this Dropbox destination. To finish adding this destination, please specify a folder to store the snapshots in and click Save Destination.", SNAPSHOT_I18N_DOMAIN ); ?></p>
				</div>

				<?php } else {

					try {
						$item_object->load_library();
						$destinationClasses = WPMUDEVSnapshot::instance()->get_setting( 'destinationClasses' );
						$destinationClass = $destinationClasses[ $item['type'] ];
						$item_object->oauth = new Dropbox_OAuth_PEAR( $destinationClass->get_app_key(), $destinationClass->get_app_secret() );
						$item_object->oauth->setToken( $item['tokens']['access'] );
						$item_object->dropbox = new Dropbox_API( $item_object->oauth, Dropbox_API::ROOT_SANDBOX );
						$account_info = $item_object->dropbox->getAccountInfo();
					} catch ( Dropbox_Exception_Forbidden $e ) {
						$auth_error = true;
						echo '<p>', esc_html__( 'An error occurred when attempting to connect to Dropbox: ', SNAPSHOT_I18N_DOMAIN ), '</p>';
						printf( '<div class="wps-auth-message error"><p>%s</p></div>', $e->getMessage() );
					}

					if ( ! $auth_error ) { ?>

					<div class="wps-auth-message success">
						<p><?php esc_html_e( 'This destination is authenticated and ready for use.', SNAPSHOT_I18N_DOMAIN ); ?></p>
					</div>

					<?php }

				} ?>

				<p><small><?php esc_html_e("You can re-authenticate at any time if you wish to change this destination's details.", SNAPSHOT_I18N_DOMAIN); ?></small></p>

				<div class="wps-label--checkbox">
					<div class="wps-input--checkbox">
						<input type="checkbox" name="snapshot-destination[force-authorize]" id="snapshot-destination-force-authorize"<?php checked( $auth_error ); ?>>
						<label for="snapshot-destination-force-authorize"></label>
					</div>

					<label for="snapshot-destination-force-authorize"><?php esc_html_e('Force Re-Authorize with Dropbox', SNAPSHOT_I18N_DOMAIN); ?></label>
				</div>

			</div>
		</div>

		<?php if ( isset( $account_info ) && $account_info ) : ?>

			<div id="wps-destination-account" class="form-row">

				<div class="form-col-left">
					<label><?php esc_html_e( 'Account', SNAPSHOT_I18N_DOMAIN ); ?></label>
				</div>

				<div class="form-col">
					<table cellpadding="0" cellspacing="0">
						<tbody>

							<?php if ( isset( $account_info['display_name'] ) ) : ?>
								<tr>
									<th><?php esc_html_e('Name', SNAPSHOT_I18N_DOMAIN); ?></th>

									<td>
									<?php echo esc_html( $account_info['display_name'] ); ?>
									<input type="hidden" name="snapshot-destination[account_info][display_name]" value="<?php echo esc_attr( $account_info['display_name'] ); ?>">
									</td>

								</tr>

								<tr>

									<th><?php esc_html_e('Email', SNAPSHOT_I18N_DOMAIN); ?></th>

									<td>
									<?php echo esc_html( $account_info['email'] ); ?>
									<input type="hidden" name="snapshot-destination[account_info][email]" value="<?php echo esc_attr( $account_info['email'] ); ?>">
									</td>

								</tr>

							<?php endif ; ?>

							<?php if ( isset( $account_info['uid'] ) ) : ?>
								<tr>

									<th><?php esc_html_e('UID', SNAPSHOT_I18N_DOMAIN); ?></th>

									<td>
									<?php echo esc_html( $account_info['uid'] ); ?>
									<input type="hidden" name="snapshot-destination[account_info][uid]" value="<?php echo esc_attr( $account_info['uid'] ); ?>" />
									</td>

								</tr>
							<?php endif ; ?>

							<?php if ( isset( $account_info['country'] ) ) : ?>
								<tr>

									<th><?php esc_html_e('Country', SNAPSHOT_I18N_DOMAIN); ?></th>
									<td>
									<?php echo esc_html( $account_info['country'] ); ?>
									<input type="hidden" name="snapshot-destination[account_info][country]" value="<?php echo esc_attr( $account_info['country'] ); ?>" />
									</td>

								</tr>
							<?php endif ; ?>

						</tbody>

					</table>

				</div>

			</div>

			<div id="wps-destination-storage" class="form-row">

				<div class="form-col-left">

					<label><?php esc_html_e( 'Storage Used', SNAPSHOT_I18N_DOMAIN ); ?></label>

				</div>

				<div class="form-col">

					<p><?php echo number_format( intval( $account_info['quota_info']['normal'] ) / intval( $account_info['quota_info']['quota'] ) * 100, 2, '.', '' ); ?>%</p>
					<input type="hidden" name="snapshot-destination[account_info][quota_info][normal]" value="<?php echo esc_attr( $account_info['quota_info']['normal'] ); ?>"/>
					<input type="hidden" name="snapshot-destination[account_info][quota_info][quota]" value="<?php echo esc_attr( $account_info['quota_info']['quota'] ); ?>"/>

				</div>

			</div>

		<?php endif;

		else :
			// clear out the Dropbox tokens if we are not up to that stage
			delete_option( 'snapshot-dropbox-tokens' );

			?>

		<div id="wps-destination-auth" class="form-row">

			<div class="form-col-left">

				<label><?php esc_html_e( 'Authenticated', SNAPSHOT_I18N_DOMAIN ); ?></label>

			</div>

			<div class="form-col">

				<div class="wps-auth-message error">
					<p><?php esc_html_e( 'This destination is not authenticated yet.', SNAPSHOT_I18N_DOMAIN ); ?></p>
				</div>

				<p><small><?php esc_html_e( 'The first step in the Dropbox setup is Authorizing Snapshot to communicate with your Dropbox account. Dropbox requires that you grant Snapshot access to your account. This is required in order for Snapshot to upload files to your Dropbox account.', SNAPSHOT_I18N_DOMAIN ); ?></small></p>

				<input type="hidden" name="snapshot-destination[force-authorize]" id="snapshot-destination-force-authorize" value="on">
			</div>

		</div>

	<?php endif; ?>

	<input type="hidden" name="snapshot-destination[type]" id="snapshot-destination-type" value="<?php echo esc_attr( $item['type'] ); ?>">

</div>
