<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page General Tab
 * 
 * The code for the plugins settings page general tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for dropdown field
$woo_slg_email_notification_option = array( 
	'wordpress' 	=> __('Wordpress','wooslg'), 
	'woocommerce' 	=> __('WooCommerce','wooslg') 
);
$positions = array( 'top' => __('Above Login/Register form','wooslg'),
		 'bottom' => __('Below Login/Register form','wooslg'),
		 'hook' => __('Custom Hook','wooslg') );

$all_pages = get_pages( array( 
		'post_type' => 'page',
		'posts_page_page' => -1,
		'post_staus' => 'publish'
	) );

$peepso_avatar_each_style = ( empty( $woo_slg_allow_peepso_avatar ) || $woo_slg_allow_peepso_avatar != 'yes') ? ' display:none;':'';
$peepso_cover_each_style = ( empty( $woo_slg_allow_peepso_cover ) || $woo_slg_allow_peepso_cover != 'yes') ? ' display:none;':'';
$woo_slg_social_btn_position = ( empty( $woo_slg_social_btn_position ) ) ? 'bottom':$woo_slg_social_btn_position;

$woo_slg_social_hooks_container = ( $woo_slg_social_btn_position == 'hook' ) ? '':'display:none';
$woo_slg_social_btn_hooks = ( !empty( $woo_slg_social_btn_hooks ) ) ? $woo_slg_social_btn_hooks : array();

$role = !empty( $woo_slg_options['woo_slg_default_role'] ) ? $woo_slg_options['woo_slg_default_role'] : 'subscriber';

