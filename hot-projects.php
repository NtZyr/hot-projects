<?php

/**
 * Hot Projects
 * 
 * @package HotProject
 * @author Vladislav Surikov
 * @copyright Crop Cirlces
 * @license GPL-2.0+
 * 
 * @wordpress-plugin
 * 
 * Plugin Name: Hot Projects
 * Description: Plugin for creating the hottest projects
 * Version: 0.1
 * Author: Vladislav Surikov
 * Author URI: http://cropcircles.ru
 * Text Domain: hot-projects
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

require plugin_dir_path(__FILE__) . 'inc/post-type.php';            // register post type & texonomy
require plugin_dir_path(__FILE__) . 'inc/project-area.php';         // register project area before editor
require plugin_dir_path(__FILE__) . 'inc/admin-hotspot-form.php';
require plugin_dir_path(__FILE__) . 'inc/get_hotspot.php';
require plugin_dir_path(__FILE__) . 'inc/post-type-projects-metaboxes.php';

require plugin_dir_path(__FILE__) . 'assets/admin.php';
