<?php
/*
Plugin Name: 26.wp code editor
Description: example plugin to demonstrate wordpress capatabilities
Plugin URI: http://puredevs.com
Author URI: http://puredevs.com
Author: Barry Eleas
License: Public Domain
Version: 1.1
*/




function theme_options_panel(){
    add_menu_page('Theme page title', 'WP custom editor', 'manage_options', 'theme-options', 'wps_theme_func','dashicons-welcome-widgets-menus',25);
    add_submenu_page( 'theme-options', 'Settings page title', 'Settings menu label', 'manage_options', 'theme-op-settings', 'cvf_content_editor');
    add_submenu_page( 'theme-options', 'FAQ page title', 'FAQ menu label', 'manage_options', 'theme-op-faq', 'wps_theme_func_faq');
}
add_action('admin_menu', 'theme_options_panel');


    function cvf_content_editor() {
          echo '<h3>Our custom editor</h3>';
        $content = 'The content to be loaded';
        $editor_id = 'my_editor_id';
        $settings =   array(
            'wpautop' => false, // enable auto paragraph?
            'media_buttons' => true, // show media buttons?
            'textarea_name' => $editor_id, // id of the target textarea
            'textarea_rows' => get_option('default_post_edit_rows', 10), // This is equivalent to rows="" in HTML
            'tabindex' => 'sss',
            'editor_css' => '', //  additional styles for Visual and Text editor,
            'editor_class' => '', // sdditional classes to be added to the editor
            'teeny' => true, // show minimal editor
            'dfw' => false, // replace the default fullscreen with DFW
            'drag_drop_upload' =>true,
            'tinymce' => array(
                // Items for the Visual Tab
                'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo,bullist,numlist,blockquote,strikethrough,fullscreen',
            ),
            'quicktags' => array(
                // Items for the Text Tab
                'buttons' => 'strong,em,underline,ul,ol,li,link,code'
            )
        );

        //wp_editor( $content, $editor_id, $settings );
        wp_editor( wpautop( $content ), $editor_id, $settings );

    }


function wps_theme_func_faq(){
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>FAQ</h2></div>';
}