<?php

function one_wp_admin_script_enqueue()
{
    wp_enqueue_style('one-wp-admin-css', ONE_WP_PLUGIN_URL . 'admin/css/admin.css', array(), ONE_WP_PLUGIN_VERSION, 'all');
    wp_enqueue_script('one-wp-admin-js', ONE_WP_PLUGIN_URL . 'admin/js/admin.js', array(), ONE_WP_PLUGIN_VERSION, true);
}

function one_wp_public_script_enqueue()
{
    wp_enqueue_style('one-wp-public-css', ONE_WP_PLUGIN_URL . 'public/css/public.css', array(), ONE_WP_PLUGIN_VERSION, 'all');
    wp_enqueue_script('one-wp-public-js', ONE_WP_PLUGIN_URL . 'public/js/public.js', array(), ONE_WP_PLUGIN_VERSION, true);
}

add_action('admin_enqueue_scripts', 'one_wp_admin_script_enqueue');
add_action('wp_enqueue_scripts', 'one_wp_public_script_enqueue');
