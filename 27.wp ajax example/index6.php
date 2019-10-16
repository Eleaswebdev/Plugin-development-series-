<?php
/*
Plugin Name: 27.5.AJAX-Like options to a post
Plugin URI: https://odd.blog/2008/11/01/make-your-wordpress-plugin-talk-ajax/
Description: A simple hello world plugin
Version: 0.1
Author: Barry Eleas
Author URI: http://puredevs.com
*/

// define the actions for the two hooks created, first for logged in users and the next for logged out users
add_action("wp_ajax_my_user_like", "my_user_like");
add_action("wp_ajax_nopriv_my_user_like", "please_login");
// define the function to be fired for logged in users
function my_user_like() {

    // nonce check for an extra layer of security, the function will exit if it fails
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_like_nonce")) {
        exit("Woof Woof Woof");
    }

    // fetch like_count for a post, set it to 0 if it's empty, increment by 1 when a click is registered
    $like_count = get_post_meta($_REQUEST["post_id"], "likes", true);
    $like_count = ($like_count == ’) ? 0 : $like_count;
    $new_like_count = $like_count + 1;

    // Update the value of 'likes' meta key for the specified post, creates new meta data for the post if none exists
    $like = update_post_meta($_REQUEST["post_id"], "likes", $new_like_count);

    // If above action fails, result type is set to 'error' and like_count set to old value, if success, updated to new_like_count
    if($like === false) {
        $result['type'] = "error";
        $result['like_count'] = $like_count;
    }
    else {
        $result['type'] = "success";
        $result['like_count'] = $new_like_count;
    }

    // Check if action was fired via Ajax call. If yes, JS code will be triggered, else the user is redirected to the post page
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    }
    else {
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
    // don't forget to end your scripts with a die() function - very important
    die();
}
// define the function to be fired for logged out users
function please_login() {
    echo "You must log in to like";
    die();
}


// Fires after WordPress has finished loading, but before any headers are sent.
add_action( 'init', 'script_enqueuer' );
function script_enqueuer() {

    // Register the JS file with a unique handle, file location, and an array of dependencies
    wp_register_script( "liker_script", plugin_dir_url(__FILE__).'js/liker_script.js', array('jquery') );

    //  Front-end-localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
    wp_localize_script( 'liker_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    // enqueue jQuery library and the script you registered above
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'liker_script' );
}