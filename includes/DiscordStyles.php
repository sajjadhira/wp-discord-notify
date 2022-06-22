<?php
defined('ABSPATH') or die();

function wp_discord_notify_styles()
{
    if (is_single()) {
        wp_enqueue_style('wp-discord-notify-style', plugins_url('/css/wp-discord-notify.css', __DIR__));
    }
}
add_action('wp_enqueue_scripts', 'wp_discord_notify_styles');
