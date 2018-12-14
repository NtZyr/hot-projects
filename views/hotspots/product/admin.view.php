<?php

/**
 * Product Hotspot Admin form
 * 
 * @param string $fields['product_id']
 * 
 */
$products = get_posts(array(
    'post_type' => 'product'
));

if ($products) {
    ?>
<select class="hotspot-field" data-field="product_id" name="hotspots[<?= $num ?>][fields][product_id]">
    <?php foreach ($products as $product) : ?>
    <option <?= $fields['product_id'] == $product->ID ? 'selected' : ''; ?> value="<?= $product->ID ?>"><?= $product->post_title ?></option>
    <?php endforeach; ?>
</select>

<?php

} else {
    ?>
<span><?= __('No products found', 'hot-projects') ?></span>
<?php

}