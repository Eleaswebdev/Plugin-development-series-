<?php
/*
Plugin Name: 14.1 Custom post type services
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom post types in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/

add_action('init', 'custom_post_type_func');
function custom_post_type_func()
{
    //posttypename = services
    $labels = array(
        'name' => _x('Services', 'services'),
        'singular_name' => _x('services', 'services'),
        'add_new' => _x('Add New', 'services'),
        'add_new_item' => _x('Add New services', 'services'),
        'edit_item' => _x('Edit services', 'services'),
        'new_item' => _x('New services', 'services'),
        'view_item' => _x('View services', 'services'),
        'search_items' => _x('Search services', 'services'),
        'not_found' => _x('No services found', 'services'),
        'not_found_in_trash' => _x('No services found in Trash', 'services'),
        'parent_item_colon' => _x('Parent services:', 'services'),
        'menu_name' => _x('Services', 'services'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Hi, this is my custom post type.',
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
        'taxonomies' => array('category', 'post_tag', 'page-category'),
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
        'capability_type' => 'post'
    );
    register_post_type('services', $args);
}