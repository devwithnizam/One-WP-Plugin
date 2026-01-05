<?php

/*
 * Actions
 */

function one_wp_footer_text()
{
    echo '<p style="text-align:center;">&copy; 2026 One WP Plugin. All rights reserved.</p>';
}

add_action('wp_footer', 'one_wp_footer_text');

/*
 * Filters
 */

function one_wp_meta_info()
{
    if (!is_singular('post')) {
        $title = get_the_title();
        $description = get_the_excerpt();
        echo '<meta name="title" content="' . esc_attr($title) . '">';
        echo '<meta name="description" content="' . esc_attr($description) . '">';
    }
}
add_action('wp_head', 'one_wp_meta_info');

function one_wp_post_title($title)
{
    $ademojy = ' 🚀';
    if (is_singular('post')) {
        return $title . $ademojy;
    }
    return $title;
}

add_filter('the_title', 'one_wp_post_title');

function one_wp_excerpt_length($length)
{
    return 20; // Set excerpt length to 20 words
}

add_filter('excerpt_length', 'one_wp_excerpt_length');
