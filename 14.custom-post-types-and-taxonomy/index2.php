<?php
/*
Plugin Name: 14.2 Custom post type games
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom post types in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/
function easytuts_games_post() {
$labels = array(
'name'               => _x( 'Games', 'post type general name' ),
'singular_name'      => _x( 'Game', 'post type singular name' ),
'add_new'            => _x( 'Add New', 'game' ),
'add_new_item'       => __( 'Add New Games' ),
'edit_item'          => __( 'Edit Game' ),
'new_item'           => __( 'New Game' ),
'all_items'          => __( 'All Games' ),
'view_item'          => __( 'View Game' ),
'search_items'       => __( 'Search Games' ),
'not_found'          => __( 'No game found' ),
'not_found_in_trash' => __( 'No game found in the Trash' ),
'parent_item_colon'  => '',
'menu_name'          => 'Games'
);
$args = array(
'labels'        => $labels,
'description'   => 'Holds games and game specific data',
'public'        => true,
'menu_position' => 5,
'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
'has_archive'   => true,
);
register_post_type( 'games', $args );
}
add_action( 'init', 'easytuts_games_post' );
function easytuts_taxonomies_games() {
$labels = array(
'name'              => _x( 'Game Categories', 'taxonomy general name' ),
'singular_name'     => _x( 'Game Category', 'taxonomy singular name' ),
'search_items'      => __( 'Search Game Categories' ),
'all_items'         => __( 'All Games Categories' ),
'parent_item'       => __( 'Parent Game Category' ),
'parent_item_colon' => __( 'Parent Game Category:' ),
'edit_item'         => __( 'Edit Game Category' ),
'update_item'       => __( 'Update Game Category' ),
'add_new_item'      => __( 'Add New Game Category' ),
'new_item_name'     => __( 'New Game Category' ),
'menu_name'         => __( 'Game Categories' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
);
register_taxonomy( 'leagues', 'games', $args );
}
add_action( 'init', 'easytuts_taxonomies_games', 0 );