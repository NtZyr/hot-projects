<?php

/**
 * Register Project Post Type
 */
if (!post_type_exists('projects')) {
    add_action('init', function () {
        $labels = array(
            'name' => _x('Projects', 'post type general name', 'hot-projects'),
            'singular_name' => _x('Project', 'post type singular name', 'hot-projects'),
            'menu_name' => _x('Projects', 'admin menu', 'hot-projects'),
            'name_admin_bar' => _x('Project', 'add new on admin bar', 'hot-projects'),
            'add_new' => _x('Add New', 'Project', 'hot-projects'),
            'add_new_item' => __('Add New Project', 'hot-projects'),
            'new_item' => __('New Project', 'hot-projects'),
            'edit_item' => __('Edit Project', 'hot-projects'),
            'view_item' => __('View Project', 'hot-projects'),
            'all_items' => __('All Projects', 'hot-projects'),
            'search_items' => __('Search Projects', 'hot-projects'),
            'parent_item_colon' => __('Parent Projects:', 'hot-projects'),
            'not_found' => __('No Projects found.', 'hot-projects'),
            'not_found_in_trash' => __('No Projects found in Trash.', 'hot-projects')
        );

        $args = array(
            'label' => 'Projects',
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_nav_menus' => true,
            '_builtin' => false,
            'has_archive' => true
        );

        register_post_type('project', $args);
    });

    add_action('save_post', function ($post_id) {
        global $post;
        if ($post->post_type != 'project') return;

        update_post_meta($post_id, 'hotspots', $_POST['hotspots']);
    });
}

/**
 * Register Project Group Taxonomy
 */
if (!taxonomy_exists('project-group')) {
    add_action('init', function () {
        $labels = array(
            'name' => _x('Project Groups', 'taxonomy general name', 'hot-projects'),
            'singular_name' => _x('Project Group', 'taxonomy singular name', 'hot-projects'),
            'search_items' => __('Search Project Groups', 'hot-projects'),
            'all_items' => __('All Project Groups', 'hot-projects'),
            'parent_item' => __('Parent Project Group', 'hot-projects'),
            'parent_item_colon' => __('Parent Project Group:', 'hot-projects'),
            'edit_item' => __('Edit Project Group', 'hot-projects'),
            'update_item' => __('Update Project Group', 'hot-projects'),
            'add_new_item' => __('Add New Project Group', 'hot-projects'),
            'new_item_name' => __('New Project Group Name', 'hot-projects'),
            'menu_name' => __('Project Group', 'hot-projects'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true
        );

        register_taxonomy('project-group', array('project'), $args);
    });
}

/**
 * Project Group Thumbnail
 * @param object $project_group
 */
add_action('project-group_edit_form_fields', function ($project_group) {
    $project_group_id = $project_group->term_id;
    $project_group_thumbnail = get_option('taxonomy_term_project-group_thumbnail');

    $projects = get_posts(array(
        'post_type' => 'project',
        'tax_query' => array(
            'taxonomy' => 'project-group',
            'field' => 'term_id',
            'terms' => $project_group_id
        )
    ));
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for=""><?= __('Set project group thumbnail: ', 'hot-projects') ?></label>
        </th>
        <td>
            <?php 
            if (count($projects) < 1) :
                echo __('No projects in this project group');
            else : ?>
                <select name="term_meta" id="">
                    <?php foreach ($projects as $project) : ?>
                        <option value="<?= $project->ID ?>"><?= $project->post_title ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </td>
    </tr>
<?php 
}, 10, 2); 