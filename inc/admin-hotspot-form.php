<?php

/**
 * Admin Hotspot Form
 * 
 * @param int $num
 * @param float $hotspotX
 * @param float $hotspotY
 * @param string $type
 * @param array $fields
 */
function admin_hotspot_form($num = 0, $hotspotX, $hotspotY, $type, $fields = null)
{
    ?>
    <div class="hotspot" data-num="<?= $num ?>" data-hotspotX="<?= $hotspotX ?>" data-hotspotY="<?= $hotspotY ?>">
        <span class="point"></span>
        <div class="hotspot-form">
            <ul class="hotspot-controls">
                <li><a class="hotspot-remove" href="#">Remove</a></li>
            </ul>
            <div>
                <input type="hidden" value="<?= $hotspotX ?>" name="hotspots[<?= $num ?>][hotspotX]">
                <input type="hidden" value="<?= $hotspotY ?>" name="hotspots[<?= $num ?>][hotspotY]">
                <input type="hidden" value="<?= $type ?>" name="hotspots[<?= $num ?>][type]">
    
                <?php require plugin_dir_path(__DIR__) . 'views/hotspots/' . $type . '/admin.view.php'; ?>
            </div>
        </div>
    </div>
<?php

}
