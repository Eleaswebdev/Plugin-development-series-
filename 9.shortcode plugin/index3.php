<?php
/*
Plugin Name: 9.3 SEARCHING COMMENT TEXT
Plugin URI: http://www.puredevs.com
Description: This plugin show 10 most recent comment
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */
add_shortcode( 'try_markup', 'pure_try_markup' );
function pure_try_markup() {
    $args = array(
        'status' => 'approve',
        'number' => '10'  //the number cf comment to show
    );
    $comments = get_comments($args);

    ob_start();  //Turn on output buffering
    foreach($comments as $comment) :
        echo $comment->comment_content . '<hr>';
    endforeach;
    return ob_get_clean();  //Get current buffer contents and delete current output buffer
}
?>
