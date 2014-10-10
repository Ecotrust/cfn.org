<?php

/**************************************
WIDGET: kause_tabs
***************************************/

	add_action('widgets_init', 'register_widget_kause_tabs' );
	function register_widget_kause_tabs () {
		register_widget('kause_tabs');	
	}

	class kause_tabs extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'kause_tabs', 								
					'description' => __('Displays tabs', "loc_kause_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'kause_tabs' 														
				);

				$this->WP_Widget('kause_tabs', __('Kause: Tabs', "loc_kause_widgets_plugin"), $widget_ops, $control_ops );	
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
				'widget_title' 	=> __('Tabs', "loc_kause_widgets_plugin"),
				'tabs'		=> array(
					0				=> array(
						'title'			=> "Tab",
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
				<?php _e("Tabs", "loc_kause_widgets_plugin"); ?>:
				<ul class="widget_sortable" data-split_index="3">
				<?php
					for ($i = 0; $i < count($tabs); $i++) {  
					?>

						<li>
							<input class="widefat li_option" type='text' name='<?php echo $this->get_field_name('tabs')."[".$i."][title]"; ?>' value="<?php if(isset($tabs[$i]['title'])) echo htmlspecialchars($tabs[$i]['title']); ?>">
							<textarea class='widefat li_option' name='<?php echo $this->get_field_name('tabs')."[".$i."][content]"; ?>' rows='5'><?php if (isset($tabs[$i]['content'])) echo $tabs[$i]['content']; ?></textarea>
						</li>
					<?php
					}
				?>

				</ul>

				<div class="ul_control" data-min="1" data-max="5">
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
				$widget_title 		= __('Tabs', "loc_trades_widgets_plugin");
				$tabs				= array(
					0					=> array(
						'title'				=> "Tab",
						'content'			=> "",
					),
				);
			}

            // WPML
            if (function_exists('icl_translate')) { $widget_title = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[widget_title]", $widget_title); }

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<div id="<?php echo $widget_id; ?>-tab-container">
		
				<!-- Navigation for Tabs -->
				<ul class="tab-nav left">
					<?php
						
						for ($i = 0; $i < count($tabs); $i++) {  

				            // WPML
				            if (function_exists('icl_translate')) { $tabs[$i]['title'] = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[$i][title]", $tabs[$i]['title']); }

						?>
							<li data-tab="<?php printf('%s-tab-%d', esc_attr($widget_id), esc_attr($i)); ?>" <?php if($i === 0) { echo "class='active'"; } ?>><?php echo $tabs[$i]['title']; ?></li>
						<?php
						}
					
					?>
				</ul>
		 
		 
		 		<!-- Tab Content -->
				<div class="tab-content-block clearfix">

					<?php
						
						for ($i = 0; $i < count($tabs); $i++) {  

				            // WPML
				            if (function_exists('icl_translate')) { $tabs[$i]['content'] = icl_translate('loc_kause_widgets_plugin', "$widget_id-widget[$i][content]", $tabs[$i]['content']); }
						
						?>
							<h3 class="v_nav<?php if($i === 0) { echo ' v_active'; } ?>" data-tab="<?php printf('%s-tab-%d', esc_attr($widget_id), esc_attr($i)); ?>"><?php echo $tabs[$i]['title']; ?></h3>
				 			<div id="<?php printf('%s-tab-%d', esc_attr($widget_id), esc_attr($i)); ?>" class="tab_content clearfix">
				            	<p><?php echo $tabs[$i]['content']; ?></p>   
							</div>
						<?php
						}
					
					?>

				</div>
				<!-- End Content -->

			</div>
		    <!-- End -->
    			

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



