<?php
/*
Plugin Name: 11.Custom menu on admin panel
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom menu types in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/



//<!--  1.Creating a Top - Level Menu  -->

function theme_options_panel(){
    add_menu_page('Theme page title', 'Our custom menu', 'manage_options', 'theme-options', 'wps_theme_func','dashicons-welcome-widgets-menus',25);
    add_submenu_page( 'theme-options', 'Settings page title', 'Settings menu label', 'manage_options', 'theme-op-settings', 'wps_theme_func_settings');
    add_submenu_page( 'theme-options', 'FAQ page title', 'FAQ menu label', 'manage_options', 'theme-op-faq', 'wps_theme_func_faq');
}
add_action('admin_menu', 'theme_options_panel');

function wps_theme_func(){
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>Theme</h2></div>';
    echo '  <form action="/action_page.php">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                </div>
                <div class="form-group form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                  </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
           </form>';
}
function wps_theme_func_settings(){
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>Settings</h2></div>';
}
function wps_theme_func_faq(){
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>FAQ</h2></div>';
}



//<!--  2. Adding a Menu Item to an Existing Menu  -->


/** Step 2 (from text above). */
add_action( 'admin_menu', 'pure_my_plugin_menu' );

/** Step 1. */
function pure_my_plugin_menu() {
    add_options_page( 'My Plugin Options', 'My custom sub-menu', 'manage_options', 'my-unique-identifier', 'pure_my_plugin_options' );
}

/** Step 3. */
function pure_my_plugin_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
    echo '<p>Here is where the form would go if I actually had options.</p>';
    echo '</div>';
}


?>