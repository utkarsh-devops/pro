<?php
/*
Plugin Name: Slider
Plugin URI: http://www.webonise.com
Description: Add image and content for slider.
Version: 1.0
Author: Simanchala Kuamr Pradhan
Author URI: http://www.webonise.com
*/

function slider_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "sliders";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            type VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            image VARCHAR(500) NOT NULL,
            content VARCHAR(1000) NOT NULL,
            UNIQUE KEY id (id)
            );";
        $wpdb->query($sql);
    }
    $table_name = $wpdb->prefix . "media_sliders";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            image1 VARCHAR(500) NOT NULL,
            image2 VARCHAR(500) NOT NULL,
            image3 VARCHAR(500) NOT NULL,
            image4 VARCHAR(500) NOT NULL,
            image5 VARCHAR(500) NOT NULL,
            image6 VARCHAR(500) NOT NULL,
            image7 VARCHAR(500) NOT NULL,
            image8 VARCHAR(500) NOT NULL,
            UNIQUE KEY id (id)
            );";
        $wpdb->query($sql);
    }
    if ($wpdb->get_var("SHOW COLUMNS FROM $table_name LIKE 'type'") != 'type') {

        $sql = "ALTER TABLE $table_name ADD type VARCHAR(255) NOT NULL;";
        $wpdb->query($sql);
    }
    for($i=1; $i<=8; $i++){
        $colName = "caption".$i;
        if ($wpdb->get_var("SHOW COLUMNS FROM $table_name LIKE $colName") != $colName) {

            $sql = "ALTER TABLE $table_name ADD $colName VARCHAR(500) NOT NULL;";
            $wpdb->query($sql);
        }
    }


}
register_activation_hook(__FILE__, 'slider_create_table');
add_action('admin_menu', 'slider_menu');

function slider_menu()
{
    add_menu_page('Sliders', 'Sliders', 'list_users', 'home_slider', 'home_sliders', '', '84');
    add_submenu_page('home_slider','Media Slider', 'Media Sliders', 'list_users', 'media_slider', 'media_sliders');
    add_submenu_page('home_slider','Foundation Slider', 'Foundation Sliders', 'list_users', 'foundation_slider', 'home_sliders');
    add_submenu_page('home_slider','Photo Gallery', 'Photo Gallery', 'list_users', 'photo_gallery', 'media_sliders');
}

function home_sliders(){
    global $wpdb;
    $table_name = $wpdb->prefix . "sliders";
    require_once('home_slider.php');
}
function media_sliders(){
    global $wpdb;
    $table_name = $wpdb->prefix . "sliders";
    require_once('media_slider.php');
}
