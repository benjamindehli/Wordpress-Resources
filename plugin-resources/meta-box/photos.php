<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */


add_filter( 'rwmb_meta_boxes', 'photos_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function photos_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'photos_';


	// 1st meta box
	$meta_boxes[] = array(

		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'photos',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => esc_html__( 'Photos', 'photos' ),

		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page', 'gallery' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',

		// Auto save: true, false (default). Optional.
		'autosave'   => true,

		'fields' => array(			
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Image Upload', 'photos' ),
				'id'               => "{$prefix}imgadv",
				'type'             => 'image_advanced',
			),

		)
	);

	return $meta_boxes;
}
