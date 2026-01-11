<?php

/**
 * @ Project Meta Info Shortcode
 * @since 1.0.0
 */

function one_wp_project_meta_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'id' => get_the_ID()
    ), $atts, 'PROJECT_META');

    // Sanitize 'id' to make sure it's an integer
    $post_id = absint($atts['id']);

    // Validate that the provided post id exists.
    if (!$post_id || !get_post_status($post_id)) {
        return '<p>' . esc_html__('Invalid Project ID.', 'one-wp') . '</p>';
    }

    $project_url                  = get_post_meta($post_id, 'project_url', true);
    $project_completion_duration  = get_post_meta($post_id, 'project_completion_duration', true);
    $project_estimated_cost       = get_post_meta($post_id, 'project_estimated_cost', true);

    $html = '<div class="one-wp-project-meta-info">';

    if (!empty($project_url)) {
        $html .= sprintf(
            '<p><strong>%s</strong> <a href="%s" target="_blank" rel="noopener noreferrer">%s</a></p>',
            esc_html__('Project URL:', 'one-wp'),
            esc_url($project_url),
            esc_html($project_url)
        );
    }

    if (!empty($project_completion_duration)) {
        $html .= sprintf(
            '<p><strong>%s</strong> %s</p>',
            esc_html__('Completed In:', 'one-wp'),
            esc_html($project_completion_duration)
        );
    }

    if (!empty($project_estimated_cost)) {
        $html .= sprintf(
            '<p><strong>%s</strong> %s</p>',
            esc_html__('Development Cost:', 'one-wp'),
            esc_html($project_estimated_cost)
        );
    }

    $html .= '</div>';

    return $html;
}


add_shortcode('PROJECT_META', 'one_wp_project_meta_shortcode');


/**
 * @ Post Vote Button Shortcode
 * @since 1.0.0
 * @return string
 */

function one_wp_post_vote_button($atts)
{
    $atts = shortcode_atts(array(
        'like'    => __('Like', 'one-wp'),
        'dislike' => __('Dislike', 'one-wp'),
    ), $atts, 'PROJECT_META');

    $post_id = absint(get_the_ID());

    if (!$post_id || !get_post_status($post_id)) {
        return '<p>' . esc_html__('Invalid Project ID.', 'one-wp') . '</p>';
    }

    // Nonce for AJAX security
    $nonce = wp_create_nonce('one_wp_vote_nonce');

    $html = '<div class="one-wp-voting-buttons">';
    $html .= sprintf(
        '<button type="button" class="one-wp-like-button" data-post-id="%s" data-vote-type="like" data-nonce="%s">%s</button>',
        esc_attr($post_id),
        esc_attr($nonce),
        esc_html($atts['like'])
    );
    $html .= sprintf(
        '<button type="button" class="one-wp-dislike-button" data-post-id="%s" data-vote-type="dislike" data-nonce="%s">%s</button>',
        esc_attr($post_id),
        esc_attr($nonce),
        esc_html($atts['dislike'])
    );
    $html .= '</div>';

    return $html;
}


add_shortcode('VOTING_BUTTONS', 'one_wp_post_vote_button');
