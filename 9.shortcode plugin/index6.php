<?php
/*
Plugin Name: 9.6 DISPLAY wp menu
Plugin URI: http://www.puredevs.com
Description: DISPLAY  wp menu
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */
function menu_function($atts, $content = null) {
    extract(
        shortcode_atts(
            array( 'name' => null, ),
            $atts
        )
    );
    return wp_nav_menu(
        array(
            'menu' => $name,
            'echo' => false
        )
    );
}
add_shortcode('menu', 'menu_function');
?>