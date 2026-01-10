<?php

function one_wp_handle_vote_callback()
{
    global $wpdb;

    $post_id = intval($_POST['post_id']);
    $user_id = intval($_POST['user_id']);
    $vote_type = sanitize_text_field($_POST['vote_type']); // "like" or "dislike"

    if (empty($post_id) || empty($user_id) || !in_array($vote_type, ['like', 'dislike'])) {
        wp_send_json_error(['message' => 'Invalid input.']);
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
