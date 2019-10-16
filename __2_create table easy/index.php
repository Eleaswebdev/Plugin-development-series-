<?php
/**
 *
 */
/*
Plugin Name: _2_.custom table easy
Description: This plugin creates custom table
Author: Barry Eleas
Version: 1.0
Author URI: http://www.puredevs.com
*/


global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . 'custom_table_new';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'jal_db_version', $jal_db_version );
}

function jal_install_data() {
    global $wpdb;

    $welcome_name = 'Mr. WordPress';
    $welcome_text = 'Congratulations, you just completed the installation!';

    $table_name = $wpdb->prefix . 'custom_table_new';

    /*
    $wpdb->insert(
        $table_name,
        array(
            'time' => current_time( 'mysql' ),
            'name' => $welcome_name,
            'text' => $welcome_text,
        )
    );
    */
    $wpdb->query(
        $wpdb->prepare(
            "INSERT into wp_custom_table_new (name,text,url) values ('%s','%s','%s')","Barry","I am learning wordpress","www.puredevs.com"
        )
    );
}

register_activation_hook( __FILE__, 'jal_install' );
register_activation_hook( __FILE__, 'jal_install_data' );

// table deleting code
function deactivate_table(){
    // uninstall mysql code
    global $wpdb;
    $wpdb->query("DROP table IF Exists wp_custom_table_new");

    // step1: we get the id of post means page
    // delete the post from table

    $the_post_id = get_option("custom_plugin_page_id");
    if(!empty($the_post_id)){
        wp_delete_post($the_post_id,true);
    }

}
register_deactivation_hook(__FILE__,"deactivate_table");
register_uninstall_hook(__FILE__,"deactivate_table");



//create page when activating plugin

// create post function,
function create_page(){
    // code for create page
    $page = array();
    $page['post_title']= "Add this page when plugin activate";
    $page['post_content']= "Learning Platform for Wordpress Customization for Themes, Plugin and Widgets";
    $page['post_status'] = "publish";
    $page['post_slug'] = "custom-plugin-online-web-tutor";
    $page['post_type'] = "page";

    $post_id = wp_insert_post($page); // post_id as return value

    add_option("custom_plugin_page_id",$post_id);  // wp_options table from the name of custom_plugin_page_id
}
register_activation_hook(__FILE__,"create_page");


