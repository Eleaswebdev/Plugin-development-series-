<?php
/*
Plugin Name: 9. shortcode plugin1 By Puredevs
Plugin URI: http://www.puredevs.com
Description: Add [book] to any post or page and it replace your text with your custom link or content
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */
// register font awesome-icon from CDN
add_action( 'wp_enqueue_scripts', 'pure_font_styles' );
function pure_font_styles() {
    wp_register_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
    wp_enqueue_style( 'fontawesome' );
}
// Register a new shortcode: [book]
 add_shortcode( 'book', 'replace_book' );
 // The callback function that will replace [book]
function replace_book(){
    return   '<a href="https://www.facebook.com/eleas.kanchon.56">Follow on facebook</a>';
    }
    ?>