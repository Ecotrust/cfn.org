<?php

/**************************************
WIDGET: kause_quote
***************************************/

	add_action('widgets_init', 'register_widget_kause_quote' );
	function register_widget_kause_quote () {
		register_widget('kause_quote');	
	}

	class kause_quote extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_quote', 								
					'description' => __('Displays a quote', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'kause_quote' 														
				);

				$this->WP_Widget('kause_quote', __('Kause: Quote', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
					// 'fb_faces' => 'checked'
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 	=> __('Quote', "loc_kause_widgets_plugin"),
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title", "loc_kause_widgets_plugin"); ?>: </label><br>
					<input class="widefat" type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('quote'); ?>'><?php _e("Quote", "loc_kause_widgets_plugin"); ?></label><br>
					<textarea class='widefat' name='<?php echo $this->get_field_name('quote'); ?>' rows='5'><?php if (isset($quote)) echo esc_attr($quote); ?></textarea>
				</P>

				<p>
					<label for="<?php echo $this->get_field_id('byline'); ?> "><?php _e("Byline", "loc_kause_widgets_plugin"); ?>: </label><br>
					<input class="widefat" type='text' id='<?php echo $this->get_field_id('byline'); ?>' name='<?php echo $this->get_field_name('byline'); ?>' value="<?php if(isset($byline)) echo htmlspecialchars($byline); ?>">
				</p>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);							

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }
            if (function_exists('icl_translate')) { $quote = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[quote]", $quote); }
            if (function_exists('icl_translate')) { $byline = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[byline]", $byline); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<blockquote>
				<?php echo $quote; ?>
				<?php if (!empty($byline)) { printf('<cite>- %s</cite>', $byline); } ?>
			
			</blockquote>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



