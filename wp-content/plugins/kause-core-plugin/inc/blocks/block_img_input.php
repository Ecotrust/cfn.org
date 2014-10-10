<?php
	function block_img_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;


		?>

		<li class="building_block block_img">

			<div class="block_header">
				<?php _e("Image", "loc_kause_core_plugin"); ?>
				<span class="block-edit"></span>
			</div>

			<div class="block_options">

				<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='img'>
				<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params)) {echo $params['status'];} else {echo "open";} ?>'>
				
				<!-- UPLOAD -->
					<div class="option">
						<label><?php _e("Image", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][img_url]' class='url' value='<?php if (isset($params['img_url'])) echo $params['img_url']; ?>'>
						<input type="button" id="upload_img_url_btn" class="upload button upload_button" value="<?php _e("Select image", "loc_kause_core_plugin"); ?>" />
					</div>
					
				<!-- SELECT -->
					<div class="option">
						<label><?php _e("Layout", "loc_kause_core_plugin"); ?></label>
						<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][layout]"> 
			     			<option value="full_width_fit" <?php if (isset($params['layout'])) {if ($params['layout'] == "full_width_fit") echo "selected='selected'";} ?>><?php _e("Full width fit", "loc_kause_core_plugin"); ?></option> 
			     			<option value="boxed_fit" <?php if (isset($params['layout'])) {if ($params['layout'] == "boxed_fit") echo "selected='selected'";} ?>><?php _e("Boxed fit", "loc_kause_core_plugin"); ?></option> 
			     			<option value="boxed" <?php if (isset($params['layout'])) {if ($params['layout'] == "boxed") echo "selected='selected'";} ?>><?php _e("Boxed left align", "loc_kause_core_plugin"); ?></option> 
			     			<option value="boxed_center" <?php if (isset($params['layout'])) {if ($params['layout'] == "boxed_center") echo "selected='selected'";} ?>><?php _e("Boxed center align", "loc_kause_core_plugin"); ?></option> 
			     			<option value="boxed_right" <?php if (isset($params['layout'])) {if ($params['layout'] == "boxed_right") echo "selected='selected'";} ?>><?php _e("Boxed right align", "loc_kause_core_plugin"); ?></option> 
						</select> 
					</div>
					

			</div>
			<!-- END BLOCK_OPTIONS -->
		</li>

		<?php	
	}
