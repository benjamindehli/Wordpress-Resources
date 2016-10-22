<?php
/* Plugin Name: PhotoModal
Description: Modal view for photos
Author: Benjamin Dehli
Version: 1.0.0
Author URI: https://github.com/benjamindehli
*/

function add_photo_modal()
{
    wp_register_script( 'custom-script', plugins_url( '/js/photo-modal.js', __FILE__ ) );
    wp_enqueue_script( 'custom-script' );
    wp_enqueue_script( 'jquery-masonry' );
}
add_action( 'wp_enqueue_scripts', 'add_photo_modal' );
