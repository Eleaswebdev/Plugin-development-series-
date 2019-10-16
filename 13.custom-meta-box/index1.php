<?php
/*
Plugin Name: 13.1 My custom Meta Box1
Plugin URI: https://www.sitepoint.com/adding-custom-meta-boxes-to-wordpress/
Description: This is an example plugin of custom Meta box1 in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/

/*
 * ##############################################################################
 * another meta box in right-side
 */

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Custom Meta Box", "custom_meta_box_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");
//Displaying Fields in a Custom Meta Box
function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
    <div>
        <label for="meta-box-text">Text</label>
        <input name="meta-box-text" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-text", true); ?>">

        <br>

        <label for="meta-box-dropdown">Chose</label>
        <select name="meta-box-dropdown">
            <?php
            $option_values = array(1, 2, 3);

            foreach($option_values as $key => $value)
            {
                if($value == get_post_meta($object->ID, "meta-box-dropdown", true))
                {
                    ?>
                    <option selected><?php echo $value; ?></option>
                    <?php
                }
                else
                {
                    ?>
                    <option><?php echo $value; ?></option>
                    <?php
                }
            }
            ?>
        </select>

        <br>

        <label for="meta-box-checkbox">Check Box</label>
        <?php
        $checkbox_value = get_post_meta($object->ID, "meta-box-checkbox", true);

        if($checkbox_value == "")
        {
            ?>
            <input name="meta-box-checkbox" type="checkbox" value="true">
            <?php
        }
        else if($checkbox_value == "true")
        {
            ?>
            <input name="meta-box-checkbox" type="checkbox" value="true" checked>
            <?php
        }
        ?>
    </div>
    <?php
}

// save meta data

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_dropdown_value = "";
    $meta_box_checkbox_value = "";

    if(isset($_POST["meta-box-text"]))
    {
        $meta_box_text_value = $_POST["meta-box-text"];
    }
    update_post_meta($post_id, "meta-box-text", $meta_box_text_value);

    if(isset($_POST["meta-box-dropdown"]))
    {
        $meta_box_dropdown_value = $_POST["meta-box-dropdown"];
    }
    update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);

    if(isset($_POST["meta-box-checkbox"]))
    {
        $meta_box_checkbox_value = $_POST["meta-box-checkbox"];
    }
    update_post_meta($post_id, "meta-box-checkbox", $meta_box_checkbox_value);
}

add_action("save_post", "save_custom_meta_box", 10, 3);