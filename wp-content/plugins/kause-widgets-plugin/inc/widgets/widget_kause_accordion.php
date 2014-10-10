<?php

/**************************************
WIDGET: kause_accordion
***************************************/

	add_action('widgets_init', 'register_widget_kause_accordion' );
	function register_widget_kause_accordion () {
		register_widget('kause_accordion');	
	}

	class kause_accordion extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_accordion', 								
					'description' => __('Displays an accordion', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'kause_accordion' 														
				);

				$this->WP_Widget('kause_accordion', __('Kause: Accordion', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
				'widget_title' 	=> __('Accordion', "loc_kause_widgets_plugin"),
				'accordion'		=> array(
					0				=> array(
						'title'			=> "Accordion Trigger",
						'content'		=> "",
					),
				),
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> "><?php _e("Title", "loc_kause_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value="<?php if(isset($widget_title)) echo htmlspecialchars($widget_title); ?>">
				</p>

				<br>
				<?php _e("Accordion sections", "loc_kause_widgets_plugin"); ?>:
				<ul class="widget_sortable" data-split_index="3">
				<?php
					for ($i = 0; $i < count($accordion); $i++) {  
					?>

						<li>
							<input class="widefat li_option" type='text' name='<?php echo $this->get_field_name('accordion')."[".$i."][title]"; ?>' value="<?php if(isset($accordion[$i]['title'])) echo htmlspecialchars($accordion[$i]['title']); ?>">
							<textarea class='widefat li_option' name='<?php echo $this->get_field_name('accordion')."[".$i."][content]"; ?>' rows='5'><?php if (isset($accordion[$i]['content'])) echo $accordion[$i]['content']; ?></textarea>
						</li>
					<?php
					}
				?>

				</ul>

				<div class="ul_control" data-min="1" data-max="1000">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_kause_widgets_plugin"); ?>" />
					<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_kause_widgets_plugin"); ?>" />
				</div>



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
				$widget_title 		= __('Accordion', "loc_trades_widgets_plugin");
				$accordion			= array(
					0					=> array(
						'title'				=> "Accordion Trigger",
						'content'			=> "",
					),
				);
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

    			<ul class="accordion">

    				<?php
    					
    					for ($i = 0; $i < count($accordion); $i++) {  

				            // WPML
				            if (function_exists('icl_translate')) { $accordion[$i]['title'] = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[$i][title]", $accordion[$i]['title']); }
				            if (function_exists('icl_translate')) { $accordion[$i]['content'] = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[$i][content]", $accordion[$i]['content']); }

    					?>
		    			    <li>
		    			      <a href='#' class='accordion-btn<?php if ($i === 0) { echo " active"; } ?>'><?php echo $accordion[$i]['title']; ?></a>
		    			      <div class='accordion-content<?php if ($i === 0) { echo " active"; } ?>'>
		    			      	<p><?php echo $accordion[$i]['content']; ?></p>
		    			      </div>
		    			    </li>
    					<?php
    					}
    				
    				?>

    			  </ul>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



