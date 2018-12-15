<?php

/**
 * Product Projects Metabox
 */
add_action('add_meta_boxes', function () {
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        add_meta_box('product_project', __('Product Projects', 'hot-projects'), 'product_metabox', array('product'));
    }
    add_meta_box('post_project', __('Post Projects', 'hot-projects'), 'post_metabox', array('post'));
});

function product_metabox($post, $meta)
{
    wp_nonce_field(plugin_basename(__FILE__), 'hot-projects-nonce');

    require plugin_dir_path(__DIR__) . 'views/metaboxes/product-metabox.php';
}

function post_metabox($post, $meta)
{
    wp_nonce_field(plugin_basename(__FILE__), 'hot-projects-nonce');

    require plugin_dir_path(__DIR__) . 'views/metaboxes/post-metabox.php';
}

add_action('save_post', function ($post_id) {
    if (!wp_verify_nonce($_POST['hot-projects-nonce'], plugin_basename(__FILE__))) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, 'hide-projects', $_POST['hide-projects']);
});