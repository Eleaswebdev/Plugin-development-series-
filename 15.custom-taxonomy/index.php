<?php
/*
Plugin Name: 15 Custom taxonomy
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom taxonomies in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/
add_action( 'init', 'create_athlete_taxonomy' );

            function create_athlete_taxonomy() {
            $labels = array(
                            'name'                           => 'Athletes',
                            'singular_name'                  => 'Athlete',
                            'search_items'                   => 'Search Athletes',
                            'all_items'                      => 'All Athletes',
                            'edit_item'                      => 'Edit Athlete',
                            'update_item'                    => 'Update Athlete',
                            'add_new_item'                   => 'Add New Athlete',
                            'new_item_name'                  => 'New Athlete Name',
                            'menu_name'                      => 'Athlete',
                            'view_item'                      => 'View Athlete',
                            'popular_items'                  => 'Popular Athlete',
                            'separate_items_with_commas'     => 'Separate athletes with commas',
                            'add_or_remove_items'            => 'Add or remove athletes',
                            'choose_from_most_used'          => 'Choose from the most used athletes',
                            'not_found'                      => 'No athletes found'
            );

            register_taxonomy(
                            'athlete',
                            'post',
                            array(
                            'label' => __( 'Athlete' ),
                            'hierarchical' => false,
                            'labels' => $labels,
                            'public' => true,
                            'show_in_nav_menus' => false,
                            'show_tagcloud' => false,
                            'show_admin_column' => true,
                            'rewrite' => array(
                            'slug' => 'athletes'
            )
            )
            );
            }

                //another taxonomy Topics
                add_action( 'init', 'create_cw_nonhierarchical_taxonomy', 0 );
                function create_cw_nonhierarchical_taxonomy() {
                    $labels = array(
                        'name' => _x( 'Topics', 'taxonomy general name' ),
                        'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
                        'search_items' => __( 'Search Topics' ),
                        'popular_items' => __( 'Popular Topics' ),
                        'all_items' => __( 'All Topics' ),
                        'parent_item' => null,
                        'parent_item_colon' => null,
                        'edit_item' => __( 'Edit Topic' ),
                        'update_item' => __( 'Update Topic' ),
                        'add_new_item' => __( 'Add New Topic' ),
                        'new_item_name' => __( 'New Topic Name' ),
                        'separate_items_with_commas' => __( 'Separate topics with commas' ),
                        'add_or_remove_items' => __( 'Add or remove topics' ),
                        'menu_name' => __( 'Topics' ),
                    );
                // Register non-hierarchical taxonomy
                    register_taxonomy('topics','post',array(
                        'hierarchical' => false,
                        'labels' => $labels,
                        'show_ui' => true,
                        'show_admin_column' => true,
                        'update_count_callback' => '_update_post_term_count',
                        'query_var' => true,
                        'rewrite' => array( 'slug' => 'topic' ),
                    ));
                }
/* If the album artist taxonomy exists. */
if ( taxonomy_exists( 'topics' ) ) {
    echo 'The "topics" taxonomy is registered.';
}
/* If the album artist taxonomy doesn’t exist. */
else {
    echo 'The "topics" taxonomy is not registered.';
}

