<?php

// Basic Shortcode Example

function one_wp_hello_world_shortcode()
{
    return '<h2>Hello, World! This is a shortcode from One WP plugin.</h2>';
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