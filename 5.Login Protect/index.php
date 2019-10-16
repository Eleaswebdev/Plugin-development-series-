<?php
/**
 * Plugin Name: 5.Login Protect
 * Description: Requires a special code in the URL to login to the admin page. It redirects the user to the home page without the code.
 * Version: 1.0
 * Author: Barry Eleas
 */

add_action( 'login_form_login', 'ti_login_protect' );
function ti_login_protect() {

    if($_SERVER["SCRIPT_NAME"]=='/wordpress/wp-login.php')
    {
        $min = Date('i');
        if(!isset($_GET['tibe' . $min]))
        {
            header("Location:http://localhost/wordpress/");
        }
    }
}


