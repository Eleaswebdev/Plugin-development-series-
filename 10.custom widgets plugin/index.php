<?php
/*
Plugin Name: 10.My custom dashboard Widget
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom widgets
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/

add_action( 'wp_dashboard_setup', 'pure_dashboard_example_widgets' );
function pure_dashboard_example_widgets() {
    //create a custom dashboard widget
wp_add_dashboard_widget( 'dashboard_custom_feed', 'My Plugin Information', 'pure_dashboard_example_display' );
}
function pure_dashboard_example_display() {
    echo '<p> Please contact support@example.com to report bugs.</p> ';
}