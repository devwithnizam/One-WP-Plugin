<?php

function one_wp_reactions_table()
{
    global $wpdb;
    $db_version = ONE_WP_PLUGIN_DB_VERSION;

    $table_name = $wpdb->prefix . 'reactions';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        post_id BIGINT(20) UNSIGNED NOT NULL,
        user_id BIGINT(20) UNSIGNED DEFAULT NULL,
        reaction VARCHAR(20) NOT NULL,
        ip_address VARCHAR(45) DEFAULT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY user_id (user_id),
        KEY reaction (reaction),
        UNIQUE KEY unique_reaction (post_id, user_id, reaction)
	) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    add_option('one_wp_db_version', $db_version);
}

function one_wp_update_db()
{
    global $wpdb;
    $installed_version = get_option('one_wp_db_version');
    $current_version = ONE_WP_PLUGIN_DB_VERSION;

    if ($installed_version !== $current_version) {
        $table_name = $wpdb->prefix . 'post_votes';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        post_id BIGINT(20) UNSIGNED NOT NULL,
        user_id BIGINT(20) UNSIGNED DEFAULT NULL,
        reaction VARCHAR(20) NOT NULL,
        ip_address VARCHAR(45) DEFAULT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY user_id (user_id),
        KEY reaction (reaction),
        UNIQUE KEY unique_reaction (post_id, user_id, reaction)
	) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        update_option('one_wp_db_version', $current_version);
    }
}

function one_wp_update_db_check()
{
    $installed_version = get_option('one_wp_db_version');
    $current_version = ONE_WP_PLUGIN_DB_VERSION;
    if ($installed_version !== $current_version) {
        one_wp_update_db();
    }
}
add_action('plugins_loaded', 'one_wp_update_db_check');
