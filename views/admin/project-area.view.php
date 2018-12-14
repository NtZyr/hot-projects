<?php

/**
 * Project Area View
 * 
 * Use post thumbnail for display $project_image
 */
if (!get_the_post_thumbnail($post->ID)) : ?>
    <span class="tip"> <?= __('Set your project image in "Featured Image" and update', 'hot-projects') ?> </span>
<?php else : $project_image = get_the_post_thumbnail($post->ID, 'large'); ?>
        <span class="tip"><?= __('Click on the need place on image to create hotspot', 'hot-projects') ?></span>
<?php endif; ?>
<div id="project-area">
    <?= $project_image ?>
</div>
<div id="hotspot-modal">
    <input type="hidden" name="hotspotX">
    <input type="hidden" name="hotspotY">
    <select name="hotspot-type">
        <?php if (is_plugin_active('woocommerce/woocommerce.php')) : ?>
        <option value="product"><?= __('Product', 'hot-project'); ?></option>
        <?php endif; ?>
        <option value="text"><?= __('Text', 'hot-project'); ?></option>
        <option value="post"><?= __('Post', 'hot-project'); ?></option>
    </select><br>
    <button id="hotspot-create" class="button button-primary button-large" type="button"><?= __('Create', 'hot-projects') ?></button>
</div>