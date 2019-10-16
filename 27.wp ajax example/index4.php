<?php
/*
Plugin Name: 27.3.AJAX-Generate random color code
Plugin URI: https://odd.blog/2008/11/01/make-your-wordpress-plugin-talk-ajax/
Description: A simple hello world plugin
Version: 0.1
Author: Barry Eleas
Author URI: http://puredevs.com
*/


function hello_world_4_pages() {
    add_options_page('Hello World 4', 'Hello World 4', 'manage_options', 'helloworld4', 'hello_world_4');
}
add_action('admin_menu', 'hello_world_4_pages');


function hello_world_4() {
    $nonce = wp_create_nonce( 'helloworld' );
    ?>
    <script  type='text/javascript'>
        <!--
        var count = 0;

        function update_hello_world( count ) {
            jQuery.ajax({
                type: "post",url: "admin-ajax.php",data: { action: 'gethello4', count: count, _ajax_nonce: '<?php echo $nonce; ?>' },
                beforeSend: function() {jQuery("#helloworld").fadeOut('fast');}, //fadeIn loading just when link is clicked
                success: function(html){ //so, if data is retrieved, store it in html
                    jQuery("#helloworld").html(html); //fadeIn the html inside helloworld div
                    jQuery("#helloworld").fadeIn("fast"); //animation
                }
            }); //close jQuery.ajax(
        }
        // When the document loads do everything inside here ...
        jQuery(document).ready(function(){
            jQuery('#random').click(function() { //start function when Random button is clicked
                jQuery.ajax({
                    type: "post",url: "admin-ajax.php",data: { action: 'randomcol', _ajax_nonce: '<?php echo $nonce; ?>' },
                    beforeSend: function() {jQuery("#loading").fadeIn('fast');}, //fadeIn loading just when link is clicked
                    success: function(html){ //so, if data is retrieved, store it in html
                        jQuery("#loading").fadeOut('slow');
                        jQuery("#colour").val(html); //fadeIn the html inside helloworld div
                        jQuery("#helloworld").fadeIn("fast"); //animation
                    }
                }); //close jQuery.ajax
                return false;
            })
            jQuery('#save').click(function() { //start function when Random button is clicked
                jQuery.ajax({
                    type: "post",url: "admin-ajax.php",data: { action: 'colour', colour: escape( jQuery( '#colour' ).val() ), _ajax_nonce: '<?php echo $nonce; ?>' },
                    beforeSend: function() {jQuery("#loading").fadeIn('fast');jQuery("#formstatus").fadeOut("fast");}, //fadeIn loading just when link is clicked
                    success: function(html){ //so, if data is retrieved, store it in html
                        jQuery("#loading").fadeOut('slow');
                        jQuery("#formstatus").html( html ); //show the html inside formstatus div
                        jQuery("#formstatus").fadeIn("fast"); //animation
                        jQuery("#formstatus").fadeOut(5000); //animation
                    }
                }); //close jQuery.ajax
                return false;
            })
        })
        -->
    </script>
    <style type='text/css'>
        #loading { clear:both; background:url(images/loading.gif) center top no-repeat; text-align:center;padding:33px 0px 0px 0px; font-size:12px;display:none; font-family:Verdana, Arial, Helvetica, sans-serif; }
    </style>
    <div class="wrap">
        <form action='' method='POST' id='helloworld4form'>
            <p>Colour: <input type='text' name='colour' id='colour' value='#000000' /></p>
            <p><input type='submit' name='action' id='random' value='Random' />
                <input type='submit' name='action' id='save' value='Save' /></p>
        </form>
        <div id='formstatus'></div>
        <div id='loading'>LOADING!</div>
    </div><?php
}

function save_colour() {
    check_ajax_referer( "helloworld" );
    echo 'Saved colour: ' . urldecode( $_POST[ 'colour' ] );
    die();
}
add_action( 'wp_ajax_colour', 'save_colour' );

function get_randomcol() {
    check_ajax_referer( "helloworld" );
    $col = substr( mt_rand(), 0, 6 );
    echo '#' . $col;
    die();
}
add_action( 'wp_ajax_randomcol', 'get_randomcol' );
?>