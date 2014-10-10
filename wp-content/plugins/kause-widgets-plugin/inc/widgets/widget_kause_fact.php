<?php

/**************************************
WIDGET: kause_fact
***************************************/

	add_action('widgets_init', 'register_widget_kause_fact' );
	function register_widget_kause_fact () {
		register_widget('kause_fact');	
	}

	class kause_fact extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_fact', 								
					'description' => __('Displays a fact box', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'kause_fact' 														
				);

				$this->WP_Widget('kause_fact', __('Kause: Fact Box', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
				'widget_title' 	=> __('Did You Know', "loc_kause_widgets_plugin"),
				'fact1' 		=> "253.000",
				'fact1_ratio' 	=> 0.373,
				'fact2' 		=> "Animals are displaced every year",
				'fact2_ratio' 	=> 1.1,
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
					<label for="<?php echo $this->get_field_id('fact1'); ?> "><?php _e("Fact 1st line", "loc_kause_widgets_plugin"); ?>: </label><br>
					<input class="widefat" type='text' id='<?php echo $this->get_field_id('fact1'); ?>' name='<?php echo $this->get_field_name('fact1'); ?>' value="<?php if(isset($fact1)) echo htmlspecialchars($fact1); ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('fact1_ratio'); ?> "><?php _e("Fittext ratio", "loc_kause_widgets_plugin"); ?>: <i>(<?php _e("higher numbers = smaller text", "loc_kause_widgets_plugin"); ?>)</i></label><br>
					<input type='text' id='<?php echo $this->get_field_id('fact1_ratio'); ?>' name='<?php echo $this->get_field_name('fact1_ratio'); ?>' value="<?php if(isset($fact1_ratio)) echo htmlspecialchars($fact1_ratio); ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('fact2'); ?> "><?php _e("Fact 2nd line", "loc_kause_widgets_plugin"); ?>: </label><br> 
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('fact2'); ?>' name='<?php echo $this->get_field_name('fact2'); ?>' value="<?php if(isset($fact2)) echo htmlspecialchars($fact2); ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('fact2_ratio'); ?> "><?php _e("Fittext ratio", "loc_kause_widgets_plugin"); ?>: <i>(higher numbers = smaller text)</i></label><br>
					<input type='text' id='<?php echo $this->get_field_id('fact2_ratio'); ?>' name='<?php echo $this->get_field_name('fact2_ratio'); ?>' value="<?php if(isset($fact2_ratio)) echo htmlspecialchars($fact2_ratio); ?>">
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('fact_text'); ?>'><?php _e("Fact text", "loc_kause_widgets_plugin"); ?></label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('fact_text'); ?>' name='<?php echo $this->get_field_name('fact_text'); ?>' rows='6'><?php if (isset($fact_text)) echo esc_attr($fact_text); ?></textarea>
				</P>

				<p>
					<label for="<?php echo $this->get_field_id('read_more_link'); ?> "><?php _e("Read More Link", "loc_kause_widgets_plugin"); ?>: (optional)</label><br> 
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('read_more_link'); ?>' name='<?php echo $this->get_field_name('read_more_link'); ?>' value="<?php if(isset($read_more_link)) echo htmlspecialchars($read_more_link); ?>">
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
				$widget_title 			= __('Did You Know', "loc_trades_widgets_plugin");
				$fact1 					= "253.000";
				$fact1_ratio 			= 0.373;
				$fact2 					= "Animals are displaced every year";
				$fact2_ratio 			= 1.1;
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }
            if (function_exists('icl_translate')) { $fact1 = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[fact1]", $fact1); }
            if (function_exists('icl_translate')) { $fact2 = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[fact2]", $fact2); }
            if (function_exists('icl_translate')) { $fact1_ratio = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[fact1_ratio]", $fact1_ratio); }
            if (function_exists('icl_translate')) { $fact2_ratio = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[fact2_ratio]", $fact2_ratio); }
            if (function_exists('icl_translate')) { $fact_text = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[fact_text]", $fact_text); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<h4 class="fittext" data-ratio="<?php echo $fact1_ratio; ?>"><?php echo $fact1; ?></h4>
			<h3 class="fittext" data-ratio="<?php echo $fact2_ratio; ?>"><?php echo $fact2; ?></h3>

			<?php 

				if (!empty($fact_text) || !empty($read_more_link)) {
					echo "<p>";
					if (!empty($fact_text)) { echo $fact_text; }
					if (!empty($read_more_link)) { printf('&#8230;<a class="more" href="%s">%s</a>', esc_url($read_more_link), __("more", "loc_kause_widgets_plugin")); }
					echo "</p>";
				}

			?>	

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



