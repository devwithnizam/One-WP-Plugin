<?php

function one_wp_admin_menu()
{
    add_menu_page(
        'One WP Settings',
        'One WP',
        'manage_options',
        'one-wp',
        'one_wp_settings_page',
        'dashicons-superhero-alt',
        30
    );
    add_submenu_page(
        'one-wp',
        'One WP Settings',
        'Settings',
        'manage_options',
        'one-wp-settings',
        'one_wp_settings_subpage'
    );
}
add_action('admin_menu', 'one_wp_admin_menu');
