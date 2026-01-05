<?php


// Register Custom Post Type
function register_projects_post_type()
{
    $labels = array(
        'name'                  => _x('Projects', 'Post Type General Name', 'one-wp'),
        'singular_name'         => _x('Project', 'Post Type Singular Name', 'one-wp'),
        'menu_name'            => __('Projects', 'one-wp'),
        'all_items'            => __('All Projects', 'one-wp'),
        'add_new_item'         => __('Add New Project', 'one-wp'),
        'add_new'              => __('Add New', 'one-wp'),
        'edit_item'            => __('Edit Project', 'one-wp'),
        'update_item'          => __('Update Project', 'one-wp'),
        'search_items'         => __('Search Project', 'one-wp'),
    );

    $args = array(
        'label'                 => __('Project', 'one-wp'),
        'labels'                => $labels,
        'supports'              => ["title", "editor", "thumbnail", "excerpt", "comments", "author"],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-open-folder',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type', 0);