?>
<!-- beginning of the general settings meta box -->
<div id="woo-slg-general" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="general">
			<div class="postbox">

				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
				<!-- general settings box title -->
				<h3 class="hndle">
					<span style='vertical-align: top;'><?php _e( 'General Settings', 'wooslg' ); ?></span>
				</h3>

				<div class="inside">
					
					<table class="form-table">
						<tbody>
							<?php
							
								// do action for add setting before general settings
								do_action( 'woo_slg_before_general_setting', $woo_slg_options );

								//check WooCommerce is activated or not
								if( class_exists( 'Woocommerce' ) ) {
								?>
	
								<tr valign="top">
									<th scope="row">
										<label for="woo_slg_email_notification_type"><?php echo __( 'New Account Email Template:', 'wooslg' ); ?></label>
									</th>
									<td>
										<select name="woo_slg_email_notification_type" id="woo_slg_email_notification_type" class="wslg-select" style="max-width: 90%; width: 350px;">
											<?php foreach ( $woo_slg_email_notification_option as $key => $option ) { ?>
												<option value="<?php echo $key; ?>" <?php selected( $woo_slg_email_notification_type, $key ); ?>>
													<?php esc_html_e( $option ); ?>
												</option>
											<?php } ?>
										</select><br />
										<span class="description"><?php echo '<br />'. __('Choose new account email notification type. This option allows you to choose whether you want to send either WordPress or WooCommerce new account email, when user registers via social media.','wooslg'); ?></span>
									</td>
								</tr>
	
								<?php } ?>
							
							<tr>
								<th scope="row">
									<label for="woo_slg_default_role"><?php _e( 'New User Default Role:', 'wooslg' ); ?></label>
								</th>
								<td>
									<select name="woo_slg_default_role" id="woo_slg_default_role" class="wslg-select"><?php wp_dropdown_roles( $role ); ?></select>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_notification"><?php _e( 'New Account Email:', 'wooslg' );?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<input type="checkbox" id="woo_slg_enable_notification" name="woo_slg_enable_notification" value="1" <?php echo ($woo_slg_enable_notification=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_enable_notification"><?php echo __( 'Check this box, if you want to notify user when he gets registered by social media.', 'wooslg' ); ?></label>
										</li>				
										<li class="wooslg-settings-meta-box">
											<input type="checkbox" id="woo_slg_send_new_account_email_to_admin" name="woo_slg_send_new_account_email_to_admin" value="1" <?php echo ($woo_slg_send_new_account_email_to_admin=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_send_new_account_email_to_admin"><?php echo __( 'Check this box, if you want to notify admin when new user registers through social media.', 'wooslg' ); ?></label>
										</li>
									</ul>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_redirect_url"><?php _e( 'Redirect URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_redirect_url" type="text" class="regular-text" placeholder="<?php echo __( 'http://','wooslg'); ?>" name="woo_slg_redirect_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_redirect_url ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter a redirect URL for users after they login with social media. The URL must start with', 'wooslg' ).' http:// or https://'; ?></span>
									<?php echo sprintf( __( '%sPlease enter valid url %s. %s', 'wooslg' ), '<br/><span class="woo-slg-not-rec woo-slg-hide">','(i.e. http://www.example.com)', '</spna>'); ?>
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="woo_slg_base_reg_username"><?php _e( 'Autoregistered Usernames:', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<label><input type="radio" name="woo_slg_base_reg_username" value="" <?php echo ($woo_slg_base_reg_username=='') ? 'checked="checked"' : ''; ?>/>
											<?php echo __( 'Based on unique ID & random number ( i.e. woo_slg_123456 )', 'wooslg' ); ?></label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label><input type="radio" name="woo_slg_base_reg_username" value="realname" <?php echo ($woo_slg_base_reg_username=='realname') ? 'checked="checked"' : ''; ?>/>
											<?php echo __( 'Based on real name ( i.e. john_smith )', 'wooslg' ); ?></label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label><input type="radio" name="woo_slg_base_reg_username" value="emailbased" <?php echo ($woo_slg_base_reg_username=='emailbased') ? 'checked="checked"' : ''; ?>/>
											<?php echo __( 'Based on email ID ( i.e. john.smith@example.com to john_smith_example_com )', 'wooslg' ); ?></label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label><input type="radio" name="woo_slg_base_reg_username" value="realemailbased" <?php echo ($woo_slg_base_reg_username=='realemailbased') ? 'checked="checked"' : ''; ?>/>
											<?php echo __( 'Actual email ID ( i.e. john.smith@example.com to john.smith@example.com )', 'wooslg' ).'<br>'.__('<span class="woo-slg-warning-message">( <span class="woo-slg-not-rec">Not Recommended</span> : This may create compatibility issues with other third party plugins. )','wooslg'); ?></label>
										</li>
									</ul>
								</td>
							</tr>
							<!-- General Settings End -->
														
							<!-- Page Settings End --><?php
							
							// do action for add setting after general settings
							do_action( 'woo_slg_after_general_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div>

			<div class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
				<!-- general settings box title -->
				<h3 class="hndle">
					<span style='vertical-align: top;'><?php _e( 'Display Settings', 'wooslg' ); ?></span>
				</h3>

				<div class="inside">
					
					<!-- Display Settings Start -->
					<table class="form-table">
						<tbody>
							<?php
							
								// do action for add setting before display settings
								do_action( 'woo_slg_before_display_setting', $woo_slg_options );
							?>
							
							<tr>
								<th scope="row">
									<label><?php _e( 'Display Social Login buttons on:', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="checkbox" name="woo_slg_enable_wp_login_page" value="1" <?php echo ($woo_slg_enable_wp_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Check this box to add social login on Wordpress default login page.', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="checkbox" name="woo_slg_enable_wp_register_page" value="1" <?php echo ($woo_slg_enable_wp_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Check this box to add social login on Wordpress default register page.', 'wooslg' ); ?>
											</label>
										</li>
									</ul>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_login_heading"><?php _e( 'Social Login Title:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_login_heading" type="text" class="regular-text" name="woo_slg_login_heading" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_login_heading ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Social Login Title.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label><?php _e( 'Social Buttons Image/Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="radio" class="woo_slg_social_btn_change" name="woo_slg_social_btn_type" value="0" <?php echo ($woo_slg_social_btn_type=='0') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Use image as buttons', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="radio" class="woo_slg_social_btn_change" name="woo_slg_social_btn_type" value="1" <?php echo ($woo_slg_social_btn_type=='1') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Use text as buttons', 'wooslg' ); ?>
											</label>
										</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label><?php _e( 'Social Buttons Position:', 'wooslg' ); ?></label>
								</th>
								<td>
									<select class="woo_slg_social_btn_position wslg-select" name="woo_slg_social_btn_position" style="max-width: 90%; width: 350px;">
										<?php foreach( $positions as $key => $position ){?>
											<option value="<?php print $key; ?>" <?php selected($woo_slg_social_btn_position, $key, true); ?>><?php print $position; ?></option>
										<?php }?>
									</select><br>
									<span class="description"><?php echo __( 'Select the postion where you want to display the social login buttons. Select Custom Hook if you want to display on custom form.', 'wooslg' ); ?></span>
								</td>
							</tr>
							<tr id="woo-slg-social-btn-hooks-container" style="<?php print $woo_slg_social_hooks_container;?>">
								<th scope="row"><label><?php _e( 'Custom Hooks:', 'wooslg' ); ?></label></th>
								<td>
									<ul id="custom-hooks-container">
										<?php if( !empty( $woo_slg_social_btn_hooks ) ) {
												$hooks_count = 1;

												foreach ( $woo_slg_social_btn_hooks as $key => $hook) {?>
													<li class="woo-slg-social-btn-custom-hook">
														<input type="text" name="woo_slg_social_btn_hooks[]" class="woo-slg-social-btn-hook regular-text" value="<?php print $hook;?>">
														<?php if( $hooks_count > 1 ){?>
															<button class="woo-slg-remove-custom-hook" type="button">X</button>
														<?php }?>
													</li>
												<?php 
													$hooks_count++;
												}
											}
										else {?>
										<li class="woo-slg-social-btn-custom-hook">
											<input type="text" name="woo_slg_social_btn_hooks[]" class="woo-slg-social-btn-hook">
										</li>
										<?php } ?>
									</ul>
									<span class="description"><?php echo __( 'If your theme/plugin does provide custom hooks then you can enter the name of the hook here.', 'wooslg' ); ?></span>
									<br>
									<span class="description"><?php echo __( 'You can find more information about using hook in the <a href="https://wpweb.co.in/documents/woocommerce-social-login/social-login-setup-docs/#using-custom-hooks" target="_blank">manual</a>.', 'wooslg' ); ?></span>
									<br><br>
									<button type="button" id="woo-slg-add-custom-hook" class="btn button-primary custom-hook-btn">Add more</button>
								</td>
							</tr>

							<tr class="woo-slg-setting-seperator">
								<td colspan="2">
									<strong><?php _e( 'GDPR Settings', 'wpwfp' ); ?></strong>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_gdpr"><?php _e( 'Enable GDPR:', 'wooslg' ); ?></label>
								</th>
								<td>
									<label>
										<input id="woo_slg_enable_gdpr" type="checkbox" name="woo_slg_enable_gdpr" value="1" <?php echo ($woo_slg_enable_gdpr=='yes') ? 'checked="checked"' : ''; ?>/>
										<?php echo __( 'Check this box to enable GDPR notice on social login.', 'wooslg' ); ?>
									</label>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_gdpr_privacy_page"><?php _e( 'Privacy Page:', 'wooslg' ); ?></label>
								</th>
								<td>
									<select id="woo_slg_gdpr_privacy_page" class="wslg-select" name="woo_slg_gdpr_privacy_page" style="max-width: 90%; width: 350px;">
										<option value=""><?php _e( 'Choose a Page', 'wooslg' ); ?></option>
										<?php if( !empty($all_pages) ){
											foreach( $all_pages as $page_data ){ ?>
											<option value="<?php print $page_data->ID; ?>" <?php selected($woo_slg_gdpr_privacy_page, $page_data->ID, true); ?>><?php print $page_data->post_title; ?></option>
										<?php } 
										}?>
									</select><br>
									<span class="description"><?php echo __( 'Choose a page to act as your privacy page.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gdpr_privacy_policy"><?php _e( 'Social Login Privacy Policy: ', 'wooslg' ); ?></label>
								</th>
								<td>
									<textarea id="woo_slg_gdpr_privacy_policy" class="regular-text" rows="5" name="woo_slg_gdpr_privacy_policy"><?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gdpr_privacy_policy ); ?></textarea></br>
									<span class="description"><?php echo __( 'Enter the text with your privacy policy link to show above the social buttons.', 'wooslg'); ?><br><code>[privacy_policy]</code> - <?php echo __( 'Display privacy policy page link.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<!-- Display Settings End -->
							
							<?php
								//check WooCommerce is activated or not
								if( class_exists( 'Woocommerce' ) ) {
								
									$woo_slg_enable_expand_collapse_option = array(
										'' 				=> __('None','wooslg'),
										'collapse' 		=> __('Collapse','wooslg'),
										'expand' 		=> __('Expand','wooslg')
									);
							?>
							<tr class="woo-slg-setting-seperator">
								<td colspan="2">
									<strong><?php _e( 'WooCommerce Settings', 'wpwfp' ); ?></strong>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label><?php _e( 'Display Social Login buttons on:', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="checkbox" name="woo_slg_enable_login_page" value="1" <?php echo ($woo_slg_enable_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Check this box to add social login on WooCommerce login page.', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="checkbox" name="woo_slg_enable_woo_register_page" value="1" <?php echo ($woo_slg_enable_woo_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Check this box to add social login on WooCommerce Registration page.', 'wooslg' ); ?>
											</label>
										</li>
										<li class="wooslg-settings-meta-box">
											<label>
												<input type="checkbox" name="woo_slg_enable_on_checkout_page" value="1" <?php echo ($woo_slg_enable_on_checkout_page=='yes') ? 'checked="checked"' : ''; ?>/>
												<?php echo __( 'Check this box to add social login on WooCommerce Checkout page.', 'wooslg' ); ?>
											</label>
										</li>
									</ul>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_display_link_thank_you"><?php _e( 'Display "Link Your Account" button on:', 'wooslg' ); ?></label>
								</th>
								<td>
									<ul>
										<li>
											<input type="checkbox" id="woo_slg_display_link_thank_you" name="woo_slg_display_link_thank_you" value="1" <?php echo ($woo_slg_display_link_thank_you=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_display_link_thank_you"><?php echo __( ' Check this box to allow customers to link their social account on the Thank You page.','wooslg' ); ?></label>
										</li>
										<li>
											<input type="checkbox" id="woo_slg_display_link_acc_detail" name="woo_slg_display_link_acc_detail" value="1" <?php echo (empty($woo_slg_display_link_acc_detail) || $woo_slg_display_link_acc_detail=='yes') ? 'checked="checked"' : ''; ?>/>
											<label for="woo_slg_display_link_acc_detail"><?php echo __( ' Check this box to allow customers to link their social account on the Account Details page.','wooslg' ); ?></label>
										</li>
									</ul>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_enable_expand_collapse"><?php echo __( 'Expand/Collapse Buttons:', 'wooslg' ); ?></label>
								</th>
								<td>
									<select name="woo_slg_enable_expand_collapse" id="woo_slg_enable_expand_collapse" class="wslg-select" style="max-width: 90%; width: 350px;">
										<?php foreach ( $woo_slg_enable_expand_collapse_option as $key => $option ) { ?>
											<option value="<?php echo $key; ?>" <?php selected( $woo_slg_enable_expand_collapse, $key ); ?>>
												<?php esc_html_e( $option ); ?>
											</option>
										<?php } ?>
									</select><br />
									<span class="description"><?php echo '<br />'. __('Here you can select how to show the social login buttons.','wooslg'); ?></span>
								</td>
							</tr>

							<?php } ?>

							<?php if( class_exists( 'PeepSo' ) ) { ?>
								<tr class="woo-slg-setting-seperator">
									<td colspan="2">
										<strong><?php _e( 'PeepSo Settings', 'wpwfp' ); ?></strong>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label><?php _e( 'Display Social Login buttons on:', 'wooslg' ); ?></label>
									</th>
									<td>
										<ul>
											<li class="wooslg-settings-meta-box">
												<label>
													<input type="checkbox" name="woo_slg_enable_peepso_login_page" value="1" <?php echo ($woo_slg_enable_peepso_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
													<?php echo __( 'Check this box to add social login on PeepSo login.', 'wooslg' ); ?>
												</label>
											</li>
											<li class="wooslg-settings-meta-box">
												<label>
													<input type="checkbox" name="woo_slg_enable_peepso_register_page" value="1" <?php echo ($woo_slg_enable_peepso_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
													<?php echo __( 'Check this box to add social login on PeepSo Registration page.', 'wooslg' ); ?>
												</label>
											</li>
										</ul>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="woo_slg_allow_peepso_avatar"><?php _e( 'Set Avatar on PeepSo user profile:', 'wooslg' );?></label>
									</th>
									<td>
										<input type="checkbox" id="woo_slg_allow_peepso_avatar" class="allow_peepso_avatar" name="woo_slg_allow_peepso_avatar" value="1" <?php echo ($woo_slg_allow_peepso_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
										<label for="woo_slg_allow_peepso_avatar"><?php echo __( ' Check this box if you want to set social media avatar to PeepSo user profile.','wooslg' ); ?></label>
									</td>
								</tr>

								<tr id="peepso_avatar_each_time" style="<?php print $peepso_avatar_each_style;?>">
									<th scope="row">
										<label for="woo_slg_peepso_avatar_each_time"><?php _e( 'Set Avatar on PeepSo user profile every time:', 'wooslg' );?></label>
									</th>
									<td>
										<input type="checkbox" id="woo_slg_peepso_avatar_each_time" class="allow_peepso_avatar" name="woo_slg_peepso_avatar_each_time" value="1" <?php echo ($woo_slg_peepso_avatar_each_time=='yes') ? 'checked="checked"' : ''; ?>/>
										<label for="woo_slg_peepso_avatar_each_time"><?php echo __( ' Check this box if you want to set social media avatar every time.','wooslg' ); ?></label>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="woo_slg_allow_peepso_cover"><?php _e( 'Set Cover Photo on PeepSo user profile:', 'wooslg' );?></label>
									</th>
									<td>
										<input type="checkbox" id="woo_slg_allow_peepso_cover" class="allow_peepso_cover" name="woo_slg_allow_peepso_cover" value="1" <?php echo ($woo_slg_allow_peepso_cover == 'yes') ? 'checked="checked"' : ''; ?>/>
										<label for="woo_slg_allow_peepso_cover"><?php echo __( ' Check this box if you want to set social media cover to PeepSo user profile.','wooslg' ); ?></label>
									</td>
								</tr>
								<tr id="peepso_cover_each_time" style="<?php print $peepso_cover_each_style;?>">
									<th scope="row">
										<label for="woo_slg_peepso_cover_each_time"><?php _e( 'Set Cover Photo on PeepSo user profile every time:', 'wooslg' );?></label>
									</th>
									<td>
										<input type="checkbox" id="woo_slg_peepso_cover_each_time" class="allow_peepso_cover" name="woo_slg_peepso_cover_each_time" value="1" <?php echo ($woo_slg_peepso_cover_each_time == 'yes') ? 'checked="checked"' : ''; ?>/>
										<label for="woo_slg_peepso_cover_each_time"><?php echo __( ' Check this box if you want to set social media cover every time.','wooslg' ); ?></label>
									</td>
								</tr>
							<?php } ?>

							<?php if( class_exists( 'BuddyPress' ) ) { ?>
								<tr class="woo-slg-setting-seperator">
									<td colspan="2">
										<strong><?php _e( 'BuddyPress Settings', 'wpwfp' ); ?></strong>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label><?php _e( 'Display Social Login buttons on:', 'wooslg' ); ?></label>
									</th>
									<td>
										<ul>
											<li class="wooslg-settings-meta-box">
												<label>
													<input type="checkbox" name="woo_slg_enable_buddypress_login_page" value="1" <?php echo ($woo_slg_enable_buddypress_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
													<?php echo __( 'Check this box to add social login on BuddyPress login.', 'wooslg' ); ?>
												</label>
											</li>
											<li class="wooslg-settings-meta-box">
												<label>
													<input type="checkbox" name="woo_slg_enable_buddypress_register_page" value="1" <?php echo ($woo_slg_enable_buddypress_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
													<?php echo __( 'Check this box to add social login on BuddyPress Registration page.', 'wooslg' ); ?>
												</label>
											</li>
										</ul>
									</td>
								</tr>
							<?php } ?>

							<?php if( class_exists( 'bbPress' ) ) { ?>
								<tr class="woo-slg-setting-seperator">
									<td colspan="2">
										<strong><?php _e( 'bbPress Settings', 'wpwfp' ); ?></strong>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label><?php _e( 'Display Social Login buttons on:', 'wooslg' ); ?></label>
									</th>
									<td>
										<ul>
											<li class="wooslg-settings-meta-box">
												<label>
													<input type="checkbox" name="woo_slg_enable_bbpress_login_page" value="1" <?php echo ($woo_slg_enable_bbpress_login_page=='yes') ? 'checked="checked"' : ''; ?>/>
													<?php echo __( 'Check this box to add social login on bbPress login.', 'wooslg' ); ?>
												</label>
											</li>
											<li class="wooslg-settings-meta-box">
												<label>
													<input type="checkbox" name="woo_slg_enable_bbpress_register_page" value="1" <?php echo ($woo_slg_enable_bbpress_register_page=='yes') ? 'checked="checked"' : ''; ?>/>
													<?php echo __( 'Check this box to add social login on bbPress Registration page.', 'wooslg' ); ?>
												</label>
											</li>
										</ul>
									</td>
								</tr>
							<?php } ?>

							<!-- Page Settings End --><?php
							
							// do action for add setting after display settings
							do_action( 'woo_slg_after_display_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
				</div>
			</div>
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-general -->