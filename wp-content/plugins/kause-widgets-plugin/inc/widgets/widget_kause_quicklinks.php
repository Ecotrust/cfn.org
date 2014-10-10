<?php

/**************************************
WIDGET: kause_quicklinks
***************************************/

	add_action('widgets_init', 'register_widget_kause_quicklinks' );
	function register_widget_kause_quicklinks () {
		register_widget('kause_quicklinks');	
	}

	class kause_quicklinks extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_quicklinks', 								
					'description' => __('Display a list of links', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 200, 
					'id_base' => 'kause_quicklinks' 														
				);

				$this->WP_Widget('kause_quicklinks', __('Kause: Quicklinks', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
		}

		/**************************************
		2. UPDATE
		***************************************/
		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		/**************************************
		3. FORM
		***************************************/
		function form($instance) {

			//default for checkboxes
			if (empty($instance)) {
				$defaults_checkboxes = array(
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 	=> __('Quicklinks', "loc_kause_widgets_plugin"),
				'content' 	=> '<ul class="link-list">
	<li><a href="#">Kause Home Page</a></li>
	<li><a href="#">Sitemap Page</a></li>
	<li><a href="#">Contact Us Today</a></li>
	<li><a href="#">See Template Styles</a></li>
	<li><a href="#">Make a Donation</a></li>
	<li><a href="#">Read Our Blog</a></li>
</ul>',
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title:", "loc_kause_widgets_plugin"); ?> </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('content'); ?>'><?php _e("List of contact links", "loc_kause_widgets_plugin"); ?></label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('content'); ?>' name='<?php echo $this->get_field_name('content'); ?>' rows='15'><?php if (isset($content)) echo esc_attr($content); ?></textarea>
				</P>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);							

			// DEFAULTS
			if (empty($instance)) {
				$widget_title 		= __('Quicklinks', "loc_trades_widgets_plugin");
				$content 			= '<ul class="link-list">
	<li><a href="#">Trades Home Page</a></li>
	<li><a href="#">Sitemap Page</a></li>
	<li><a href="#">Contact Us Today</a></li>
	<li><a href="#">See Template Styles</a></li>
	<li><a href="#">Make a Donation</a></li>
	<li><a href="#">Read Our Blog</a></li>
</ul>';
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }
            if (function_exists('icl_translate')) { $content = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[content]", $content); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<?php echo $content; ?>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



