<?php

/**************************************
WIDGET: widget_kause_facebook
***************************************/

	add_action('widgets_init', 'register_widget_widget_kause_facebook' );
	function register_widget_widget_kause_facebook () {
		register_widget('widget_kause_facebook');	
	}

	class widget_kause_facebook extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'widget_kause_facebook', 								
					'description' => __('Display Facebook box', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 350, 
					'height' => 350, 
					'id_base' => 'widget_kause_facebook' 														
				);

				$this->WP_Widget('widget_kause_facebook', __('Kause: Facebook', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
					'fb_faces' 		=> 'unchecked',
					'fb_wall' 		=> 'unchecked',
					'fb_header' 	=> 'unchecked',
					'fb_border' 	=> 'checked',
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 	=> __('Like us on facebook', "loc_kause_widgets_plugin"),
				'fb_page' 		=> "https://www.facebook.com/themecanon",
				'fb_style'		=> 'light',
				'fb_width'		=> '300',
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title", "loc_kause_widgets_plugin"); ?>: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('fb_page'); ?>'><?php _e("Facebook Page", "loc_kause_widgets_plugin"); ?>: </label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('fb_page'); ?>' name='<?php echo $this->get_field_name('fb_page'); ?>' value='<?php if (!empty($fb_page)) echo esc_attr($fb_page); ?>'>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('fb_width'); ?>'><?php _e("Width in pixels", "loc_kause_widgets_plugin"); ?>: <i>(<?php _e("Default: 300. Sidebar is 207.", "loc_kause_widgets_plugin"); ?>)</i> </label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('fb_width'); ?>' name='<?php echo $this->get_field_name('fb_width'); ?>' value='<?php if (!empty($fb_width)) echo esc_attr($fb_width); ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('fb_style'); ?> "><?php _e("Color scheme", "loc_kause_widgets_plugin"); ?>:</label><br>
					<select name="<?php echo $this->get_field_name('fb_style'); ?>"> 
		     			<option value="light" <?php if (isset($fb_style)) {if ($fb_style == "light") echo "selected='selected'";} ?>><?php _e("Light", "loc_kause_widgets_plugin"); ?></option> 
		     			<option value="dark" <?php if (isset($fb_style)) {if ($fb_style == "dark") echo "selected='selected'";} ?>><?php _e("Dark", "loc_kause_widgets_plugin"); ?></option> 
					</select> 
				</p>

				<br>

				<p>
					<input type="hidden" name="<?php echo $this->get_field_name( 'fb_header' ); ?>" value="unchecked" />
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_header' ); ?>" name="<?php echo $this->get_field_name( 'fb_header' ); ?>" value="checked" <?php checked($fb_header == "checked"); ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_header' ); ?>"><?php _e("Show header", "loc_kause_widgets_plugin"); ?>?</label>
				</p>

				<p>
					<input type="hidden" name="<?php echo $this->get_field_name( 'fb_wall' ); ?>" value="unchecked" />
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_wall' ); ?>" name="<?php echo $this->get_field_name( 'fb_wall' ); ?>" value="checked" <?php checked($fb_wall == "checked"); ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_wall' ); ?>"><?php _e("Show wall", "loc_kause_widgets_plugin"); ?>?</label>
				</p>

				<p>
					<input type="hidden" name="<?php echo $this->get_field_name( 'fb_faces' ); ?>" value="unchecked" />
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_faces' ); ?>" name="<?php echo $this->get_field_name( 'fb_faces' ); ?>" value="checked" <?php checked($fb_faces == "checked"); ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_faces' ); ?>"><?php _e("Show faces", "loc_kause_widgets_plugin"); ?>?</label>
				</p>

				<p>
					<input type="hidden" name="<?php echo $this->get_field_name( 'fb_border' ); ?>" value="unchecked" />
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_border' ); ?>" name="<?php echo $this->get_field_name( 'fb_border' ); ?>" value="checked" <?php checked($fb_border == "checked"); ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_border' ); ?>"><?php _e("Show border", "loc_kause_widgets_plugin"); ?>?</label>
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
				$fb_faces 		= 'unchecked';
				$fb_wall 		= 'unchecked';
				$fb_header		= 'unchecked';
				$fb_border 		= 'checked';
				$widget_title 	= __('Like us on facebook', "loc_trades_widgets_plugin");
				$fb_page 		= "https://www.facebook.com/themecanon";
				$fb_style		= 'light';
				$fb_width		= '300';
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

				<div class="fb-like-box" 
					data-href="<?php echo $fb_page; ?>" 
					data-colorscheme="<?php echo $fb_style; ?>"
					data-width="<?php echo esc_attr($fb_width); ?>"
					data-show-faces=<?php if ($fb_faces == "checked") {echo "true";} else {echo "false";} ?>
					data-header=<?php if ($fb_header == "checked") {echo "true";} else {echo "false";} ?>
					data-stream=<?php if ($fb_wall == "checked") {echo "true";} else {echo "false";} ?>  
					data-show-border=<?php if ($fb_border == "checked") {echo "true";} else {echo "false";} ?>
				>
				</div>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



