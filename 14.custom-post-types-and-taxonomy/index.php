<?php
/*
Plugin Name: 14.Custom post type news with taxonomy
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom post types in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/
/* Custom Post Type Start */
function create_posttype() {
    register_post_type( 'news',
// CPT Options
        array(
                'labels' => array(
                'name' => __( 'news' ),
                'singular_name' => __( 'News' )
            ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'news'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

/*Custom Post type start*/
function cw_post_type_news() {
    $supports = array(
                    'title', // post title
                    'editor', // post content
                    'author', // post author
                    'thumbnail', // featured images
                    'excerpt', // post excerpt
                    'custom-fields', // custom fields
                    'comments', // post comments
                    'revisions', // post revisions
                    'post-formats', // post formats
                    //'trackbacks', //Shows whether trackbacks and pingbacks will be enabled for posts of this type.
                    //'page-attributes' // Displays the attributes box for choosing the post order. The
                    // hierarchical  argument must be set to  true  for this to work

    );
    $labels = array(
                    'name' => _x('News', 'plural'),
                    'singular_name' => _x('news', 'singular'),
                    'menu_name' => _x('Custom news', 'admin menu'),
                    'name_admin_bar' => _x('news', 'admin bar'),
                    'add_new' => _x('Add New', 'add new'),
                    'add_new_item' => __('Add New news'),
                    'new_item' => __('New news'),
                    'edit_item' => __('Edit news'),
                    'view_item' => __('View news'),
                    'all_items' => __('All news'),
                    'search_items' => __('Search news'),
                    'not_found' => __('No news found.'),
    );
    $args = array(
                        'supports' => $supports,
                        'labels' => $labels,
                        'public' => true,
                        'taxonomies' => array('category', 'post_tag', 'page-category'),
                        'query_var' => true,
                        'rewrite' => array('slug' => 'news'), // If set to  true , it will create permalinks from the  query_var  argument and the individual post title.
                                                                    // If set to  false , no permalink structure will be created.
                        'has_archive' => true,
                        'hierarchical' => false,
                        //'show_ui' => true,  //if we don not set show_ui it default value is public argument but if we set it false not display
                        //'exclude_from_search' => true,  //if we set it true then we can not find the post by searching.
                       // 'taxonomies'  =>  array( 'post_tag'), //allows to add existing taxonomy
                        //'menu_position'  => 65,  //below plugins
                        'menu_icon' =>'dashicons-video-alt',
    );

    register_post_type('news', $args);
}
add_action('init', 'cw_post_type_news');

//***************************************Taxonomies Start**********************************************
/* Set up the taxonomies. */
add_action( 'init', 'boj_music_collection_register_taxonomies');
/* Registers taxonomies. */
function boj_music_collection_register_taxonomies() {
    /* Set up the artist taxonomy arguments. */
    $artist_args = array(
                'hierarchical' =>  false,
                'query_var' =>  'album_artist',
                'show_tagcloud' =>  true,
                'rewrite' =>  array(
                'slug' =>  'music/artists',
                'with_front' =>  false
            ),
            'labels' =>  array(
                    'name' =>  'Artists',
                    'singular_name' =>  'Artist',
                    'edit_item' =>  'Edit Artist',
                    'update_item' =>  'Update Artist',
                    'add_new_item' =>  'Add New Artist',
                    'new_item_name' =>  'New Artist Name',
                    'all_items' =>  'All Artists',
                    'search_items' =>  'Search Artists',
                    'popular_items' =>  'Popular Artists',
                    'separate_items_with_commas' =>  'Separate artists with commas',
                    'add_or_remove_items' =>  'Add or remove artists',
                    'choose_from_most_used' =>  'Choose from the most popular artists',
                ),
        );
    /* Set up the genre taxonomy arguments. */
    $genre_args = array(
                        'hierarchical' =>  true,
                        'query_var' =>  'album_genre',
                        'show_tagcloud' =>  true,
                        'rewrite' =>  array(
                        'slug' => 'music/genres',
                        'with_front' =>  false
            ),
            'labels' =>  array(
                        'name' =>  'Genres',
                        'singular_name' =>  'Genre',
                        'edit_item' =>  'Edit Genre',
                        'update_item' =>  'Update Genre',
                        'add_new_item' =>  'Add New Genre',
                        'new_item_name' =>  'New Genre Name',
                        'all_items' =>  'All Genres',
                        'search_items' =>  'Search Genres',
                        'parent_item' =>  'Parent Genre',
                        'parent_item_colon' =>  'Parent Genre:',
),
);
    /* Register the album artist taxonomy. */
    register_taxonomy( 'album_artist', array( 'news' ), $artist_args );
    /* Register the album genre taxonomy. */
    register_taxonomy( 'album_genre', array( 'news' ), $genre_args );
}


