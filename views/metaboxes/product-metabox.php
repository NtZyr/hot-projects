<?php

/**
 * Product Projects Metabox View
 */
$product_id = $post->ID;
// var_dump($product_id);
$args = array(
    'post_type' => 'project'
);

$projects = [];
$all_projects = get_posts($args);

foreach ($all_projects as $project) {
    $hotspots = get_post_meta($project->ID, 'hotspots', true);
    foreach ($hotspots as $hotspot) {
        if (in_array($product_id, $hotspot['fields']) && !in_array($project, $projects)) {
            $projects[] = $project;
        }
    }
}
?>
<?php if ($projects) : ?>
<div>
    <label>
        <?= __('Hide projects', 'hot-projects') ?>
        <input <?= get_post_meta($post->ID, 'hide-projects', true) == true ? 'checked' : '' ?> value="true" type="checkbox" name="hide-projects">
    </label>
</div>
<h3><?= __('This product presents in next projects', 'hot-projects') ?></h3>
<ul>
    <?php foreach ($projects as $project) : ?>
        <li><?= $project->post_title ?></li>
    <?php endforeach; ?>
</ul>
<?php else : ?>
    <p><?= __('This project doesn\'t used in any projects', 'hot-projects') ?></p>
<?php endif; ?>