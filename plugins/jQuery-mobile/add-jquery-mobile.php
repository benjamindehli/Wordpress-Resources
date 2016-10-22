<?php
/* Plugin Name: Add jQuery Mobile
Description: Add jQuery mobile JavaScript Framework
Author: Benjamin Dehli
Version: 1.0.0
Author URI: https://github.com/benjamindehli
*/

function add_jquery_mobile() {
	wp_register_script( 'jquery-mobile-config', plugins_url( '/js/jquery-mobile-config.js', __FILE__ ) );
	wp_enqueue_script( 'jquery-mobile-config', false, array(), false, true );
	wp_enqueue_script(
		"jqm_js",
		"http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js",
		array("jquery"),
		"1.4.5",
		true
		);
}
add_action("wp_enqueue_scripts", "add_jquery_mobile");
?>