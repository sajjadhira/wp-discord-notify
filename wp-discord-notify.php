<?php
/*
Plugin Name: WP Discord Notification
Plugin URI: https://inihub.com/plugins/wp-discord-notification/
Description: This is discord notification plugin for WordPress.
Author: Sajjad Hossain
Author URI: https://inihub.com/
Version: 1.0
 */

// get discord options from options table
$wp_discord_options = get_option('wp_discord_settings');

include plugin_dir_path(__FILE__) . 'includes/DiscordNotify.php'; // include discord notify function
include plugin_dir_path(__FILE__) . 'includes/DiscordStyles.php'; // include discord styles function
include plugin_dir_path(__FILE__) . 'includes/DiscordAdmin.php'; // include discord admin page function
