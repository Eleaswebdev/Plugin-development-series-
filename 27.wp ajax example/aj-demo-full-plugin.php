<?php
/*
Plugin Name: 27.AJAX- Count btn to count posts and page
Plugin URI: http://www.damiencarbery.com/2017/02/simple-demo-of-ajax-code-for-wordpress/
Description: Full ajax demo including shortcode, Javascript and backend code
Author: Damien Carbery
Version: 0.2
*/

function aj_ajax_demo_shortcode() {
    $count_posts = wp_count_posts('post');
    $count_pages = wp_count_posts('page');

    return '<button class="count_btn" data-type="post" type="button">Get Post Count</button><div id="post_count">?</div>
            <button class="count_btn" data-type="page" type="button">Get Page Count</button><div id="page_count">?</div>
            <!-- List the post and page count so that we can see that the ajax results are correct. -->
            <p>Post Count: '.$count_posts->publish.'</p>
            <p>Page Count: '.$count_pages->publish.'</p>';
}
add_shortcode('ajax_demo', 'aj_ajax_demo_shortcode');


// Include the Javascript code file.
// If the Javascript code is generated inline the wp_localize_script() will not work.
add_action( 'wp_enqueue_scripts', 'aj_enqueue_scripts' );
function aj_enqueue_scripts() {
    // Note that the first parameter of wp_enqueue_script() matches that of wp_localize_script.
    wp_enqueue_script( 'aj-demo', plugin_dir_url( __FILE__ ). 'js/aj-demo-ajax-code.js', array('jquery') );

    // The second parameter ('aj_ajax_url') will be used in the javascript code.
    wp_localize_script( 'aj-demo', 'aj_ajax_demo', array(
                        'ajax_url' => admin_url( 'admin-ajax.php' ),
                        'aj_demo_nonce' => wp_create_nonce('aj-demo-nonce') 
    ));
}


// You can have a different function for logged in users.
// Note that 'aj_ajax_demo_get_count' in the first parameter is the 'action' value in the JS file.
add_action( 'wp_ajax_nopriv_aj_ajax_demo_get_count', 'aj_ajax_demo_process' );
add_action( 'wp_ajax_aj_ajax_demo_get_count', 'aj_ajax_demo_process' );  // For logged in users.
function aj_ajax_demo_process() {
    check_ajax_referer( 'aj-demo-nonce', 'nonce' );  // This function will die if nonce is not correct.
    
    $post_type = sanitize_text_field($_POST['post_type']);
    if (post_type_exists($post_type)) {
        $count_posts = wp_count_posts($post_type);
        wp_send_json($count_posts->publish);
    }

    wp_send_json_error();
    wp_die();
}