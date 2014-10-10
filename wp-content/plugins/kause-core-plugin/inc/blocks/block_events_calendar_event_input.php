<?php
	function block_events_calendar_event_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 					= "Our Projects";
			$params['show'] 					= "latest_posts";
			$params['num_columns'] 				= 3;
			$params['num_posts'] 				= 3;
			$params['show_section_header'] 		= "checked";
			$params['show_featured_image'] 		= "checked";
			$params['link_to'] 					= "posts";
			$params['button_text'] 				= "View All";
		}

		?>

			<li class="building_block block_events_calendar_event">

				<div class="block_header">
					<?php _e("Single Event", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='events_calendar_event'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>

					<?php 
						// DETECT PLUGIN
						if (!class_exists('TribeEvents')) {
							echo '<div class="option">';
							_e("<i><strong>WARNING:</strong> This block requires <strong>The Events Calendar</strong> plugin. The required plugin could not be found. Please go to plugins and install/activate the required plugin!</i>", "loc_canon");
							echo '</div>';
						} else  {
						?>

						<!-- DYNAMIC SELECT -->
							<?php 

								$events = tribe_get_events(array(
									'eventDisplay'		=> 'all',
									'orderby'			=> 'post_date',
									'order'				=> 'DESC',
								));

							 ?>
							<div class="option">
								<label><?php _e("Select event", "loc_kause_core_plugin"); ?></label>
								<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][event_ID]"> 

								<?php 

									if (count($events) === 0) {
										echo "<option value=''>No events found</option>";
											
									} else {
										for ($i = 0; $i < count($events); $i++) { 
										?>
						     				<option value="<?php echo $events[$i]->ID; ?>" <?php if (isset($params['event_ID'])) {if ($params['event_ID'] == $events[$i]->ID) echo "selected='selected'";} ?>><?php printf('%s (%s)', esc_attr($events[$i]->post_title), esc_attr(tribe_get_start_date($events[$i]->ID))); ?></option> 
										<?php
										}
											
									}
								?>
								</select> 
							</div>

							
						<?php
						}
					?>
					
				</div>
				
			</li>

		<?php	
	}
