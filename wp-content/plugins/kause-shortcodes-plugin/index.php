<?php

/*
Plugin Name: Kause Shortcodes Plugin
Plugin URI: http://www.themecanon.com
Description: Shortcodes plugin for Kause theme by Theme Canon.
Version: 1.0
Author: Theme Canon
Auhtor URI: http://www.themecanon.com
*/



/**************************************
INDEX

INFO
PHP INCLUDES
WP ENQUEUE
PLUGIN LOCALIZATION INIT

***************************************/

/**************************************
INFO

Lightbox shortcodes are dependent upon fancybox which is not included in plugin.

***************************************/


/**************************************
PHP INCLUDES
***************************************/

	include 'inc/functions/shortcodes.php';



/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','kause_shortcodes_plugin_load_to_front');
	function kause_shortcodes_plugin_load_to_front() {

		// scripts (js)
		wp_enqueue_script('kause_shortcodes_plugin_scripts', plugins_url('', __FILE__ ) . '/js/scripts.js', array(), false, true);
		wp_enqueue_script('kause_shortcodes_plugin_flexslider', plugins_url('', __FILE__ ) . '/js/jquery.flexslider-min.js', array(), false, true);
		
		//style (css)	
		wp_enqueue_style('kause_shortcodes_plugin_style', plugins_url('', __FILE__ ) . '/css/tc_shortCodes.css');
		wp_enqueue_style('kause_shortcodes_plugin_flexslider_style', plugins_url('', __FILE__ ) . '/css/flexslider.css');
		
	}

	//back end includes
	add_action('admin_enqueue_scripts', 'kause_shortcodes_plugin_load_to_back');
	function kause_shortcodes_plugin_load_to_back() {

	}


/**************************************
PLUGIN LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'kause_shortcodes_plugin_localization_setup');
	function kause_shortcodes_plugin_localization_setup() {
	    load_plugin_textdomain('loc_kause_shortcodes_plugin', false,  plugins_url('', __FILE__) . '/lang/');
	}

