<?php

/**
 * Project Area in Wordpress Editor
 */
add_action('edit_form_after_title', function () {
    if (get_post_type() == 'project') {
        global $post;

        require plugin_dir_path(__DIR__) . 'views/admin/project-area.view.php';
    }
});