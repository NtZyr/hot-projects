<?php

/**
 * Hotspot Form Wrapper
 * 
 * @param request $_POST['num]
 * @param request $_POST['hotspotX]
 * @param request $_POST['hotspotY]
 * @param request $_POST['type]
 * @param request $_POST['fields]
 * 
 * @return function
 */
function get_hotspot()
{
    $num = $_POST['num'] ? $_POST['num'] : 0;
    $hotspotX = $_POST['hotspotX'];
    $hotspotY = $_POST['hotspotY'];
    $type = $_POST['type'];
    $fields = $_POST['fields'] ? $_POST['fields'] : '';

    admin_hotspot_form($num, $hotspotX, $hotspotY, $type, $fields);

    wp_die();
}

add_action('wp_ajax_get_hotspot', 'get_hotspot');