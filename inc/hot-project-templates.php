<?php

/**
 * Hot Projects Templates
 */
add_filter('single_template', function ($single_template) {
    global $post;
    $object = get_queried_object();

    if ($post->post_type == 'project') {
        if (file_exists(locate_template('hot-projects/single-project.php'))) {
            $single_template = locate_template('hot-projects/single-project.php');
        } else {
            $single_template = plugin_dir_path(__DIR__) . 'views/templates/single-project.php';
        }
    }
    return $single_template;
}, 10, 1);