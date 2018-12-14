<?php

/**
 * Admin assets is here
 */
add_action('admin_enqueue_scripts', function () {
    global $post;
    if ($post->post_type != 'project') return;

    $project_hotspots = get_post_meta($post->ID, 'hotspots', true);

    wp_enqueue_style('project-area-css', plugin_dir_url(__DIR__) . 'assets/admin/css/project-area.css', false);
    wp_enqueue_script('project-area-js', plugin_dir_url(__DIR__) . 'assets/admin/js/project-area.js', array('jquery'));
    wp_localize_script('project-area-js', 'hotspotModalLabel', __('Create Hotspot', 'hot-projects'));

    if (is_array($project_hotspots)) {
        wp_localize_script('project-area-js', 'project_hotspots', (array)$project_hotspots);
    }
    wp_enqueue_script('jquery-ui-dialog'); // jquery and jquery-ui should be dependencies, didn't check though...
    wp_enqueue_style('wp-jquery-ui-dialog');
});