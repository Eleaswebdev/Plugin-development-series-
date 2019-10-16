<?php
/*
Plugin Name: 12.2 My custom tab3
Plugin URI: http://www.kvcodes.com/?p=829&preview=true
Description: This is an example plugin of custom tab
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/

class KvcodesOptionsPage {

    private $options_general;
    private $options_social;
    private $options_footer;


    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'kv_options_init' ) );
    }

    public function add_plugin_page(){
        add_menu_page('Kvcodes', 'Kvcodes', 'manage_options', 'kvcodes' , array( $this,'kv_admin_kvcodes') );
    }

    public function kv_admin_kvcodes() {
        $this->options_general = get_option( 'vaajo_general' );
        $this->options_social = get_option( 'vaajo_social' );
        $this->options_footer = get_option( 'vaajo_footer' ); $social_Screen = ( isset( $_GET['action'] ) && 'social' == $_GET['action'] ) ? true : false;

        $footer_Screen = ( isset( $_GET['action'] ) && 'footer' == $_GET['action'] ) ? true : false;    ?>
        <div class="wrap">
            <h1>Kvcodes Settings</h1>
            <h2 class="nav-tab-wrapper">
                <a href="<?php echo admin_url( 'admin.php?page=kvcodes' ); ?>" class="nav-tab<?php if ( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'social' != $_GET['action']  && 'footer' != $_GET['action'] ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'General' ); ?></a>
                <a href="<?php echo esc_url( add_query_arg( array( 'action' => 'social' ), admin_url( 'admin.php?page=kvcodes' ) ) ); ?>" class="nav-tab<?php if ( $social_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Social' ); ?></a>
                <a href="<?php echo esc_url( add_query_arg( array( 'action' => 'footer' ), admin_url( 'admin.php?page=kvcodes' ) ) ); ?>" class="nav-tab<?php if ( $footer_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Footer' ); ?></a>
            </h2>

            <form method="post" action="options.php"><?php //   settings_fields( 'vaajo_general' );
                if($social_Screen) {
                    settings_fields( 'vaajo_social' );
                    do_settings_sections( 'vaajo-setting-social' );
                    submit_button();
                } elseif($footer_Screen) {
                    settings_fields( 'vaajo_footer' );
                    do_settings_sections( 'vaajo-setting-footer' );
                    submit_button();
                }else {
                    settings_fields( 'vaajo_general' );
                    do_settings_sections( 'vaajo-setting-admin' );
                    submit_button();
                } ?>
            </form>
        </div> <?php
    }

    public function kv_options_init() {
        register_setting(
            'vaajo_general', // Option group
            'vaajo_general', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'All Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'vaajo-setting-admin' // Page
        );
        add_settings_field(
            'logo_image',
            'Logo Image',
            array( $this, 'logo_image_callback' ),
            'vaajo-setting-admin',
            'setting_section_id'
        );


        register_setting(
            'vaajo_social', // Option group
            'vaajo_social', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        add_settings_section(
            'setting_section_id', // ID
            'Social Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'vaajo-setting-social' // Page
        );

        add_settings_field(
            'fb_url', // ID
            'Facebook URL', // Title
            array( $this, 'fb_url_callback' ), // Callback
            'vaajo-setting-social', // Page
            'setting_section_id' // Section
        );


        register_setting(
            'vaajo_footer', // Option group
            'vaajo_footer', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        add_settings_section(
            'setting_section_id', // ID
            'Footer Details', // Title
            array( $this, 'print_section_info' ), // Callback
            'vaajo-setting-footer' // Page
        );

        add_settings_field(
            'hide_more_themes',
            'Hide Find more themes at Kvcodes.com',
            array( $this, 'hide_more_themes_callback' ),
            'vaajo-setting-footer',
            'setting_section_id'
        );
    }


    public function print_section_info(){
        //your code...
    }


    public function fb_url_callback() {
        printf(
            '<input type="text" id="fb_url" name="vaajo_social[fb_url]" value="%s" />',
            isset( $this->options_social['fb_url'] ) ? esc_attr( $this->options_social['fb_url']) : ''
        );
    }

    public function hide_more_themes_callback(){
        printf(
            '<input type="checkbox" id="hide_more_themes" name="vaajo_footer[hide_more_themes]" value="yes" %s />',
            (isset( $this->options_footer['hide_more_themes'] ) && $this->options_footer['hide_more_themes'] == 'yes') ? 'checked' : ''
        );
    }

    public function logo_image_callback() {
        printf(
            '<input type="text" name="vaajo_general[logo_image]" id="logo_image" value="%s"> <a href="#" id="logo_image_url" class="button" > Select </a>',
            isset( $this->options_general['logo_image'] ) ? esc_attr( $this->options_general['logo_image']) : ''
        );
    }

    public function sanitize( $input )  {
        $new_input = array();
        if( isset( $input['fb_url'] ) )
            $new_input['fb_url'] = sanitize_text_field( $input['fb_url'] );

        if( isset( $input['hide_more_themes'] ) )
            $new_input['hide_more_themes'] = sanitize_text_field( $input['hide_more_themes'] );

        if( isset( $input['logo_image'] ) )
            $new_input['logo_image'] = sanitize_text_field( $input['logo_image'] );

        return $new_input;
    }
}

if( is_admin() )
    $settings_page = new KvcodesOptionsPage();

wp_enqueue_script('rbr-jquery', plugins_url('kvcodes-options/admin_js.js', dirname(__FILE__)),  array('jquery'), '1.0', true);

function load_wp_media_files(){
    wp_enqueue_media();

}
add_action('admin_enqueue_scripts', 'load_wp_media_files');
?>