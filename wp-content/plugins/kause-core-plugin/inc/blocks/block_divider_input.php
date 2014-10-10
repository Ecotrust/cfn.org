<?php
	function block_divider_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['divider_text'] 			= "Divide and conquer!";
			$params['divider_type'] 			= "text_bar";
		}

		?>

			<li class="building_block block_divider">

				<div class="block_header">
					<?php _e("Divider", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='divider'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>

				<!-- DYNAMIC SELECT -->
					<div class="option">
						<label><?php _e("Type", "loc_kause_core_plugin"); ?></label>
						<select id="divider_type" class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][divider_type]"> 
			     			<option value="hr" <?php if (isset($params['divider_type'])) {if ($params['divider_type'] == "hr") echo "selected='selected'";} ?>><?php _e("Horizontal ruler", "loc_kause_core_plugin"); ?></option> 
			     			<option value="text_bar" <?php if (isset($params['divider_type'])) {if ($params['divider_type'] == "text_bar") echo "selected='selected'";} ?>><?php _e("Text bar", "loc_kause_core_plugin"); ?></option> 
						</select> 
					</div>
					
				<!-- TEXT BAR SPECIFIC OPTION: TEXT INPUT -->

					<div class="pb_dynamic_option" data-listen_to="#divider_type" data-listen_for="text_bar" data-same_level_parent_container=".option">

						<div class="option">
							<label><?php _e("Divider text", "loc_kause_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][divider_text]' value="<?php if (isset($params['divider_text'])) echo htmlspecialchars($params['divider_text']); ?>">
						</div>

					</div>
					
				</div>
				
			</li>

		<?php	
	}
