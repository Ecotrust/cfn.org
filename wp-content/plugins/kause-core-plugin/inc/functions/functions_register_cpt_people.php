<?php

/**************************************
INDEX

REGISTER CUSTOM POST FORMAT: PEOPLE
CUSTOM MESSAGES: PEOPLE
CUSTOM TAXONOMIES: PEOPLE CATEGORY

***************************************/


/**************************************
REGISTER CUSTOM POST FORMAT: PEOPLE
***************************************/

add_action( 'init', 'canon_register_cpt_people' );

function canon_register_cpt_people() {

	$labels = array(
		'name'               => _x( 'People', 'post type general name', 'loc_kause_core_plugin' ),
		'singular_name'      => _x( 'People', 'post type singular name', 'loc_kause_core_plugin' ),
		'add_new'            => _x( 'Add New', 'book', 'loc_kause_core_plugin' ),
		'add_new_item'       => __( 'Add New People', 'loc_kause_core_plugin' ),
		'edit_item'          => __( 'Edit People', 'loc_kause_core_plugin' ),
		'new_item'           => __( 'New People', 'loc_kause_core_plugin' ),
		'all_items'          => __( 'All People', 'loc_kause_core_plugin' ),
		'view_item'          => __( 'View People', 'loc_kause_core_plugin' ),
		'search_items'       => __( 'Search People', 'loc_kause_core_plugin' ),
		'not_found'          => __( 'No people found', 'loc_kause_core_plugin' ),
		'not_found_in_trash' => __( 'No people found in the Trash', 'loc_kause_core_plugin' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'People'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our people and people specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' 		=> array('slug' => 'people'),
	);

	register_post_type( 'cpt_people', $args );	
}

/**************************************
CUSTOM MESSAGES:PEOPLE
***************************************/

add_filter( 'post_updated_messages', 'canon_cpt_people_messages' );

function canon_cpt_people_messages($messages) {
	global $post, $post_ID;

	$messages['cpt_people'] = array(
		0 => '', 
		1 => sprintf( __('People updated. <a href="%s">View people</a>'), esc_url( get_permalink($post_ID), 'loc_kause_core_plugin' ) ),
		2 => __('Custom field updated.', 'loc_kause_core_plugin'),
		3 => __('Custom field deleted.', 'loc_kause_core_plugin'),
		4 => __('People updated.', 'loc_kause_core_plugin'),
		5 => isset($_GET['revision']) ? sprintf( __('People restored to revision from %s', 'loc_kause_core_plugin'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('People published. <a href="%s">View people</a>'), esc_url( get_permalink($post_ID) ), 'loc_kause_core_plugin' ),
		7 => __('People saved.', 'loc_kause_core_plugin'),
		8 => sprintf( __('People submitted. <a target="_blank" href="%s">Preview people</a>', 'loc_kause_core_plugin'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('People scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview people</a>', 'loc_kause_core_plugin'), date_i18n( __( 'M j, Y @ G:i', 'loc_kause_core_plugin' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('People draft updated. <a target="_blank" href="%s">Preview people</a>', 'loc_kause_core_plugin'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

/**************************************
CUSTOM TAXONOMIES: PEOPLE CATEGORY
***************************************/

add_action( 'init', 'canon_cpt_people_taxonomy_category', 0 );

function canon_cpt_people_taxonomy_category() {
	$labels = array(
		'name'              => _x( 'People Categories', 'taxonomy general name', 'loc_kause_core_plugin' ),
		'singular_name'     => _x( 'People Category', 'taxonomy singular name', 'loc_kause_core_plugin' ),
		'search_items'      => __( 'Search People Categories', 'loc_kause_core_plugin' ),
		'all_items'         => __( 'All People Categories', 'loc_kause_core_plugin' ),
		'parent_item'       => __( 'Parent People Category', 'loc_kause_core_plugin' ),
		'parent_item_colon' => __( 'Parent People Category:', 'loc_kause_core_plugin' ),
		'edit_item'         => __( 'Edit People Category', 'loc_kause_core_plugin' ), 
		'update_item'       => __( 'Update People Category', 'loc_kause_core_plugin' ),
		'add_new_item'      => __( 'Add New People Category', 'loc_kause_core_plugin' ),
		'new_item_name'     => __( 'New People Category', 'loc_kause_core_plugin' ),
		'menu_name'         => __( 'People Categories', 'loc_kause_core_plugin' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'people_category', 'cpt_people', $args );
}
