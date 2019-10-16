<?php
/*
Plugin Name: 9.8 DISPLAY pdf file
Plugin URI: http://www.puredevs.com
Description: DISPLAY pdf file
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */

function pure_pdf_function($attr, $url) {
    extract(shortcode_atts(array(
        'width' => '640',
        'height' => '480'
    ), $attr));
    return '<iframe src="http://docs.google.com/viewer?url=' . $url . '&embedded=true" style="width:' .$width. '; height:' .$height. ';">Your browser does not support iframes</iframe>';
}
add_shortcode('pdf', 'pure_pdf_function');