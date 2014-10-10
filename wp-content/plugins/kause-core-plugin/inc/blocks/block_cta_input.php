<?php
	function block_cta_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['text'] 					= 'Purchase this theme today, no sign up or credit card needed, <a href="">Get it now</a>';
			$params['bg_color'] 				= "#f5f5f5";
			$params['text_color'] 				= "#2f353f";
			$params['link_color'] 				= "#ff6666";
		}

		?>

			<li class="building_block block_cta<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Call to Action Box", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='cta'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXTAREA -->
					<div class="option">
						<label><?php _e("Text", "loc_kause_core_plugin"); ?></label>
						<textarea 
							class='block_option' 
							rows = '4'
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][text]'
						><?php if (isset($params['text'])) echo $params['text']; ?></textarea>
						<span class="detail">Enter text / HTML</span>
					</div>
					
				<!-- COLORPICKER -->
					<div class="option">
						<label><?php _e("Background Color", "loc_kause_core_plugin"); ?></label>
						<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['bg_color']; ?>"></div></div>
						<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][bg_color]" value="<?php if (isset($params['bg_color'])) echo $params['bg_color']; ?>" />    
					</div>

				<!-- COLORPICKER -->
					<div class="option">
						<label><?php _e("Text Color", "loc_kause_core_plugin"); ?></label>
						<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['text_color']; ?>"></div></div>
						<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][text_color]" value="<?php if (isset($params['text_color'])) echo $params['text_color']; ?>" />    
					</div>

				<!-- COLORPICKER -->
					<div class="option">
						<label><?php _e("Link Color", "loc_kause_core_plugin"); ?></label>
						<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['link_color']; ?>"></div></div>
						<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][link_color]" value="<?php if (isset($params['link_color'])) echo $params['link_color']; ?>" />    
					</div>




				</div>
				
			</li>

		<?php	
	}
