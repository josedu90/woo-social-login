<?php
/**
 * Login with email
 * 
 * Handles to load Login in with email template
 * 
 * Override this template by copying it to yourtheme/woo-social-login/email-login.php
 * 
 * @package WooCommerce - Social Login
 * @since 1.8.2
 */
?>
<div class="woo-slg-email-login-container">

	<?php if( !empty( $seprater_text ) && $position == 'bottom' ){?>
		<div class="woo-slg-horizontal-divider"><span><?php print $seprater_text;?></span></div>
	<?php } ?>

	<?php if( !empty( $login_email_heading ) ) {
		echo '<span><legend>' . $login_email_heading . '</legend></span>';
	}
	?>
	<div class="woo-slg-email-login-wrap">
		<input type="text" class="regular-text woo-slg-email-login woo-slg-email-input" placeholder="<?php echo $login_email_placeholder; ?>" />
		<input type="hidden" name="woo_slg_login_redirect_url" value="<?php echo $redirect_url; ?>">
		<input type="button" class="woo-slg-email-login-btn" id="woo-slg-email-login-btn" value="<?php echo $login_btn_text; ?>" title="<?php echo $login_btn_text; ?>" />
		<div class="woo-slg-clear"></div>
	</div><!--.woo-slg-social-wrap-->

	<div class="woo-slg-login-email-error"></div><!--woo-slg-login-error-->
	<div class="woo-slg-login-success"></div><!--woo-slg-login-success-->

	<div class="woo-slg-login-loader">
		<img src="<?php echo WOO_SLG_IMG_URL;?>/social-loader.gif" alt="<?php _e( 'Social Loader', 'wooslg');?>"/>
	</div><!--.woo-slg-login-loader-->

	<?php if( !empty( $seprater_text ) && $position == 'top' ){?>
		<div class="woo-slg-horizontal-divider"><span><?php print $seprater_text;?></span></div>
	<?php } ?>		 
</div>