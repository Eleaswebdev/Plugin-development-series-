<?php
/**
 * Plugin Name: 23.post rating plugin
 * Plugin URI: https://puredevs.com/
 * Description: This plugins  is only applied to single post
 * Version: 1.0
 * Author: Barry Eleas
 * Author URI: http://puredevs.com/
 **/

add_shortcode('cmi-star-rating','cmi_show_stars');

function cmi_show_stars($atts)
{
    $a = shortcode_atts( array(
        'number' => '3',
    ), $atts );

    $number_of_stars = $a['number'];

    if($number_of_stars=='1')
    {
        $bgcolor = '#F99';
        $icon 		= '<img width="40" src="http://www.freeiconspng.com/uploads/warning-icon-5.png"/>';
    } elseif($number_of_stars=='2' || $number_of_stars=='3') {
        $bgcolor = '#FF0';
        $icon = '';
    } else {
        $bgcolor = '#9F9';
        $icon 		= '<img width="40" src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/128/tick_green.png"/>';
    }

    return ("
	 <div style='padding:10px; border-radius:5px; font-size:16pt; background:$bgcolor; width:100%; margin-bottom:20px;'>
	 $icon
	 Crazy Money Ideas Rating: 
	 $number_of_stars out of 5 stars
	 </div>
	 ");
}
