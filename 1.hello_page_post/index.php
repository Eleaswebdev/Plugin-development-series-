<?php
/**
 * Plugin Name: 1.Hello text page and post
 * Plugin URI: https://puredevs.com/
 * Description: This plugins displays hellow world or any text after any page or post
 * Version: 1.0
 * Author: Barry Eleas
 * Author URI: http://puredevs.com/
 **/

function wpdev_before_after($content) {
    $beforecontent = '<h3>This goes before the content. Isn\'t that awesome!|</h3>';
    $aftercontent = '<h5>And this will come after, so that you can remind them of something, like following you on Facebook for instance.</h5>';
    $fullcontent = $beforecontent . $content . $aftercontent;

    return $fullcontent;
}
add_filter('the_content', 'wpdev_before_after');