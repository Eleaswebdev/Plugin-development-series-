<?php
/*
Plugin Name: 9.5 DISPLAY recent post
Plugin URI: http://www.puredevs.com
Description: DISPLAY ALL RECENT post
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */

function pure_recent_posts_function($atts, $content = null){
    extract(shortcode_atts(array(
        'posts' => 6,
    ), $atts));

    $return_string = '<h3>'.$content.'</h3>';
    $return_string .= '<ul>';
    query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
    if (have_posts()) :
        while (have_posts()) : the_post();
            $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().' <br/> '.get_the_author().' 
           <br/> '.get_the_excerpt().'</a></li>';
        endwhile;
    endif;
    $return_string .= '</ul>';

    wp_reset_query();  //Destroys the previous query and sets up a new query.This should be used after query_posts() and before another query_posts().
    return $return_string;
}
function pure_register_shortcodes(){
    add_shortcode('recent-posts', 'pure_recent_posts_function');
}

add_action( 'init', 'pure_register_shortcodes');
add_filter('widget_text', 'do_shortcode');

//add_filter( 'comment_text', 'do_shortcode' );
//add_filter( 'the_excerpt', 'do_shortcode');
?>

