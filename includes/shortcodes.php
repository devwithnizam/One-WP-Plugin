<?php

/**
 * @ Post Vote Button Shortcode
 * @since 1.0.0
 * @return string
 */

function one_wp_post_vote_button($atts)
{
    $atts = shortcode_atts(array(
        'like' => 'Like',
        'dislike' => 'Dislike',
    ), $atts, 'PROJECT_META');

    $post_id = get_the_ID();
    $user_id = get_current_user_id();

    $html = '<div class="one-wp-voting-buttons">';
    $html .= sprintf(
        '<button class="one-wp-like-button" data-post-id="%s" data-user-id="%s" data-vote-type="like">%s</button>',
        esc_attr($post_id),
        esc_attr($user_id),
        esc_html($atts['like'])
    );
    $html .= sprintf(
        '<button class="one-wp-dislike-button" data-post-id="%s" data-user-id="%s" data-vote-type="dislike">%s</button>',
        esc_attr($post_id),
        esc_attr($user_id),
        esc_html($atts['dislike'])
    );
    $html .= '</div>';

    return $html;
}

add_shortcode('VOTING_BUTTONS', 'one_wp_post_vote_button');
