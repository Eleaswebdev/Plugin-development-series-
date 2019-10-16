<?php
/**
 * Plugin Name: 21.Quick tag to any post or page
 * Plugin URI: https://puredevs.com/
 * Description: This plugins  is only applied to single post
 * Version: 1.0
 * Author: Barry Eleas
 * Author URI: http://puredevs.com/
 **/

function any_quicktag()
{
    if(wp_script_is("quicktags"))
    {
        ?>
        <script type="text/javascript">

            //this function is used to retrieve the selected text from the text editor
            function getSel()
            {
                var txtarea = document.getElementById("content");
                var start = txtarea.selectionStart;
                var finish = txtarea.selectionEnd;
                return txtarea.value.substring(start, finish);
            }

            QTags.addButton("date_quicktag", "Today's date", get_date);

            function get_date()
            {
                var selected_text = getSel();
                QTags.insertContent(Date('m-d-Y'));
            }
        </script>
        <?php
    }
}

add_action("admin_print_footer_scripts", "any_quicktag");