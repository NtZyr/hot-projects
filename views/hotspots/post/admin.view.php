<?php

/**
 * Post Hotspot Admin form
 * 
 * @param string $fields['post_id']
 * 
 */
$posts = get_posts(array(
    'post_type' => 'post'
));

if ($posts) {
    ?>
<select class="hotspot-field" data-field="post_id" name="hotspots[<?= $num ?>][fields][post_id]">
    <?php foreach ($posts as $post) : ?>
    <option <?= $fields['post_id'] == $product->ID ? 'selected' : ''; ?> value="<?= $post->ID ?>"><?= $post->post_title ?></option>
    <?php endforeach; ?>
</select>

<?php

} else {
    ?>
<span><?= __('No posts found', 'hot-projects') ?></span>
<?php

}