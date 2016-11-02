<?php
/* Plugin Name: Visbook Form Elements
Description: Form elements for visbook online booking
Author: Benjamin Dehli
Version: 1.0.0
Author URI: https://github.com/benjamindehli
*/

function add_visbook_form_elements()
{
    wp_register_script( 'visbook-form-elements', plugins_url( '/js/visbook-form-elements.js', __FILE__ ) );
    wp_enqueue_script( 'visbook-form-elements' );
}
add_action( 'wp_enqueue_scripts', 'add_visbook_form_elements' );
