<?php

/*
 * Plugin Name:       One WP
 * Plugin URI:        #
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            MD. Nizam Uddin
 * Author URI:        https://www.linkedin.com/in/programmernizam/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       one-wp
 */

/** 
 * Copyright (c) 2025 MD. Nizam Uddin (https://www.linkedin.com/in/programmernizam/)
 * 
 * Released under the GPL v2 or later license
 * https://www.gnu.org/licenses/gpl-2.0.html
 * 
 * This is an add-on for WordPress
 * https://wordpress.org
 * 
 * *****************************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * *****************************************************************************
 */
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!defined('ONE_WP_PLUGIN_VERSION')) {
    define('ONE_WP_PLUGIN_VERSION', '1.0.0');
}

if (! defined('ONE_WP_PLUGIN_DIR_PATH')) {

    define('ONE_WP_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if (! defined('ONE_WP_PLUGIN_URL')) {

    define('ONE_WP_PLUGIN_URL', plugin_dir_url(__FILE__));
}

// Include Scripts & Styles
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/scripts.php';

// Hooks Action & Filters
// require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/hooks.php';

// Include CPT, Taxonomies, Meta Boxes
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/cpt.php';
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/taxonomy.php';
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/meta-boxes.php';

// Plugin Custom settings page value dynamic usage in shortcode conditional output
$shortcode_text = get_option('one_wp_setting_checkbox');
// Include Shortcodes
if($shortcode_text==='1'):{
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/shortcodes.php';
};endif;
// Include Admin Menu
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/admin/admin-menu.php';
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/admin/admin-page.php';
require_once ONE_WP_PLUGIN_DIR_PATH . 'includes/admin/admin-settings.php';
