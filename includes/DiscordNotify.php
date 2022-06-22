<?php
defined('ABSPATH') or die();
/*
Plugin Name: WP Discord Notification
Plugin URI: https://inihub.com/plugins/wp-discord-notification/
Description: This is discord notification plugin for WordPress.
Author: Sajjad Hossain
Author URI: https://inihub.com/
Version: 1.0
 */

// function for wordpress published post notification
function wp_discord_notify_now($postid)
{

    global $wp_discord_options; // getting global options

    if (get_post_status($postid) == "publish") { // check if post is published

        if ($wp_discord_options['activated'] == 1) { // check if discord notification activated

            $post_title = get_the_title($postid); // gettting post title
            $post_url = get_permalink($postid); // gettting post url
            $post_author = get_the_author_meta('display_name', $postid); // gettting post author
            $post_author_avatar = get_avatar_url(get_the_author_meta('ID', $postid)); // gettting post author avatar

            $webhook = $wp_discord_options['webhook']; // getting discord webhook url
            $botname = $wp_discord_options['botname']; // getting discord bot name

            $message = "New post published: " . $post_title . " by " . $post_author . " at " . $post_url; // message for discord notification
            $data = ['content' => $message, "username" => $botname, 'avatar_url' => $post_author_avatar]; // data for discord notification

            // data to send to discord
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => json_encode($data),
                ],
            ];
            // create context
            $context = stream_context_create($options);
            file_get_contents($webhook, false, $context); // send data to discord

        }
    }
}

add_action('publish_post', 'wp_discord_notify_now');
