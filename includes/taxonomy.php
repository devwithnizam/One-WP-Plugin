<?php


// Register Custom Taxonomy
function register_project_industry_taxonomy()
{
    $labels = array(
        'name'                       => _x('Industries', 'Taxonomy General Name', 'one-wp'),
        'singular_name'              => _x('Industry', 'Taxonomy Singular Name', 'one-wp'),
        'menu_name'                  => __('Industries', 'one-wp'),
        'all_items'                  => __('All Industries', 'one-wp'),
        'parent_item'                => __('Parent Industry', 'one-wp'),
        'parent_item_colon'          => __('Parent Industry:', 'one-wp'),
        'new_item_name'              => __('New Industry Name', 'one-wp'),
        'add_new_item'               => __('Add New Industry', 'one-wp'),
        'edit_item'                  => __('Edit Industry', 'one-wp'),
        'update_item'                => __('Update Industry', 'one-wp'),
        'view_item'                  => __('View Industry', 'one-wp'),
        'search_items'               => __('Search Industries', 'one-wp'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'project_industry',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('project_industry', ["projects"], $args);
}
add_action('init', 'register_project_industry_taxonomy', 0);



// Register Custom Taxonomy
function register_project_technology_taxonomy()
{
    $labels = array(
        'name'                       => _x('Technologies', 'Taxonomy General Name', 'one-wp'),
        'singular_name'              => _x('Technology', 'Taxonomy Singular Name', 'one-wp'),
        'menu_name'                  => __('Technologies', 'one-wp'),
        'all_items'                  => __('All Technologies', 'one-wp'),
        'parent_item'                => __('Parent Technology', 'one-wp'),
        'parent_item_colon'          => __('Parent Technology:', 'one-wp'),
        'new_item_name'              => __('New Technology Name', 'one-wp'),
        'add_new_item'               => __('Add New Technology', 'one-wp'),
        'edit_item'                  => __('Edit Technology', 'one-wp'),
        'update_item'                => __('Update Technology', 'one-wp'),
        'view_item'                  => __('View Technology', 'one-wp'),
        'search_items'               => __('Search Technologies', 'one-wp'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'project_technology',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('project_technology', ["projects"], $args);
}
add_action('init', 'register_project_technology_taxonomy', 0);
