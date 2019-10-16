<?php
/*
Plugin Name: 16.custom fields to custom taxonomy
Plugin URI: http://puredevs.com
Description: This is an example plugin of custom taxonomies in the admin area
Author: Barry
Version: 1.0
Author URI: http://puredevs.com
*/
// category


function pure_edit_featured_category_field( $term ){
    $term_id = $term->term_id;
    $term_meta = get_option( "taxonomy_$term_id" );
    ?>
    <tr class="form-field">
        <th scope="row">
            <label for="term_meta[featured]"><?php echo _e('Home Featured') ?></label>
        <td>
            <select name="term_meta[featured]" id="term_meta[featured]">
                <option value="0" <?=($term_meta['featured'] == 0) ? 'selected': ''?>><?php echo _e('No'); ?></option>
                <option value="1" <?=($term_meta['featured'] == 1) ? 'selected': ''?>><?php echo _e('Yes'); ?></option>
            </select>
        </td>
        </th>
    </tr>
    <?php
}

add_action( 'category_edit_form_fields', 'pure_edit_featured_category_field' );

// Save the field

function pure_save_tax_meta( $term_id ){

    if ( isset( $_POST['term_meta'] ) ) {

        $term_meta = array();

        // Be careful with the intval here. If it's text you could use sanitize_text_field()
        $term_meta['featured'] = isset ( $_POST['term_meta']['featured'] ) ? intval( $_POST['term_meta']['featured'] ) : '';

        // Save the option array.
        update_option( "taxonomy_$term_id", $term_meta );

    }
}
// save_tax_meta

add_action( 'edited_category', 'pure_save_tax_meta', 10, 2 );

// Add the dropdown to the Create form

add_action( 'category_add_form_fields', 'pure_edit_featured_category_field' );
add_action( 'create_category', 'pure_save_tax_meta', 10, 2 );


// Add column to Category list

function pure_featured_category_columns($columns)
{
    return array_merge($columns,
        array('featured' =>  __('Home Featured')));
}

add_filter('manage_edit-category_columns' , 'pure_featured_category_columns');

// Add the value to the column

function pure_featured_category_columns_values( $deprecated, $column_name, $term_id) {

    if($column_name === 'featured'){

        $term_meta = get_option( "taxonomy_$term_id" );

        if($term_meta['featured'] === 1){

            echo _e('Yes');
        }else{
            echo _e('No');
        }
    }
}

add_action( 'manage_category_custom_column' , 'pure_featured_category_columns_values', 10, 3 );

