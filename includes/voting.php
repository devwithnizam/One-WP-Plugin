<?php

function one_wp_handle_vote_callback()
{
    global $wpdb;

    // CSRF protection using nonce
    check_ajax_referer('one_wp_vote_nonce', 'nonce');

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    $user_id = get_current_user_id();
    $vote_type = isset($_POST['vote_type']) ? sanitize_text_field($_POST['vote_type']) : ''; // "like" or "dislike"

    // Check user authentication
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => esc_html__('You must be logged in to vote.', 'one-wp')]);
        return;
    }

    // Check post id exist
    if (!get_post_status($post_id)) {
        wp_send_json_error(['message' => esc_html__('Invalid Post ID.', 'one-wp')]);
        return;
    }

    // Check vote type validity
    if (!in_array($vote_type, ['like', 'dislike'], true)) {
        wp_send_json_error(['message' => esc_html__('Invalid Vote Type.', 'one-wp')]);
        return;
    }

    $table = $wpdb->prefix . 'votes';

    // Check if the user already voted for this post
    $existing_vote = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table WHERE post_id = %d AND user_id = %d",
        $post_id,
        $user_id
    ));

    if ($existing_vote) {
        if ($existing_vote->vote_type === $vote_type) {
            // Same vote clicked again → remove vote
            $deleted = $wpdb->delete($table, [
                'post_id' => $post_id,
                'user_id' => $user_id
            ], ['%d', '%d']);

            if ($deleted) {
                wp_send_json_success(['message' => ucfirst($vote_type) . ' removed.']);
            } else {
                wp_send_json_error(['message' => 'Failed to remove vote.']);
            }
        } else {
            // Different vote clicked → update vote_type
            $updated = $wpdb->update(
                $table,
                ['vote_type' => $vote_type],
                [
                    'post_id' => $post_id,
                    'user_id' => $user_id
                ],
                ['%s'],
                ['%d', '%d']
            );

            if ($updated !== false) {
                wp_send_json_success(['message' => 'Vote updated to ' . $vote_type . '.']);
            } else {
                wp_send_json_error(['message' => 'Failed to update vote.']);
            }
        }
    } else {
        // No vote yet → insert new vote
        $inserted = $wpdb->insert(
            $table,
            array(
                'post_id' => $post_id,
                'user_id' => $user_id,
                'vote_type' => $vote_type
            ),
            ['%d', '%d', '%s']
        );

        if ($inserted) {
            wp_send_json_success(['message' => ucfirst($vote_type) . ' recorded successfully.']);
        } else {
            wp_send_json_error(['message' => 'Failed to record vote.']);
        }
    }
}


// Register AJAX actions for logged-in users with prefix 'wp_ajax_' before hook name
add_action('wp_ajax_one_wp_handle_vote', 'one_wp_handle_vote_callback');
add_action('wp_ajax_nopriv_one_wp_handle_vote', 'one_wp_handle_vote_callback');
