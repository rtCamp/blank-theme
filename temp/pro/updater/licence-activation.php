<?php
/**
 * Responsible for updating the theme.
 * Important : Do not change any values here, Instead go to udpater-settings.php and change.
 */
function blank_theme_handle_theme_update()
{
    // retrieve our license key from the DB
    $license_key = trim( get_option( BLANK_THEME_PRO_PREFIX . '_license_key' ) );

    // setup the updater
    $edd_updater = new EDD_SL_Theme_Updater( array(
			'remote_api_url' => BLANK_THEME_PRO_REMOTE_URL,     // our store URL that is running EDD
			'version'        => BLANK_THEME_PRO_VERSION_NUMBER, // the current theme version we are running
			'item_name'      => BLANK_THEME_PRO_ITEM_NAME,    // the name of this theme
			'author'         => BLANK_THEME_PRO_AUTHOR,  // the author's name
			'license'        => $license_key, // the license key (used get_option above to retrieve from DB)
			'url'            => home_url()
        )
    );
}
add_action( 'admin_init', 'blank_theme_handle_theme_update' );

/***********************************************
* Add our menu item
***********************************************/

function blank_theme_license_menu() {
	add_theme_page( 'Theme License', 'Theme License', 'manage_options', 'themename-license', 'blank_theme_license_page' );
}
add_action('admin_menu', 'blank_theme_license_menu');

/***********************************************
* Sample settings page, substitute with yours
***********************************************/

function blank_theme_license_page() {
	$license 	= get_option( BLANK_THEME_PRO_PREFIX . '_license_key' );
	$status 	= get_option( BLANK_THEME_PRO_PREFIX . '_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e('Theme License Options', 'blank-theme'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields( BLANK_THEME_PRO_PREFIX . '_license'); ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key' , 'blank-theme' ); ?>
						</th>
						<td>
							<input id="<?php echo BLANK_THEME_PRO_PREFIX; ?>_license_key" name="<?php echo BLANK_THEME_PRO_PREFIX; ?>_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
							<label class="description" for="<?php echo BLANK_THEME_PRO_PREFIX; ?> _license_key"><?php _e('Enter your license key', 'blank-theme'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License', 'blank-theme'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e('active', 'blank-theme'); ?></span>
									<?php wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_theme_license_deactivate" value="<?php _e('Deactivate License', 'blank-theme'); ?>"/>
								<?php } else {
									wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_theme_license_activate" value="<?php _e('Activate License', 'blank-theme'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

		</form>
	<?php
}

function blank_theme_register_option() {
	// creates our settings in the options table
	register_setting( BLANK_THEME_PRO_PREFIX . '_license', BLANK_THEME_PRO_PREFIX . '_license_key', 'edd_theme_sanitize_license' );
}
add_action('admin_init', 'blank_theme_register_option');


/***********************************************
* Gets rid of the local license status option
* when adding a new one
***********************************************/

function edd_theme_sanitize_license( $new ) {
	$old = get_option( BLANK_THEME_PRO_PREFIX . '_license_key' );
	if( $old && $old != $new ) {
		delete_option( BLANK_THEME_PRO_PREFIX . '_license_key_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

/***********************************************
* Illustrates how to activate a license key.
***********************************************/

function blank_theme_activate_license() {

	if( isset( $_POST['edd_theme_license_activate'] ) ) {
	 	if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( get_option( BLANK_THEME_PRO_PREFIX . '_license_key' ) );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license' => $license,
			'item_name' => urlencode( BLANK_THEME_PRO_ITEM_NAME )
		);

		$response = wp_remote_get( add_query_arg( $api_params, BLANK_THEME_PRO_REMOTE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( BLANK_THEME_PRO_PREFIX . '_license_key_status', $license_data->license );

	}
}
add_action('admin_init', 'blank_theme_activate_license');

/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function blank_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_theme_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( BLANK_THEME_PRO_PREFIX . '_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( BLANK_THEME_PRO_ITEM_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, BLANK_THEME_PRO_REMOTE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( BLANK_THEME_PRO_PREFIX . '_license_key_status' );

	}
}
add_action('admin_init', 'blank_theme_deactivate_license');



/***********************************************
* Illustrates how to check if a license is valid
***********************************************/

function blank_theme_check_license() {

	global $wp_version;

	$license = trim( get_option( BLANK_THEME_PRO_PREFIX . '_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( BLANK_THEME_PRO_ITEM_NAME )
	);

	$response = wp_remote_get( add_query_arg( $api_params, BLANK_THEME_PRO_REMOTE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}
