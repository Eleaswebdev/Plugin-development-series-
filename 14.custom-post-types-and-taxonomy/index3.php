<?php
/*
Plugin Name: 14.3 Custom post type with capability
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom post types in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/

function register_custom_event_type() {
$labels = array(
'name' => _x('Events', 'event'),
'singular_name' => _x('Event', 'event'),
'add_new' => _x('Add New', 'event'),
'add_new_item' => _x('Add New Event', 'event'),
'edit_item' => _x('Edit Event', 'event'),
'new_item' => _x('New Event', 'event'),
'view_item' => _x('View Event', 'event'),
'search_items' => _x('Search Events', 'event'),
'not_found' => _x('No events found', 'event'),
'not_found_in_trash' => _x('No events found in Trash', 'event'),
'parent_item_colon' => _x('Parent Event:', 'event'),
'menu_name' => _x('Events', 'event'),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'supports' => array('title', 'editor', 'thumbnail', 'author'),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'rewrite' => true,
'capability_type' => 'event',
'capabilities' => array(
'read_post' => 'read_event',
'publish_posts' => 'publish_events',
'edit_posts' => 'edit_events',
'edit_others_posts' => 'edit_others_events',
'delete_posts' => 'delete_events',
'delete_others_posts' => 'delete_others_events',
'read_private_posts' => 'read_private_events',
'edit_post' => 'edit_event',
'delete_post' => 'delete_event',

),
'map_meta_cap' => true
);
register_post_type('event', $args);
}
add_action('init', 'register_custom_event_type');

function add_event_caps() {
    $role = get_role( 'author' );
    $role->add_cap( 'edit_event' );
    $role->add_cap( 'edit_events' );
    $role->add_cap( 'edit_others_events' );
    $role->add_cap( 'publish_events' );
    $role->add_cap( 'read_event' );
    $role->add_cap( 'read_private_events' );
    $role->add_cap( 'delete_event' );
    $role->add_cap( 'edit_published_events' );   //added
    $role->add_cap( 'delete_published_events' ); //added
}
add_action( 'admin_init', 'add_event_caps');


if( !function_exists( 'current_user_has_role' ) ){
    function current_user_has_role( $role ){
        $current_user = new WP_User( wp_get_current_user()->ID );
        $user_roles = $current_user->roles;
        $is_or_not = in_array( $role, $user_roles );
        return $is_or_not;
    }
}
