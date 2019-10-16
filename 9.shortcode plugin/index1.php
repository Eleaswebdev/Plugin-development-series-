<?php
/*
Plugin Name: 9.1 shortcode chose options By Puredevs
Plugin URI: http://www.puredevs.com
Description: Now you can choose what button to display by defining type in your shortcode.
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */

function pure_button_shortcode($type) {
    extract(shortcode_atts(array(
        'type' => 'type'
    ), $type));

    // check what type user entered
    switch ($type) {
        case 'twitter':
            return '<a href="http://twitter.com/filipstefansson" class="twitter-button">Follw me on Twitter!</a>';
            break;
        case 'rss':
            return '<a href="http://example.com/rss" class="rss-button">Subscribe to the feed!</a>';
            break;
    }
}
add_shortcode('button', 'pure_button_shortcode');
?>