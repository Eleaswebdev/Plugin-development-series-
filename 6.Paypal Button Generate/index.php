<?php
/*
Plugin Name: 6.Get Secure Paypal Button By Puredevs
Plugin URI: http://www.puredevs.com
Description: Get the paypal code fo secure buttons. You simply pass the button ID.
Version: 1.0
Author: Barry Eleas
Author URI: http://www.puredevs.com
 */

add_filter('the_content',array('puredevs_paypal_button_code','get_paypal'));

class puredevs_paypal_button_code
{
    function paypal_button_code($id)
    {


        $paypal_code = ("
				<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
				<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">
				<input type=\"hidden\" name=\"hosted_button_id\" value=\"$id\">
				<input type=\"image\" src=\"https://malegaaudio.com/wp-content/uploads/2016/05/Buy-Now-Amazon-Button.png\" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\">
				<img alt=\"\" border=\"0\" src=\"https://www.paypal.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">
				</form>

		");

        return $paypal_code;

    }

    function get_paypal($content)
    {

        $content=preg_replace('/paypal_([A-Za-z0-9]+)/',puredevs_paypal_button_code::paypal_button_code('\\1'),$content);
        return "$content";
    }

}


?>