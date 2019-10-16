jQuery(document).ready( function(){
    jQuery('.count_btn').on('click', function(e) {
        var post_type = jQuery(this).data( 'type' );  // Get post type via the 'data-type' attribute of the button.

        jQuery('#'+post_type+'_count').html('?');  // Clear existing value.

        e.preventDefault();

        jQuery.ajax({
            url : aj_ajax_demo.ajax_url, // Note that 'aj_ajax_demo' is from the wp_localize_script() call.
            type : 'post',
            data : {
                action : 'aj_ajax_demo_get_count',  // Note that this is part of the add_action() call.
                nonce : aj_ajax_demo.aj_demo_nonce,  // Note that 'aj_demo_nonce' is from the wp_localize_script() call.
                post_type : post_type
            },
            success : function( response ) {
                jQuery('#'+post_type+'_count').html(response);  // Change the div's contents to the result.
            },
            error : function( response ) {
                alert('Error retrieving the information: ' + response.status + ' ' + response.statusText);
                console.log(response);
            }
        });
    });
});