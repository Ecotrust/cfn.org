<?php

/**************************************
WIDGET: kause_search
***************************************/

	add_action('widgets_init', 'register_widget_kause_search' );
	function register_widget_kause_search () {
		register_widget('kause_search');	
	}

	class kause_search extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_search', 								
					'description' => __("Display Kause search", "loc_kause_widgets_plugin")		 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'kause_search' 														
				);

				$this->WP_Widget('kause_search', __("Kause: Search", "loc_kause_widgets_plugin")	 , $widget_ops, $control_ops );	
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
					'fb_faces' => 'checked'
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 				=> __("Search", "loc_kause_widgets_plugin")	,
				'widget_placeholder_text' 	=> __("Search...", "loc_kause_widgets_plugin")	,
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title", "loc_kause_widgets_plugin"); ?>	: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('widget_placeholder_text'); ?> "><?php _e("Placeholder text", "loc_kause_widgets_plugin"); ?>	: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_placeholder_text'); ?>' name='<?php echo $this->get_field_name('widget_placeholder_text'); ?>' value="<?php if(isset($widget_placeholder_text)) echo htmlspecialchars($widget_placeholder_text); ?>">
				</p>

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
				$widget_title 				= __("Search", "loc_trades_widgets_plugin");
				$widget_placeholder_text 	= __("Search...", "loc_trades_widgets_plugin");
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }
            if (function_exists('icl_translate')) { $widget_placeholder_text = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_placeholder_text]", $widget_placeholder_text); }
            
			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

	    		<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	    			<input type="text" id="s" class="full" name="s" placeholder="<?php echo $widget_placeholder_text; ?>" />
	    		</form>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



