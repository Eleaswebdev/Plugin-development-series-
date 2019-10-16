<?php
/*
Plugin Name: 18.2-Custom table example
Description: example plugin to demonstrate wordpress capatabilities
Plugin URI: http://phpcoder.tech/how-to-create-plugin-in-wordpress-with-example/
Author URI: http://puredevs.com
Author: Barry Eleas
License: Public Domain
Version: 1.1
*/

// Add action to the Admin Menu
add_action('admin_menu','phpcodertech_modifymenu');

// On time of activation of the plugin, add the "Users" option
function phpcodertech_modifymenu() {

// The main item for the menu
    add_menu_page('users', // page title
        'users crud', // menu title
        'manage_options', // capabilities
        'phpcodertech_list', // menu slug
        'phpcodertech_list' // function
    );

// Ssubmenu
    add_submenu_page('phpcodertech_list', // parent slug
        'Add New users', // page title
        'Add New', // menu title
        'manage_options', // capability
        'phpcodertech_create', // menu slug
        'phpcodertech_create' // function
    );

//this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, // parent slug
        'Update users', // page title
        'Update', // menu title
        'manage_options', // capability
        'phpcodertech_update', // menu slug
        'phpcodertech_update' ); // function

}

// We now include the functions for the plugin options
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'list.php');
require_once(ROOTDIR . 'create.php');
require_once(ROOTDIR . 'update.php');