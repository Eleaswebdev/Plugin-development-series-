<?php
/*
Plugin Name: 9.4 DISPLAY ALL RECENT MEDIUM-SIZED IMAGES
Plugin URI: http://www.puredevs.com
Description: DISPLAY ALL RECENT MEDIUM-SIZED IMAGES
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */

add_shortcode( 'rec_images_medium', 'pure_rec_images_medium' );
function pure_rec_images_medium() {
    $query_images_args = array(
        'post_type'      => 'attachment',  //The term attachment is used for files uploaded to WordPress from post edit screen. When a file is uploaded using the Add Media button from post edit screen, that file automatically becomes an attachment of that particular post.
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',   //Attachments have a post status of “inherit”.
        'posts_per_page' => 50,
    );
    $query_images = new WP_Query( $query_images_args );

    ob_start();
    foreach( $query_images->posts as $image ) :
        echo wp_get_attachment_image( $image->ID, 'medium' );
        echo '<hr>';
    endforeach;
    return ob_get_clean();
}
?>