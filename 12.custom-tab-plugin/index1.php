<?php
/*
Plugin Name: 12.1 My custom tab2 with multiple settings fields
Plugin URI: http://www.kvcodes.com/?p=829&preview=true
Description: This is an example plugin of custom tab
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/

/* Add Menus
-----------------------------------------------------------------*/
add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {
    /* Base Menu */
    add_menu_page(
        'Essentials Theme',
        'Essentials Theme',
        'manage_options',
        'ch-essentials-options',
        'ch_essentials_index');
}


    add_action('admin_init', 'ch_essentials_options');
    function ch_essentials_options() {

        /* Front Page Options Section */
        add_settings_section(
            'ch_essentials_front_page',
            'Essentials Front Page Options',
            'ch_essentials_front_page_callback',
            'ch_essentials_front_page_option'
        );

        add_settings_field(
            'featured_post',
            'Featured Post',
            'ch_essentials_featured_post_callback',
            'ch_essentials_front_page_option',
            'ch_essentials_front_page'
        );

        /* Header Options Section */
        add_settings_section(
            'ch_essentials_header',
            'Essentials Header Options',
            'ch_essentials_header_callback',
            'ch_essentials_header_option'
        );

        add_settings_field(
            'header_type',
            'Header Type',
            'ch_essentials_textbox_callback',
            'ch_essentials_header_option',
            'ch_essentials_header',
            array(
                'header_type'
            )
        );
        register_setting('ch_essentials_front_page_option', 'ch_essentials_front_page_option');
        register_setting('ch_essentials_header_option', 'ch_essentials_header_option');
}

/* Call Backs
-----------------------------------------------------------------*/
function ch_essentials_front_page_callback() {
    echo '<p>Front Page Display Options:</p>';
}
function ch_essentials_header_callback() {
    echo '<p>Header Display Options:</p>';
}
function ch_essentials_textbox_callback($args) {

    $options = get_option('ch_essentials_header_option');

    echo '<input type="text" id="'  . $args[0] . '" name="ch_essentials_header_option['  . $args[0] . ']" value="' . $options[''  . $args[0] . ''] . '"></input>';

}
function ch_essentials_featured_post_callback() {

    $options = get_option('ch_essentials_front_page_option');

    query_posts( $args );


    echo '<select id="featured_post" name="ch_essentials_front_page_option[featured_post]">';
    while ( have_posts() ) : the_post();

        $selected = selected($options[featured_post], get_the_id(), false);
        printf('<option value="%s" %s>%s</option>', get_the_id(), $selected, get_the_title());

    endwhile;
    echo '</select>';


}
/* Display Page
-----------------------------------------------------------------*/
function ch_essentials_index()
{
    ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2>Essentials Theme Options</h2>
        <?php settings_errors(); ?>

        <?php
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'front_page_options';
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=ch-essentials-options&tab=front_page_options"
               class="nav-tab <?php echo $active_tab == 'front_page_options' ? 'nav-tab-active' : ''; ?>">Front Page
                Options</a>
            <a href="?page=ch-essentials-options&tab=header_options"
               class="nav-tab <?php echo $active_tab == 'header_options' ? 'nav-tab-active' : ''; ?>">Header Options</a>
        </h2>


        <form method="post" action="options.php">

            <?php
            if ($active_tab == 'front_page_options') {
                settings_fields('ch_essentials_front_page_option');
                do_settings_sections('ch_essentials_front_page_option');
            } else if ($active_tab == 'header_options') {
                settings_fields('ch_essentials_header_option');
                do_settings_sections('ch_essentials_header_option');

            }
            ?>
            <?php submit_button(); ?>
        </form>

    </div>
    <?php
}
?>
