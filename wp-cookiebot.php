<?php
/*
* Plugin Name: Cookiebot
* Description: This plugin puts cookiebot url in front of scripts in header
* Version: 1.0.2
* License: MIT
* Author URI: https://t.me/TheMayMeow
* Author: 姫彩
*/

function maymeow_cookebot_register_settings()
{
    register_setting('maymeow_cookiebot_options_group', 'mm_cookiebot_id');
}

function maymeow_cookiebot_html_form()
{
    ?>

    <h2>Cookiebot Setting Page Heading</h2>

    <form method="post" action="options.php">
    <?php settings_fields('maymeow_cookiebot_options_group'); ?>
    <label for="mm_cookiebot_id_input">Cookiebot ID:</label>
    <input type="text" class="regular-text" id="mm_cookiebot_id_input" name="mm_cookiebot_id" value="<?php echo get_option('mm_cookiebot_id'); ?>">
    <?php submit_button(); ?>
    </form>

    <?php
}

function maymeow_cookebot_settings_page()
{
    add_options_page('Cookiebot', 'Cookiebot Setting', 'manage_options', 'cookiebot-setting-url', 'maymeow_cookiebot_html_form');
}

function maymeow_cookiebot_script()
{
    $cbid = get_option('mm_cookiebot_id');

    if ($cbid != '') {
        ?>
        <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="<?php echo $cbid ?>" data-blockingmode="auto" type="text/javascript"></script>
        <?php
    }
}

add_action('admin_init', 'maymeow_cookebot_register_settings');
add_action('admin_menu', 'maymeow_cookebot_settings_page');
add_action('wp_head', 'maymeow_cookiebot_script');
