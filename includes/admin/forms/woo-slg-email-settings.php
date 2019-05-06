<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Settings Page Email Tab
 * 
 * The code for the plugins settings page Email tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.8.2
 */
// Get email options 
$woo_slg_email_login_options = array(
    'woo_slg_enable_email',
    'woo_slg_enable_email_varification',
    'woo_slg_mail_subject',
    'woo_slg_mail_content',
    'woo_slg_login_email_heading',
    'woo_slg_login_email_placeholder',
    'woo_slg_login_btn_text',
    'woo_slg_login_email_seprater_text',
    'woo_slg_login_email_position'
);

$positions = array('top' => __('Above Social buttons', 'wooslg'),
    'bottom' => __('Below Social buttons', 'wooslg'),
);

// Get option value
foreach ($woo_slg_email_login_options as $woo_slg_option_key) {

    $$woo_slg_option_key = get_option($woo_slg_option_key);
}

$woo_slg_login_email_position = !empty($woo_slg_login_email_position) ? $woo_slg_login_email_position : 'top';
?>

<!-- beginning of the Email login settings meta box -->
<div id="woo-slg-email" class="post-box-container">
    <div class="metabox-holder">
        <div class="meta-box-sortables ui-sortable">
            <div id="email-login" class="postbox">
                <div class="handlediv" title="<?php _e('Click to toggle', 'wooslg'); ?>"><br /></div>

                <!-- Email login settings box title -->
                <h3 class="hndle">
                    <span style='vertical-align: top;'><?php _e('Login With Email Settings', 'wooslg'); ?></span>
                </h3>

                <div class="inside">

                    <table class="form-table">
                        <tbody>

                            <?php
// do action for add setting before email login settings
                            do_action('woo_slg_before_email_login_setting');
                            ?>

                            <tr>
                                <th scope="row">
                                    <label for="woo_slg_enable_email"><?php _e('Enable Login With Email:', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input type="checkbox" id="woo_slg_enable_email" name="woo_slg_enable_email" value="1" <?php echo ($woo_slg_enable_email == 'yes') ? 'checked="checked"' : ''; ?>/>
                                    <label for="woo_slg_enable_email"><?php echo __('Check this box, if you want to enable sign in / sign up with email only.', 'wooslg'); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="woo_slg_enable_email_varification"><?php _e('Enable Confirmation Email:', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input type="checkbox" id="woo_slg_enable_email_varification" name="woo_slg_enable_email_varification" value="1" <?php echo ($woo_slg_enable_email_varification == 'yes') ? 'checked="checked"' : ''; ?>/>
                                    <label for="woo_slg_enable_email_varification"><?php echo __('Check this box, if you want to send confirmation email to user when they signup with email only.', 'wooslg'); ?></label>
                                </td>
                            </tr>
                            <tr class="show_hide<?php echo ($woo_slg_enable_email_varification == 'yes') ? ' woo_slg_mail_settings_show_rows' : ' woo_slg_mail_settings_hide_rows'; ?>">
                                <th scope="row">
                                    <label for="woo_slg_mail_subject"><?php _e('Confirmation Email subject: ', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input id="woo_slg_mail_subject" type="text" class="regular-text" name="woo_slg_mail_subject" value="<?php echo $woo_slg_model->woo_slg_escape_attr($woo_slg_mail_subject); ?>" placeholder="Activate your Account" /></br>
                                    <span class="description"><?php echo __('<desc>Enter the email subject.</desc>', 'wooslg'); ?></span>
                                </td>
                            </tr>
                            <tr class="show_hide<?php echo ($woo_slg_enable_email_varification == 'yes') ? ' woo_slg_mail_settings_show_rows' : ' woo_slg_mail_settings_hide_rows'; ?>">
                                <th scope="row">
                                    <label for="woo_slg_mail_content"><?php _e('Confirmation Email body: ', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <?php
                                    $content = $woo_slg_model->woo_slg_escape_attr($woo_slg_mail_content);
                                    $editor_id = 'woo_slg_mail_content';
                                    wp_editor($content, $editor_id);
                                    ?>
                                    
                                    </br>
                                    <span class="description"><?php echo __('<desc>Enter the content for email body. <br/><code>{verify_link}</code> - This tag used to create verify link.</desc>', 'wooslg'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="woo_slg_login_email_position"><?php _e('Position:', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <select class="woo_slg_login_email_position wslg-select" name="woo_slg_login_email_position" style="max-width: 90%; width: 350px;">
                                        <?php foreach ($positions as $key => $position) { ?>
                                            <option value="<?php print $key; ?>" <?php selected($woo_slg_login_email_position, $key, true); ?>><?php print $position; ?></option>
<?php } ?>
                                    </select><br>
                                    <span class="description"><?php echo __('Select the postion where you want to display the login with email form.', 'wooslg'); ?></span>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="woo_slg_login_email_heading"><?php _e('Heading Title: ', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input id="woo_slg_login_email_heading" type="text" class="regular-text" name="woo_slg_login_email_heading" value="<?php echo $woo_slg_model->woo_slg_escape_attr($woo_slg_login_email_heading); ?>" /></br>
                                    <span class="description"><?php echo __('Enter the title for login with email.', 'wooslg'); ?></span>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="woo_slg_login_email_placeholder"><?php _e('Placeholder Text: ', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input id="woo_slg_login_email_placeholder" type="text" class="regular-text" name="woo_slg_login_email_placeholder" value="<?php echo $woo_slg_model->woo_slg_escape_attr($woo_slg_login_email_placeholder); ?>" /></br>
                                    <span class="description"><?php echo __('Enter the text for email placeholder.', 'wooslg'); ?></span>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="woo_slg_login_btn_text"><?php _e('Button Text: ', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input id="woo_slg_login_btn_text" type="text" class="regular-text" name="woo_slg_login_btn_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr($woo_slg_login_btn_text); ?>" /></br>
                                    <span class="description"><?php echo __('Enter the text for submit button.', 'wooslg'); ?></span>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <label for="woo_slg_login_email_seprater_text"><?php _e('Seprater Text: ', 'wooslg'); ?></label>
                                </th>
                                <td>
                                    <input id="woo_slg_login_email_seprater_text" type="text" class="regular-text" name="woo_slg_login_email_seprater_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr($woo_slg_login_email_seprater_text); ?>" /></br>
                                    <span class="description"><?php echo __('Enter the text for seprater line.', 'wooslg'); ?></span>
                                </td>
                            </tr>


                            <!-- Page Settings End --><?php
                            // do action for add setting after email settings
                            do_action('woo_slg_after_email_login_setting');
                            ?>
                            <tr>
                                <td colspan="2"><?php echo apply_filters('woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="' . __('Save Changes', 'wooslg') . '" />'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- .inside -->
            </div><!-- #email -->
        </div><!-- .meta-box-sortables ui-sortable -->
    </div><!-- .metabox-holder -->
</div><!-- #woo-slg-email -->