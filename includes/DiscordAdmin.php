<?php

// add styles and scripts to the head of the page
function wp_discord_admin_styles()
{
    wp_enqueue_style('wp-discord-notify-style', plugins_url('/css/wp-discord-admin.css', __DIR__));

}

add_action('admin_enqueue_scripts', 'wp_discord_admin_styles'); // add styles to the head of the page

// admin page design

function wp_discord_admin()
{

    // call the global variables

    global $wp_discord_options;

    ?>
<div class="wrap">
    <h2><?php _e("WP Discord Notification", "wp_discord_domain");?></h2>
    <p><?php _e("Please configure your webhook to push notification to your discord channel", "wp_discord_domain");?></p>
    <form method="post" action="options.php">

        <?php settings_fields('wp_discord_notify_settings');?> <!-- call the settings field -->
        <?php do_settings_sections('wp_discord_notify_settings');?> <!-- call the settings section -->
        <div class="form-group">
            <label for="wp_discord_settings[webhook]"><?php _e("Discord Webhook URL", 'wp_discord_domain')?></label>
            <input type="text" name="wp_discord_settings[webhook]" id="wp_discord_settings[webhook]" placeholder="<?php _e("Webhook URL", 'wp_discord_domain')?>" value="<?php echo $wp_discord_options['webhook'] ?>" required>
        </div>
        <div class="form-group">
        <label for="wp_discord_settings[botname]"><?php _e("Discord Bot Name", "wp_discord_domain");?></label>
        <input type="text" name="wp_discord_settings[botname]" id="wp_discord_settings[botname]" placeholder="<?php _e("Bot Name", 'wp_discord_domain')?>" value="<?php echo $wp_discord_options['botname'] ?>" required>
        </div>

        <div class="form-group">
            <label for="wp_discord_settings[activated]"><?php _e("Notifiy On New Post Publish", "wp_discord_domain");?></label>
            <input type="checkbox" name="wp_discord_settings[activated]" id="wp_discord_settings[activated]" value="1" <?php checked(1, $wp_discord_options['activated']);?> />
        </div>
        <?php submit_button("Store Discord Information");?>

</div>

<?php

}

// adding to options menu

function discord_admin_option_link()
{
    add_options_page('WP Discord Notify', 'WP Discord Notify', 'manage_options', 'wp-discord-notify', 'wp_discord_admin');
}

add_action('admin_menu', 'discord_admin_option_link');

// register the settings

function wp_discord_register_settings()
{
    register_setting('wp_discord_notify_settings', 'wp_discord_settings');

}

add_action('admin_init', 'wp_discord_register_settings');