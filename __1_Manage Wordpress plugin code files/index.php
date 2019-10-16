<?php
/*
  Plugin Name: _1_ manage plugin code files
  Plugin URI: http://puredevs.com/
  Description: this plugin is used to manage many files
  Version: 1.0
  Author: Barry Eleas
  Author URI: http://puredevs.com/
  License: GPLv2 or later
 */

define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugins_url());
define("PLUGIN_VERSION",1.0);

//echo PLUGIN_DIR_PATH." , ".PLUGIN_URL;die;

function theme_options_panel(){
    add_menu_page('Theme page title', 'Manage plugin code files', 'manage_options', 'theme-options', 'wps_theme_func','dashicons-welcome-widgets-menus',25);
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
include_once  PLUGIN_DIR_PATH."/views/page1.php";
}
function wps_theme_func_faq(){
    include_once  PLUGIN_DIR_PATH."/views/page2.php";
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

//shortcode to add another file
add_shortcode("custom-text","customshortcode");
function customshortcode(){
    include_once PLUGIN_DIR_PATH .'/VIEWS/shortcode_template.php';
}

// add custom css and js
add_action("init","custom_plugin_assets"); //init method show both front-end and admin
//add_action("admin_enqueue_scripts","custom_plugin_assets"); //show only admin
function custom_plugin_assets(){
    wp_enqueue_style(
        "cpl_style",  //unique name for css file
     PLUGIN_URL."/__1_Manage Wordpress plugin code files/assests/css/style.css",
        '',
        PLUGIN_VERSION
    );
    wp_enqueue_script(
        "cpl_script",  //unique name for css file
        PLUGIN_URL."/__1_Manage Wordpress plugin code files/assests/js/custom.js",
        '',
        PLUGIN_VERSION,
        false
    );

    //Custom JavaScript on Wordpress page
    //Method 1
    $object_array=array(
        "Name"  =>"Custom javascript on wordpress page",
        "Author" =>"Barry Eleas"
    );
    wp_localize_script("cpl_script","online_web_tutor",$object_array);
   //method 2
    function my_custom_js(){
        ?>
<script type="text/javascript">
    alert("Hello Barry");
    </script>
<?php
    }
    add_action("wp_head","my_custom_js");
}



?>

