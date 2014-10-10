<?php

/*
Plugin Name: Kause Widgets Plugin
Plugin URI: http://www.themecanon.com
Description: Custom widgets for Kause theme by Theme Canon.
Version: 1.0
Author: Theme Canon
Auhtor URI: http://www.themecanon.com
*/


/**************************************
NOTES

Plugins in this widget:
- Kause: More Posts.
- Kause: Twitter.
- Kause: Search.

- Kause: More Posts.
This widget taps into the post meta: "post_views" to determine most popular posts by view. (NB: data not supplied by plugin).
This widget uses a custom field (post): "cmb_hide_from_popular". (NB: data not supplied by plugin).

***************************************/

/**************************************
INDEX

PLUGIN LOCALIZATION INIT
PHP INCLUDES
WP ENQUEUE
IMAGE SIZES
FACEBOOK LIKE BOX MECHANICS

***************************************/

/**************************************
PLUGIN LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'kause_widgets_plugin_localization_setup');
	function kause_widgets_plugin_localization_setup() {
	    load_plugin_textdomain('loc_kause_widgets_plugin', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/');
	}


/**************************************
PHP INCLUDES
***************************************/

	include 'inc/functions/functions_font_awesome.php';

	// include widgets
	include 'inc/widgets/widget_kause_more_posts.php';
	include 'inc/widgets/widget_kause_twitter.php';
	include 'inc/widgets/widget_kause_search.php';
	include 'inc/widgets/widget_kause_contact_list.php';
	include 'inc/widgets/widget_kause_quicklinks.php';
	include 'inc/widgets/widget_kause_fact.php';
	include 'inc/widgets/widget_kause_statistics.php';
	include 'inc/widgets/widget_kause_single_post.php';
	include 'inc/widgets/widget_kause_quote.php';
	include 'inc/widgets/widget_kause_accordion.php';
	include 'inc/widgets/widget_kause_tabs.php';
	include 'inc/widgets/widget_kause_toggle.php';
	include 'inc/widgets/widget_kause_facebook.php';



/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','kause_widgets_plugin_load_to_front');
	function kause_widgets_plugin_load_to_front() {

		//front end scripts (js)
		wp_enqueue_script('kause_widgets_plugin_scripts', plugins_url('', __FILE__ ) . '/js/scripts.js', array(), false, true);
		wp_enqueue_script('kause_widgets_plugin_cleantabs', plugins_url('', __FILE__ ) . '/js/cleantabs.jquery.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('kause_widgets_plugin_style', plugins_url('', __FILE__ ) . '/css/style.css');
		wp_enqueue_style('kause_widgets_font_awesome_style', get_template_directory_uri(). '/css/font-awesome.css');


	}

	//back end includes
	add_action('admin_enqueue_scripts', 'kause_widgets_plugin_load_to_back');  //this was changed to admin_enqueue_scripts from action hook admin_footer. Let's see if it makes a difference
	function kause_widgets_plugin_load_to_back() {

		//back end scripts (js)
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', false, array(), false, true);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		// wp_enqueue_script('thickbox', false, array(), false, true);					
		// wp_enqueue_script('media-upload', false, array(), false, true);
		// wp_enqueue_script('canon_colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, true);
		wp_enqueue_script('kause_widgets_plugin_backend_scripts', plugins_url('', __FILE__ ) . '/js/backend_scripts.js', array(), false, true);


		//style (css)	
		wp_enqueue_style('kause_widgets_plugin_backend_style', plugins_url('', __FILE__ ) . '/css/backend.css');
		wp_enqueue_style('kause_widgets_font_awesome_backend_style', get_template_directory_uri(). '/css/font-awesome.css');

	}

/**************************************
IMAGE SIZES
***************************************/

	add_image_size( 'widget_more_posts_thumb', 1400, 933, true);


/**************************************
FACEBOOK LIKE BOX MECHANICS
***************************************/

	add_action('wp_footer', 'add_facebook_js');  
	function add_facebook_js () {
	?>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>	
	<?php
	}