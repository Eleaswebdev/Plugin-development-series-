<?php

/*
Plugin Name: 2.Play with admin notice
Description: It's Been A Long Time Since I Rock and Rolled
Author: Barry Eleas
Version: 1.0
Author URI: http://www.puredevs.com
*/

function admin_notice_on_general_settings(){
    global $pagenow;
    if ( $pagenow == 'options-general.php' ) {
        echo '<div class="notice notice-warning is-dismissible">
             <p>This notice appears on the settings page.</p>
         </div>';
    }
}
add_action('admin_notices', 'admin_notice_on_general_settings');

function admin_notice_to_administrator(){
    global $pagenow;
    if ( $pagenow == 'index.php' ) {
        $user = wp_get_current_user();
        if ( in_array( 'administrator', (array) $user->roles ) ) {
            echo '<div class="notice notice-info is-dismissible">
          <p>Click on <a href="edit.php">Posts</a> to start writing.</p>
         </div>';
        }
    }
}
add_action('admin_notices', 'admin_notice_to_administrator');

// user greetings

add_action('admin_notices','show_notice');

function show_notice()
{

    // Always add these two lines to capture details about the currently logged in user.
    global $current_user;
    get_currentuserinfo();


    // If you want to define an array
    $preferred_users = array('kanchonruet@gmail.com','Author1');
    if(in_array($current_user->user_login,$preferred_users))
    {
        echo "Hello, " . $current_user->user_login . ' at ' . $current_user->user_email;
    }


    // If you want to capture an email domain
    if(strpos($current_user->user_email,'asdf.com'))
    {
        echo "Hello, " . $current_user->user_login . ' at ' . $current_user->display_name; //we can also use $current_user->user_firstname or user_lastname or ID
    }

    // If you want to greet usernames that begin with a specific prefix like "user"
    if(substr($current_user->user_login,0,4)=="user")
    {
        echo "Hello, " . $current_user->user_login;
    }



}

?>
