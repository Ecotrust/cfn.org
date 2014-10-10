<?php

/**************************************
WIDGET: kause_twitter
***************************************/

	add_action('widgets_init', 'register_widget_kause_twitter' );
	function register_widget_kause_twitter () {
		register_widget('kause_twitter');	
	}

	class kause_twitter extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_twitter', 								
					'description' => __('Display Twitter feed', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 400, 
					'height' => 350, 
					'id_base' => 'kause_twitter' 														
				);

				$this->WP_Widget('kause_twitter', __('Kause: Twitter', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
				'widget_title' 			=> __('Latest tweets', "loc_kause_widgets_plugin"),
				'twitter_num_tweets' 	=> 3,
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title", "loc_kause_widgets_plugin"); ?>: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('twitter_widget_code'); ?>'><?php _e("Twitter widget code", "loc_kause_widgets_plugin"); ?>: </label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('twitter_widget_code'); ?>' name='<?php echo $this->get_field_name('twitter_widget_code'); ?>' rows='10'><?php if (isset($twitter_widget_code)) echo esc_attr($twitter_widget_code); ?></textarea>
					<?php _e("Generate you own widget code here", "loc_kause_widgets_plugin"); ?>	: <a href='https://twitter.com/settings/widgets' target='_blank'>https://twitter.com/settings/widgets/</a>
				</P>

				<hr>

				<br>


				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'use_theme_design' ); ?>" name="<?php echo $this->get_field_name( 'use_theme_design' ); ?>" value="checked" <?php checked(isset($use_theme_design)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'use_theme_design' ); ?>"><?php _e("Use theme design instead?", "loc_kause_widgets_plugin"); ?>	</label>
				</p>


				<p>
					<label for='<?php echo $this->get_field_id('twitter_num_tweets'); ?>'><?php _e("Number of tweets", "loc_kause_widgets_plugin"); ?>: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('twitter_num_tweets'); ?>' 
						name='<?php echo $this->get_field_name('twitter_num_tweets'); ?>' 
						value='<?php if (isset($twitter_num_tweets)) echo esc_attr($twitter_num_tweets); ?>'
					>
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
				$widget_title 				= __('Latest tweets', "loc_trades_widgets_plugin");
				$twitter_num_tweets 		= 3;
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<div class='twitter_widget'>
				<?php 
					if (!empty($twitter_widget_code)) {
						echo $twitter_widget_code; 
					} else {
						echo "<i>".__("Please insert your Twitter widget code!", "loc_kause_widgets_plugin")."</i>";
					}
				?>

			</div>

			<div class='twitter_theme_design' data-theme_design='<?php if(isset($use_theme_design)) {echo "true";} else {echo "false";} ?>' data-num_tweets='<?php echo $twitter_num_tweets; ?>'>
					<ul class="tweets">
					</ul>
			</div>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



