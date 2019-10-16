<?php
/*
Plugin Name: 9.7 DISPLAY google map and chart
Plugin URI: http://www.puredevs.com
Description: DISPLAY  google map and chart
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */
function pure_googlemap_function($atts, $content = null) {
    extract(shortcode_atts(array(
        "width" => '640',
        "height" => '480',
        "src" => ''
    ), $atts));
    return '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe>';
}
add_shortcode("googlemap", "pure_googlemap_function");

function pure_chart_function( $atts ) {
    extract(shortcode_atts(array(
        'data' => '',
        'chart_type' => 'pie',
        'title' => 'Chart',
        'labels' => '',
        'size' => '640x480',
        'background_color' => 'FFFFFF',
        'colors' => '',
    ), $atts));

    switch ($chart_type) {
        case 'line' :
            $chart_type = 'lc';
            break;
        case 'pie' :
            $chart_type = 'p3';
            break;
        default :
            break;
    }

    $attributes = '';
    $attributes .= '&chd=t:'.$data.'';
    $attributes .= '&chtt='.$title.'';
    $attributes .= '&chl='.$labels.'';
    $attributes .= '&chs='.$size.'';
    $attributes .= '&chf='.$background_color.'';
    $attributes .= '&chco='.$colors.'';

    return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$chart_type.''.$attributes.'" alt="'.$title.'" />';
}
add_shortcode('chart', 'pure_chart_function');
?>