<?php

class ONE_WP_Plugin
{
    public function __construct()
    {
        $this->load_dependencies();
        add_action('admin_enqueue_scripts', [$this, 'one_wp_admin_script_enqueue']);
        add_action('wp_enqueue_scripts', [$this, 'one_wp_public_script_enqueue']);
        add_action('admin_menu', [$this, 'one_wp_admin_menu']);
        add_action('init', [$this, 'register_projects_post_type']);
    }

    /**
     * Load the required dependencies for the plugin.
     */
    private function load_dependencies()
    {

        require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/db.php';
        require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/taxonomy.php';
        require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/meta-boxes.php';
        require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/admin/admin-page.php';
        require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/admin/admin-settings.php';
        require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/shortcodes.php';
    }

    /**
     * Enqueue admin and public scripts and styles.
     */
    public function one_wp_admin_script_enqueue()
    {
        wp_enqueue_style('one-wp-admin-css', ONE_WP_PLUGIN_URL . 'assets/css/admin.css', array(), ONE_WP_PLUGIN_VERSION, 'all');
        wp_enqueue_script('one-wp-admin-js', ONE_WP_PLUGIN_URL . 'assets/js/admin.js', array(), ONE_WP_PLUGIN_VERSION, true);
    }

    public function one_wp_public_script_enqueue()
    {
        wp_enqueue_style('one-wp-public-css', ONE_WP_PLUGIN_URL . 'assets/css/public.css', array(), ONE_WP_PLUGIN_VERSION, 'all');
        wp_enqueue_script('one-wp-public-js', ONE_WP_PLUGIN_URL . 'assets/js/public.js', array(), ONE_WP_PLUGIN_VERSION, true);
    }
    /**
     * Register the admin menu and submenu pages.
     */
    public function one_wp_admin_menu()
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

    /**
     * Register a custom post type called "Projects".
     */
    public function register_projects_post_type()
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
}

new ONE_WP_Plugin();
