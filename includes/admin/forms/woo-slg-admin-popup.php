<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortocde UI
 *
 * This is the code for the pop up editor, which shows up when an user clicks
 * on the woo social login icon within the WordPress editor.
 *
 * @package WooCommerce - Social Login
 * @since 1.1.1
 * 
 **/

$networks = woo_slg_social_networks();
$networks['email'] = __('Login with email', 'wooslg');
$theme = wp_get_theme(get_template());
if($theme->get( 'Author' ) == "Elegant Themes" && $theme->get( 'Name' ) == "Divi"){
	echo "<style>";
		echo ".woo-slg-popup-content{z-index: 99999;top: 10%;} .woo-slg-popup-overlay{z-index: 99998;} .select2-container{z-index: 99999;}";
	echo "</style>";
}
?>

<div class="woo-slg-popup-content">

	<div class="woo-slg-header">
		<div class="woo-slg-header-title"><?php _e( 'Add A Social Login Shortcode', 'wooslg' );?></div>
		<div class="woo-slg-popup-close"><a href="javascript:void(0);" class="woo-slg-close-button"><img src="<?php echo WOO_SLG_IMG_URL;?>/tb-close.png" alt="<?php _e( 'Close', 'wooslg' );?>" /></a></div>
	</div>
	
	<div class="woo-slg-popup">
		<div id="woo_slg_login_options" class="woo-slg-shortcodes-options">
		
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="woo_slg_title"><?php _e( 'Social Login Title:', 'wooslg' );?></label>		
						</th>
						<td>
							<input type="text" id="woo_slg_title" class="regular-text" value="<?php _e( 'Prefer to Login with Social Media', 'wooslg' );?>" /><br/>
							<span class="description"><?php _e( 'Enter a social login title.', 'wooslg' );?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="woo_slg_title"><?php _e( 'Social Networks:', 'wooslg' );?></label>		
						</th>
						<td>
							<select id="woo-slg-selected-networks"  class="wslg-select" multiple="" style="max-width: 90%; width: 350px;">
								<?php
								foreach ( $networks as $key => $network ) {

									echo '<option value="'.$key.'">'.$network.'</option>';
								}
								?>
							</select>
							<br/>
							<span class="description"><?php _e( 'Select social networks you want to show. Leave it empty to display all enable social networks.', 'wooslg' );?></span>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="woo_slg_redirect_url"><?php _e( 'Redirect URL:', 'wooslg' );?></label>		
						</th>
						<td>
							<input type="text" id="woo_slg_redirect_url" class="regular-text" value="" placeholder="<?php print site_url();?>" /><br/>
							<span class="description"><?php _e( 'Enter a redirect URL for users after they login with social media. The URL must start with', 'wooslg' ); 
							    print ' http:// or https://'?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="woo_slg_show_on_page"><?php _e( 'Show Only on Page / Post:', 'wooslg' );?></label>		
						</th>
						<td>
							<input type="checkbox" id="woo_slg_show_on_page" value="1" /><br />
							<span class="description"><?php _e( 'Check this box if you want to show social login buttons only on inner page of posts and pages.', 'wooslg' );?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="woo_slg_enable_expand_collapse"><?php _e( 'Expand/Collapse Buttons:', 'wooslg' );?></label>
						</th>
						<td>
							<select id="woo_slg_enable_expand_collapse" name="woo_slg_enable_expand_collapse">
								<option value=""><?php _e('None','wooslg');?></option>
								<option value="collapse"><?php _e('Collapse','wooslg');?></option>
								<option value="expand"><?php _e('Expand','wooslg');?></option>
							</select>
							<br />
							<span class="description"><?php _e( 'Here you can select how to show the social login buttons.', 'wooslg' );?></span>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div><!--woo_slg_login_options-->
		
		<div id="woo_slg_insert_container" >
			<input type="button" class="button-secondary" id="woo_slg_insert_shortcode" value="<?php _e( 'Insert Shortcode', 'wooslg' ); ?>">
		</div>
		
	</div><!--.woo-slg-popup-->
	
</div><!--.woo-slg-popup-content-->
<div class="woo-slg-popup-overlay"></div>