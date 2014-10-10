<?php
/**
 * Community Fisheries functions and definitions
 *
 * @package community fisheries
 */

function fisheries_add_custom_js() {
	if ( !is_admin() ) {

		wp_register_script('fisheries',
		       get_stylesheet_directory_uri() . '/js/fisheries.js',
		       array('jquery'),
		 	   '1.0');

		// enqueue the scripts
		wp_enqueue_script('fisheries');
	}
}

add_action('init', 'fisheries_add_custom_js');