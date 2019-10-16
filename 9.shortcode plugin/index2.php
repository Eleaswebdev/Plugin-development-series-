<?php
/*
Plugin Name: 9.2 shortcode plugin3 By Puredevs
Plugin URI: http://www.puredevs.com
Description: This plugin use attribute to add multiple image
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */
// Register two shortcodes [amazonimage] and [amazonimg]
add_shortcode( 'amazonimage', 'pure_amazonimage' );
add_shortcode( 'amazonimg',   'pure_amazonimage' );
// Callback function for the shortcode
function pure_amazonimage( $attr, $content )
{
    // Get ASIN or set default
    $possible = array( 'asin', 'isbn' );
    $asin = pure_find( $possible, $attr, '0470560541' );
    // Get affiliate ID or set default
    $possible = array( 'aff', 'affiliate' );
    $aff = pure_find( $possible, $attr, 'aff_id' );
    // Get image size if specified
  $possible = array( 'size', 'image', 'imagesize' );
  $size = pure_find( $possible, $attr, '' );
  // Get type if specified
    if( isset( $attr['type'] ) ) {
        $type = strtolower( $attr['type'] );
        $type = ( $type == 'cd' || $type == 'disc' ) ? 'cd' : '';
    }

    // Now build the Amazon image URL
    $img = "<?php echo plugin_dir_url( __FILE__ ) . 'images/fb.jpg'; ?>";
    $img .= $asin;
    //Image option: size
     if( $size ) {        switch( $size ) {
                     case 'small':
                          $size = '_AA100';
                          break;
                          default:
                     case 'medium':
                         $size = '_AA175';
                     break;
                     case 'big':
                         case 'large':
                             $size = '_SCLZZZZZZZ';
                             break; // Good practice: don’t forget the last break
              }
     }
     // Image option: type
    if( $type == 'cd' ) {
        $type = '_PF';    }
    // Append options to image URL, if any
    if( $type or $size ) {
        $img .= '.01.' . $type . $size;
    }
    // Finish building the image URL
    $img .= '.jpg';
    // Now return the image
    return " < a href='http://www.amazon.com/dp/$asin'' >  
    < img src='$img' / > 
     < /a > ";
}
// Helper function: // Search $find_keys in array $in_array, return $default if not found
 function pure_find( $find_keys, $in_array, $default ) {
    foreach( $find_keys as $key ) {
        if( isset( $in_array[$key] ) )
            return $in_array[$key];
    }
    return $default;
}

    ?>
