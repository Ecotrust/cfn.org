<?php

/**************************************
WIDGET: kause_contact_list
***************************************/

	add_action('widgets_init', 'register_widget_kause_contact_list' );
	function register_widget_kause_contact_list () {
		register_widget('kause_contact_list');	
	}

	class kause_contact_list extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_contact_list', 								
					'description' => __('Display a list of contact links', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'kause_contact_list' 														
				);

				$this->WP_Widget('kause_contact_list', __('Kause: Contact list', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
				'widget_title' 	=> __('Find us at', "loc_kause_widgets_plugin"),
				'content' 	=> '<ul>
    <li><a href="#">facebook.com/kause</a></li>
    <li><a href="#">dribbble.com/kause</a></li>
    <li><a href="#">Twitter.com/kause</a></li>
    <li>PO Box 4356, Melbourne 4000
    Victoria, Australia</li>
</ul> ',
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
				$widget_title	= __('Find us at', "loc_trades_widgets_plugin");
				$content	= '<ul>
				    <li><a href="#">facebook.com/trades</a></li>
				    <li><a href="#">dribbble.com/trades</a></li>
				    <li><a href="#">Twitter.com/trades</a></li>
				    <li>PO Box 4356, Melbourne 4000
				    Victoria, Australia</li>
				</ul> ';
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



