<?php

/**************************************
WIDGET: kause_statistics
***************************************/

	add_action('widgets_init', 'register_widget_kause_statistics' );
	function register_widget_kause_statistics () {
		register_widget('kause_statistics');	
	}

	class kause_statistics extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_statistics', 								
					'description' => __('Display statistics', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 550, 
					'height' => 350, 
					'id_base' => 'kause_statistics' 														
				);

				$this->WP_Widget('kause_statistics', __('Kause: Statistics', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
				'widget_title' 	=> __('Statistics', "loc_kause_widgets_plugin"),
				'statistic'		=> array(
					0 				=> array(
						'icon'			=> 'fa-flag',
						'stat_text'		=> 'Fundraising',
						'stat_num'		=> '10%',
					),
				),
				'text'			=> "",
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			//get font awesome array
			$font_awesome_array = kause_widgets_plugin_get_font_awesome_icon_names_in_array();

			$statistic = array_values($statistic);	

			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title", "loc_kause_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<br>
				Statistics:
				<ul class="widget_sortable" data-split_index="3">
				<?php
					for ($i = 0; $i < count($statistic); $i++) {  
					?>

						<li>
							<select class="li_option fa_select" name='<?php echo $this->get_field_name('statistic')."[".$i."][icon]"; ?>'> 
								<?php 

									for ($n = 0; $n < count($font_awesome_array); $n++) {  
									?>
				     					<option value="<?php echo $font_awesome_array[$n]; ?>" <?php if (isset($statistic[$i]['icon'])) {if ($statistic[$i]['icon'] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo $font_awesome_array[$n]; ?></option> 
									<?php
									}

								?>
							</select> 

							<i class="fa <?php if (isset($statistic[$i]['icon'])) { echo $statistic[$i]['icon']; } else { echo "fa-flag"; } ?>"></i>

							Text: <input class="li_option" type='text' name='<?php echo $this->get_field_name('statistic')."[".$i."][stat_text]"; ?>' value="<?php if(isset($statistic[$i]["stat_text"])) echo htmlspecialchars($statistic[$i]["stat_text"]); ?>">
							Number: <input class="li_option nums" type='text' name='<?php echo $this->get_field_name('statistic')."[".$i."][stat_num]"; ?>' value="<?php if(isset($statistic[$i]["stat_num"])) echo htmlspecialchars($statistic[$i]["stat_num"]); ?>">

						</li>
					<?php
					}
				?>

				</ul>

				<div class="ul_control" data-min="1" data-max="1000">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_kause_widgets_plugin"); ?>" />
					<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_kause_widgets_plugin"); ?>" />
				</div>

				<br>

				<p>
					<label for='<?php echo $this->get_field_id('text'); ?>'><?php _e("Statistics text", "loc_kause_widgets_plugin"); ?></label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('text'); ?>' name='<?php echo $this->get_field_name('text'); ?>' rows='6'><?php if (isset($text)) echo esc_attr($text); ?></textarea>
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
				$widget_title 		= __('Statistics', "loc_trades_widgets_plugin");
				$statistic			= array(
					0 					=> array(
						'icon'				=> 'fa-flag',
						'stat_text'			=> 'Fundraising',
						'stat_num'			=> '10%',
					),
				);
				$text				= "";
			}

			$statistic = array_values($statistic);						

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }
            if (function_exists('icl_translate')) { $text = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[text]", $text); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<ul class="statistics">
				<?php 

					for ($i = 0; $i < count($statistic); $i++) {  
						
			            // WPML
			            if (function_exists('icl_translate')) { $statistic[$i]['stat_text'] = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[$i][stat_text]", $statistic[$i]['stat_text']); }
			            if (function_exists('icl_translate')) { $statistic[$i]['stat_num'] = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[$i][stat_num]", $statistic[$i]['stat_num']); }

						printf('<li><em class="fa %s"></em> %s - <span>%s</span></li>', 
							esc_attr($statistic[$i]['icon']),
							esc_attr($statistic[$i]['stat_text']),
							esc_attr($statistic[$i]['stat_num'])
						);
					}

				?>
			</ul>

			<?php 

				if (!empty($text) || !empty($read_more_link)) {
					echo "<p>";
					if (!empty($text)) { echo $text; }
					if (!empty($read_more_link)) { printf('&#8230;<a class="more" href="%s">%s</a>', esc_url($read_more_link), __("more", "loc_kause_widgets_plugin")); }
					echo "</p>";
				}

			?>	

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



