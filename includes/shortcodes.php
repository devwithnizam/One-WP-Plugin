<?php

// Basic Shortcode Example

function one_wp_hello_world_shortcode()
{
    $db_value = get_option('one_wp_setting_name');
    if (!empty($db_value)) {
        return $db_value;
    }
    return 'Hello, World!';
}
add_shortcode('ONE_HELLO', 'one_wp_hello_world_shortcode');

// Enclosing Shortcode Example

function one_wp_enclosing_shortcode($attrs = array(), $content)
{
    return '<div class="one-wp-enclosed-content" style="border: 2px solid #000; padding: 10px; margin: 10px 0;">' . $content . '</div>';
}

add_shortcode('ONE_ENCLOSE', 'one_wp_enclosing_shortcode');

// Shortcode with Attributes Example
function one_wp_attributed_shortcode($attrs = array())
{
    $attrs = shortcode_atts(
        array(
            'label' => 'Click Here',
            'url'   => 'https://www.facebook.com/devwithnizam',
        ),
        $attrs
    );

    $html = '<a href="' . $attrs['url'] . '" class="one-wp-attributed-link" style="color: blue; text-decoration: underline;">';
    $html .= $attrs['label'];
    $html .= '</a>';
    return $html;
}
add_shortcode('ONE_ATTR', 'one_wp_attributed_shortcode');


// Shortcode with Output Buffering Example
function ONE_ATTR_shortcode($atts)
{
    if (!empty($atts)) {
        $atts = shortcode_atts(array(
            'label' => 'Click Here',
            'link'  => '#'
        ), $atts, 'ONE_ATTR_OUTPUT');
    } else {
        $atts = null;
    }

    ob_start();
?>
    <div class="ONE_ATTR-shortcode">
        <?php if (!empty($atts)) : ?>
            <a href="<?php echo esc_url($atts['link']); ?>" class="ONE_ATTR-link" style="color: green; font-weight: bold;">
                <?php echo esc_html($atts['label']); ?>
            </a>
        <?php else : ?>
            <p>No attributes provided.</p>
        <?php endif; ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('ONE_ATTR_OUTPUT', 'ONE_ATTR_shortcode');

/**
 *  Project Meta Information Shortcode
 */

function one_wp_project_meta_shortcode($atts)
{
    $attrs = shortcode_atts(
        array(
            'id' => get_the_ID(),
        ),
        $atts,
        'ONE_PROJECT_META'
    );


    $project_url = get_post_meta($attrs['id'], 'project_url', true);
    $project_completion = get_post_meta($attrs['id'], 'project_completion_duration', true);
    $project_cost = get_post_meta($attrs['id'], 'project_estimated_cost', true);

    ob_start();
?>
    <div class="one-wp-project-meta" style="border: 1px solid #000; padding: 10px; margin: 10px 0;">
        <p><strong>Project URL:</strong> <a href="<?php echo esc_url($project_url); ?>"><?php echo esc_url($project_url); ?></a></p>
        <p><strong>Completion Duration:</strong> <?php echo esc_html($project_completion); ?></p>
        <p><strong>Estimated Cost:</strong> <?php echo esc_html($project_cost); ?></p>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('ONE_PROJECT_META', 'one_wp_project_meta_shortcode');
