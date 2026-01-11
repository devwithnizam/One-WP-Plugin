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


/**
 * @ Public Api Testing Shortcode
 */

function one_wp_api_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'user' => 'devwithnizam',
    ), $atts, 'API_TEST');

    $user = sanitize_text_field($atts['user']);
    $url  = 'https://api.github.com/users/' . rawurlencode($user);

    $response = wp_remote_get($url, array(
        'timeout' => 30,
        'headers' => array(
            'User-Agent' => 'WordPress'
        )
    ));

    if (is_wp_error($response)) {
        return '<p>' . esc_html__('Failed to fetch data from API.', 'one-wp') . '</p>';
    }

    $response_code = wp_remote_retrieve_response_code($response);

    if ($response_code !== 200) {
        return '<p>' . esc_html__('Failed to fetch data from API.', 'one-wp') . '</p>';
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!is_array($data)) {
        return '<p>' . esc_html__('Invalid response from API.', 'one-wp') . '</p>';
    }

    $html  = '<div class="one-wp-github-card">';
    $html .= sprintf(
        '<img src="%s" alt="%s" class="github-avatar">',
        esc_url($data['avatar_url']),
        esc_attr($data['login'])
    );
    $html .= '<div class="github-content">';
    $html .= sprintf('<h3>%s</h3>', esc_html($data['name'] ?: $data['login']));
    $html .= sprintf('<p class="github-username">@%s</p>', esc_html($data['login']));

    if (!empty($data['bio'])) {
        $html .= sprintf('<p class="github-bio">%s</p>', esc_html($data['bio']));
    }

    $html .= '<div class="github-stats">';
    $html .= sprintf('<span>⭐ %s Repos</span>', esc_html($data['public_repos']));
    $html .= sprintf('<span>👥 %s Followers</span>', esc_html($data['followers']));
    $html .= sprintf('<span>➡️ %s Following</span>', esc_html($data['following']));
    $html .= '</div>';

    $html .= sprintf(
        '<a href="%s" target="_blank" rel="noopener noreferrer" class="github-profile-link">%s</a>',
        esc_url($data['html_url']),
        esc_html__('View GitHub Profile', 'one-wp')
    );

    $html .= '</div></div>';

    return $html;
}
add_shortcode('API_TEST', 'one_wp_api_shortcode');

/**
 * @ Api Authentication Test Shortcode
 */

function one_wp_api_auth_shortcode()
{
    $cache_key = 'one_wp_random_quote';
    $data = get_transient($cache_key);

    if (false === $data) {
        $url  = 'https://quotes-api15.p.rapidapi.com/quotes/category/success';

        $response = wp_remote_get($url, array(
            'timeout' => 30,
            'headers' => array(
                'User-Agent' => 'WordPress',
                'x-rapidapi-host' => 'quotes-api15.p.rapidapi.com',
                'x-rapidapi-key' => 'fffbd1cb2dmsh80f172add951253p15e2abjsn57c663a8b97b'
            )
        ));

        if (is_wp_error($response)) {
            return '<p>' . esc_html__('Failed to fetch data from API.', 'one-wp') . '</p>';
        }

        $response_code = wp_remote_retrieve_response_code($response);

        if ($response_code !== 200) {
            return '<p>' . esc_html__('Failed to fetch data from API.', 'one-wp') . '</p>';
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (!is_array($data)) {
            return '<p>' . esc_html__('Invalid response from API.', 'one-wp') . '</p>';
        }

        set_transient($cache_key, $data, 60 * 60); // Cache for 1 hour
    }

    $html  = '<div class="one-wp-quote-card">';
    $html .= '<p class="quote-text">“' . esc_html($data['quote']) . '”</p>';
    $html .= '<div class="quote-footer">';
    $html .= '<span class="quote-author">— ' . esc_html($data['author']) . '</span>';
    $html .= '<span class="quote-category">' . esc_html($data['category']) . '</span>';
    $html .= '</div></div>';

    return $html;
}
add_shortcode('API_AUTH_TEST', 'one_wp_api_auth_shortcode');
