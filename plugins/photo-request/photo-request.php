<?php
/* Plugin Name: PhotoRequest
Description: Add photos from gallery to contact form
Author: Benjamin Dehli
Version: 1.0.0
Author URI: https://github.com/benjamindehli
*/

function add_photo_request()
{
    wp_register_script( 'photo-request', plugins_url( '/js/photo-request.js', __FILE__ ) );
    wp_enqueue_script( 'photo-request' );
}
add_action( 'wp_enqueue_scripts', 'add_photo_request' );
