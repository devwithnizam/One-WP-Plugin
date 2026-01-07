<?php

function one_wp_settings_page()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "one_wp"
            settings_fields('one_wp');
            // output setting sections and their fields
            // (sections are registered for "one_wp", each field is registered to a specific section)
            do_settings_sections('one_wp');
            // output save settings button
            submit_button(__('Save Settings', 'one-wp'));
            ?>
        </form>
    </div>
<?php
}

function one_wp_settings_subpage()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "one_wp"
            settings_fields('one_wp_subpage');
            // output setting sections and their fields
            // (sections are registered for "one_wp_subpage", each field is registered to a specific section)
            do_settings_sections('one_wp_subpage');
            // output save settings button
            submit_button(__('Save Settings', 'one-wp'));
            ?>
        </form>
    </div>
<?php
}
