<?php
/**
 * Plugin Name: 22.custom post type search engine
 * Plugin URI: https://puredevs.com/
 * Description: This plugins  is only applied to single post
 * Version: 1.0
 * Author: Barry Eleas
 * Author URI: http://puredevs.com/
 **/

add_shortcode('countrysearch','countrysearch');
add_shortcode('countrysearchbar','countrysearchbar');

function countrysearch() {
    $args = array(
        'post_type' => 'news',
        's' => esc_sql($_POST['country'])
    );
    $query = new WP_Query( $args );

    while($query->have_posts()) : $query->the_post();
        echo "Country is ".get_the_title()."<br/>";
    endwhile;
    wp_reset_postdata();
}

function countrysearchbar() {
    echo ("
	<form method='post'>
	<input name='country' value='".esc_sql($_POST['country'])."'>
	<input type='submit' value='Search'/>
	</form>
	");
}