<?php
add_action ('add_meta_boxes', 'starter_theme_example_meta_box');
// use post type array and  foreach to add to several screens
function starter_theme_example_meta_box(){
       add_meta_box(  'starter-theme-meta',
        __('Example Meta', 'starter-theme'),
        'starter_theme_meta_callback',
        'example_post_type' 
        );
}


function starter_theme_meta_callback($post){
    wp_nonce_field( 'starter_theme_meta_nonce', 'starter_theme_meta_nonce_wp_nonce' );

    $value = get_post_meta( $post->ID, '_starter_theme_meta', true );
    echo '<textarea style="width:100%" id="starter_theme_meta" name="starter_theme_meta">' . esc_html( $value ) . '</textarea>';

}


add_action('save_post', 'starter_theme_meta_save_data');
function starter_theme_meta_save_data( $post_id){
    // if nonce is set
    if (!isset($_POST['starter_theme_meta_nonce_wp_nonce'])){
        return;
    }
    // if nonce is valid
    if (!wp_verify_nonce( $_POST['starter_theme_meta_nonce_wp_nonce'], 'starter_theme_meta_nonce' )){
        return;
    }
    // if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }
      // Check the user's permissions.
      if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    }
    else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( !isset($_POST['starter_theme_meta']))
    {
        return;
    } 
    $data = sanitize_text_field( $_POST['starter_theme_meta'] );
    update_post_meta($post_id, '_starter_theme_meta', $data);

}