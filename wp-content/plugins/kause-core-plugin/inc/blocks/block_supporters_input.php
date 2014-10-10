<?php
	function block_supporters_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['banner_text'] 				= "Over $125000 raised, We love Our supporters";
			$params['img']						= array();
			$params['repeat']					= "checked";
			$params['btn_1_text']				= "Donate Now";
			$params['btn_2_text']				= "Fundraise";
		}


		//remove template and do array_values
		unset($params['img']['image_index']);
		$params['img'] = array_values($params['img']);

		?>

			<li class="building_block block_supporters<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Supporters", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='supporters'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Banner text", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][banner_text]' value="<?php if (isset($params['banner_text'])) echo htmlspecialchars($params['banner_text']); ?>">
					</div>
					
					
				<!-- SPECIAL INPUT -->
					<div class="option supporters">
						<ul class="supporter_template">

							<li>
								<input class='block_option' type="hidden" name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][img][image_index]' value=''>
								<img width="77" height="77" src="">
							</li>

						</ul>
						<ul class="supporter_images">

							<?php 

								for ($i = 0; $i < count($params['img']); $i++) {  
									if (isset($params['img'][$i])) {
										?>
											<li>
												<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][img][<?php echo $i; ?>]' value='<?php echo $params['img'][$i]; ?>'>
												<img width="77" height="77" src="<?php echo $params['img'][$i]; ?>">
											</li>
											
										<?php
									}
								}
										
							?>

						</ul>

						<div class="supporter_controls">
							<input type="button" class="button button_upload_supporter_image" value="<?php _e("Upload supporter image", "loc_kause_core_plugin"); ?>" />
							<input type="button" class="button button_remove_supporter_image" value="<?php _e("Remove supporter image", "loc_kause_core_plugin"); ?>" />
						</div>
					</div>


				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][repeat]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][repeat]" class="checkbox" value="checked" <?php if (isset($params['repeat'])) { checked($params['repeat'] == "checked"); } ?>/> 
						<?php _e("Repeat images to fill screen", "loc_kause_core_plugin"); ?>
					</div>

				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Button 1 text", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][btn_1_text]' value="<?php if (isset($params['btn_1_text'])) echo htmlspecialchars($params['btn_1_text']); ?>">
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Button 1 link", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][btn_1_link]' value="<?php if (isset($params['btn_1_link'])) echo htmlspecialchars($params['btn_1_link']); ?>">
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Button 2 text", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][btn_2_text]' value="<?php if (isset($params['btn_2_text'])) echo htmlspecialchars($params['btn_2_text']); ?>">
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Button 2 link", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][btn_2_link]' value="<?php if (isset($params['btn_2_link'])) echo htmlspecialchars($params['btn_2_link']); ?>">
					</div>
					
				<!-- TEXTAREA -->
					<div class="option">
						<label><?php _e("HTML", "loc_kause_core_plugin"); ?></label>
						<textarea 
							class='block_option' 
							rows = '10'
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][html]'
						><?php if (isset($params['html'])) echo $params['html']; ?></textarea>
					</div>

				</div>
				
			</li>

		<?php	
	}
