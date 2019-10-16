<?php
/*
Plugin Name: 27.2.AJAX-Update hello world text
Plugin URI: https://odd.blog/2008/11/01/make-your-wordpress-plugin-talk-ajax/
Description: A simple hello world plugin
Version: 0.1
Author: Barry Eleas
Author URI: http://puredevs.com
*/

function hello_world_three_pages() {
    add_options_page('Hello World 3', 'Hello World 3', 'manage_options', 'helloworld3', 'hello_world_three');
}
add_action('admin_menu', 'hello_world_three_pages');


function hello_world_three() {
    $nonce = wp_create_nonce( 'helloworld' );
    ?>
    <script  type='text/javascript'>
        <!--
        var count = 0;

        function update_hello_world( count ) {
            jQuery.ajax({
                type: "post",url: "admin-ajax.php",data: { action: 'gethello3', count: count, _ajax_nonce: '<?php echo $nonce; ?>' },
                beforeSend: function() {jQuery("#helloworld").fadeOut('fast');}, //fadeIn loading just when link is clicked
                success: function(html){ //so, if data is retrieved, store it in html
                    jQuery("#helloworld").html(html); //fadeIn the html inside helloworld div
                    jQuery("#helloworld").fadeIn("fast"); //animation
                }
            }); //close jQuery.ajax(
        }
        // When the document loads do everything inside here ...
        jQuery(document).ready(function(){
            update_hello_world( count );
            jQuery('#updatecount').click(function() { //start function when any update link is clicked
                count = count + 1;
                update_hello_world( count );
            })
        })
        -->
    </script>
    <style type='text/css'>
        #loading { clear:both; background:url(images/loading.gif) center top no-repeat; text-align:center;padding:33px 0px 0px 0px; font-size:12px;display:none; font-family:Verdana, Arial, Helvetica, sans-serif; }
        #helloworld {
            text-align:center;
            margin: 0, auto;
        }
    </style>
    <div class="wrap">
        <a href='#' id='updatecount'>Update!</a>
        <div id='loading'>LOADING!</div>
        <div id='helloworld'></div>
    </div><?php
}

function get_hello3_ajax() {
    check_ajax_referer( "helloworld" );
    if( $_POST[ 'count' ] )
        echo 'Hello world'. (int)$_POST[ 'count' ] . ' ';
    ?>Hello World!<?php
    die();
}
add_action( 'wp_ajax_gethello3', 'get_hello3_ajax' );
?>