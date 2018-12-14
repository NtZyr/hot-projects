<?php

/**
 * Post Hotspot Admin form
 * 
 * @param string $fields['title']
 * @param string $fields['text']
 * 
 */
?>
<input value="<?= $fields['title'] ? $fields['title'] : '' ?>" class="hotspot-field" data-field="title" name="hotspots[<?= $num ?>][fields][title]"><br>
<textarea class="hotspot-field" data-field="text" name="hotspots[<?= $num ?>][fields][text]" cols="30" rows="10">
<?= $fields['text'] ? $fields['text'] : '' ?>
</textarea>