<?php
/*
  Plugin Name: 25.some combine plugin
  Plugin URI: https://1stwebdesigner.com/wordpress-plugin-development/
  Description: Slider Component for WordPress
  Version: 1.0
  Author: Barry Eleas
  Author URI: http://puredevs.com/
  License: GPLv2 or later
 */


/*
* #################################
* My custom code start from here
* ###############################
*/


/*
* custom taxonomies
*/
function wporg_register_taxonomy_course()
{
$labels = [
'name'              => _x('Courses', 'taxonomy general name'),
'singular_name'     => _x('Course', 'taxonomy singular name'),
'search_items'      => __('Search Courses'),
'all_items'         => __('All Courses'),
'parent_item'       => __('Parent Course'),
'parent_item_colon' => __('Parent Course:'),
'edit_item'         => __('Edit Course'),
'update_item'       => __('Update Course'),
'add_new_item'      => __('Add New Course'),
'new_item_name'     => __('New Course Name'),
'menu_name'         => __('Course'),
];
$args = [
'hierarchical'      => true, // make it hierarchical (like categories)
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => ['slug' => 'course'],
];
register_taxonomy('course', ['post'], $args);
}
add_action('init', 'wporg_register_taxonomy_course');








 // Register custom category page for archive page or seach engine



function pure_category_set_post_types( $query ){
    if( $query->is_category() && $query->is_main_query() ){
        $query->set( 'post_type', array( 'post', 'page', 'news','services' ) );
    }
}
add_action( 'pre_get_posts', 'pure_category_set_post_types' );



// new custom fields in custom taxonomy


// Add term page
function pippin_taxonomy_add_new_meta_field() {
    // this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'pippin' ); ?></label>
        <input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
        <p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
    </div>
    <?php
}
add_action( 'athlete_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );



// Edit term page
function pippin_taxonomy_edit_meta_field($term) {

    // put the term ID into a variable
    $t_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "taxonomy_$t_id" ); ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'pippin' ); ?></label></th>
        <td>
            <input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
            <p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'athlete_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}
add_action( 'edited_athlete', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_athlete', 'save_taxonomy_custom_meta', 10, 2 );