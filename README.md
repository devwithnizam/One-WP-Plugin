=== One WP ===
Contributors: MD NIZAM UDDIN
Tags: basic, starter, learning
Requires at least: 5.2
Tested up to: 6.4.2
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A starter plugin to handle the basics.

## Description

One WP is a comprehensive learning project and a starter plugin for WordPress developers. It provides a robust structure for managing various WordPress components, including custom post types, taxonomies, shortcodes, hooks, meta boxes, and administrative pages and settings. It also handles enqueueing scripts and styles for both the admin and public-facing sides of a WordPress site. It's an excellent starting point for building more complex and feature-rich plugins.

The plugin is structured into the following directories:

- `admin`: Contains the CSS, JavaScript, and image files for the WordPress admin area.
- `includes`: Contains the core PHP files for the plugin's functionality.
- `public`: Contains the CSS, JavaScript, and image files for the public-facing side of the website.

## Installation

1. Upload the `one-wp` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Start building!

## File Structure

one-wp/
├── one-wp.php (Main plugin file)
├── README.md (This file)
├── admin/
│   ├── css/
│   │   └── admin.css (Admin styles)
│   ├── js/
│   │   └── admin.js (Admin scripts)
│   └── images/ (Admin images)
├── includes/
│   ├── cpt.php (Custom Post Types)
│   ├── hooks.php (Action and filter hooks)
│   ├── meta-boxes.php (Meta box registration)
│   ├── scripts.php (Script and style enqueueing)
│   ├── shortcodes.php (Shortcode registration)
│   ├── taxonomy.php (Custom Taxonomies)
│   └── admin/
│       ├── admin-menu.php (Admin menu registration)
│       ├── admin-page.php (Admin page content)
│       └── admin-settings.php (Plugin settings)
└── public/
    ├── css/
    │   └── public.css (Public styles)
    ├── js/
    │   └── public.js (Public scripts)
    └── images/ (Public images)


## Frequently Asked Questions

### Does this plugin do anything out of the box?

Currently, it sets up the basic structure for custom post types, taxonomies, shortcodes, action/filter hooks, meta boxes, and administrative menus, pages, and settings. You can also find the files for enqueuing admin and public CSS and JavaScript in their respective `admin` and `public` folders.

## Screenshots

1. The basic plugin structure.

## Changelog

### 1.0.0
* Initial release.

## Upgrade Notice

### 1.0.0
Initial release of the plugin.