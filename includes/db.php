<?php

function one_wp_database_table()
{
    global $wpdb;
    $db_version = ONE_WP_PLUGIN_DB_VERSION;

    $table_reactions = $wpdb->prefix . 'reactions';
    $table_votes = $wpdb->prefix . 'votes';

    $charset_collate = $wpdb->get_charset_collate();

    $sql_reactions = "CREATE TABLE IF NOT EXISTS $table_reactions (
		id BIGINT(20) NOT NULL AUTO_INCREMENT,
        post_id BIGINT(20) NOT NULL,
        user_id BIGINT(20) NOT NULL,
        reaction_type VARCHAR(50) NOT NULL,
        reaction_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY user_id (user_id),
        KEY reacted_at (reaction_at)
	) $charset_collate;";

    $sql_votes = "CREATE TABLE IF NOT EXISTS $table_votes (
		id BIGINT(20) NOT NULL AUTO_INCREMENT,
        post_id BIGINT(20) NOT NULL,
        user_id BIGINT(20) NOT NULL,
        vote_type VARCHAR(50) NOT NULL,
        voted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY user_id (user_id),
        KEY voted_at (voted_at)
	) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql_reactions);
    dbDelta($sql_votes);

    add_option('one_wp_db_version', $db_version);
}

