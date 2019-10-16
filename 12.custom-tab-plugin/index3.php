<?php
/*
Plugin Name: 12.3 My custom tab3 with multiple settings fields
Plugin URI: http://www.kvcodes.com/?p=829&preview=true
Description: This is an example plugin of custom tab
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/
/* ----------------------------------------------------------------------------- */
/* Add Menu Page */
/* ----------------------------------------------------------------------------- */



    function add_new_menu_items()
    {
        add_menu_page(
            "Theme Options",
            "Theme Options",
            "manage_options",
            "theme-options",
            "theme_options_page",
            "",
            99
        );

    }

    function theme_options_page()
    {
        ?>
        <div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1>Theme Options</h1>


            <?php
            //we check if the page is visited by click on the tabs or on the menu button.
            //then we get the active tab.
            $active_tab = "header-options";
            if(isset($_GET["tab"]))
            {
                if($_GET["tab"] == "header-options")
                {
                    $active_tab = "header-options";
                }
                else
                {
                    $active_tab = "ads-options";
                }
            }
            ?>

            <!-- wordpress provides the styling for tabs. -->
            <h2 class="nav-tab-wrapper">
                <!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
                <a href="?page=theme-options&tab=header-options" class="nav-tab <?php if($active_tab == 'header-options'){echo 'nav-tab-active';} ?> "><?php _e('Header Options', 'sandbox'); ?></a>
                <a href="?page=theme-options&tab=ads-options" class="nav-tab <?php if($active_tab == 'ads-options'){echo 'nav-tab-active';} ?>"><?php _e('Advertising Options', 'sandbox'); ?></a>
            </h2>

            <form method="post" action="options.php">
                <?php

                settings_fields("header_section");

                do_settings_sections("theme-options");

                submit_button();

                ?>
            </form>
        </div>
        <?php
    }

    add_action("admin_menu", "add_new_menu_items");

    function display_options()
    {
        add_settings_section("header_section", "Header Options", "display_header_options_content", "theme-options");
        add_settings_section("name_section", "Header Options", "display_header_options_content", "theme-options");
        //here we display the sections and options in the settings page based on the active tab
        if(isset($_GET["tab"]))
        {
            if($_GET["tab"] == "header-options")
            {
                add_settings_field("header_logo", "Logo Url", "display_logo_form_element", "theme-options", "header_section");
                register_setting("header_section", "header_logo");
                add_settings_field("your_name", "Name", "display_logo_form_element", "theme-options", "name_section");
                register_setting("name_section", "your_name");
            }
            else
            {
                add_settings_field("advertising_code", "Ads Code", "display_ads_form_element", "theme-options", "header_section");

                register_setting("header_section", "advertising_code");
            }
        }
        else
        {
            add_settings_field("header_logo", "Logo Url", "display_logo_form_element", "theme-options", "header_section");
            register_setting("header_section", "header_logo");
        }

    }

    function display_header_options_content(){echo "The header of the theme";}
    function display_logo_form_element()
    {
        ?>
        <input type="text" name="header_logo" id="header_logo" value="<?php echo get_option('header_logo'); ?>" /></br>
        <input type="text" name="your_name" id="your_name" value="<?php echo get_option('your_name'); ?>" />
        <?php
    }
    function display_ads_form_element()
    {
        ?>
        <input type="text" name="advertising_code" id="advertising_code" value="<?php echo get_option('advertising_code'); ?>" />
        <?php
    }

    add_action("admin_init", "display_options");