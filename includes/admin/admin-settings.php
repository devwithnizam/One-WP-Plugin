<?php

function one_wp_settings_init()
{
    // register a new setting for "one_wp" page
    register_setting('one_wp', 'one_wp_setting_name');
    register_setting('one_wp_subpage', 'one_wp_setting_checkbox');

    // register a new section in the "one_wp" page
    add_settings_section(
        'one_wp_settings_section',
        'One WP Settings Section',
        'one_wp_settings_section_callback',
        'one_wp'
    );
    add_settings_section(
        'one_wp_settings_misc_section',
        'One WP Settings Section',
        'one_wp_settings_misc_section_callback',
        'one_wp_subpage'
    );

    // register a new field in the "one_wp_settings_section" section, inside the "one_wp" page
    add_settings_field(
        'one_wp_settings_field',
        'One WP Shortcode Text',
        'one_wp_settings_field_callback',
        'one_wp',
        'one_wp_settings_section'
    );
    add_settings_field(
        'one_wp_settings_checkbox_field',
        'One WP Shortcode Yes/No',
        'one_wp_settings_checkbox_field_callback',
        'one_wp_subpage',
        'one_wp_settings_misc_section'
    );
}

/**
 * register one_wp_settings_init to the admin_init action hook
 */
add_action('admin_init', 'one_wp_settings_init');

/**
 * callback functions
 */

// section content cb
function one_wp_settings_section_callback()
{
    echo '<p>Manage One WP Settings</p>';
}
function one_wp_settings_misc_section_callback()
{
    echo '<p>Manage One WP Misc Settings</p>';
}

// field content cb
function one_wp_settings_field_callback()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('one_wp_setting_name');
    // output the field
?>
    <input type="text" name="one_wp_setting_name" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>">
<?php
}
// checkbox field content cb
function one_wp_settings_checkbox_field_callback()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('one_wp_setting_checkbox');
    // output the field
?>
    <input type="checkbox" name="one_wp_setting_checkbox" value="1" <?php checked(1, $setting); ?>>
<?php
}
