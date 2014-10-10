<?php
	function block_html_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['add_outer_wrappers'] 					= "checked";
		}

		?>

			<li class="building_block block_html">

				<div class="block_header">
					<?php _e("Custom HTML + CSS", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='html'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXTAREA -->
					<div class="option">
						<label><?php _e("HTML", "loc_kause_core_plugin"); ?></label>
						<textarea 
							class='block_option' 
							rows = '10'
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][html]'
						><?php if (isset($params['html'])) echo $params['html']; ?></textarea>
					</div>
					
				<!-- TEXTAREA -->
					<div class="option">
						<label><?php _e("CSS", "loc_kause_core_plugin"); ?></label>
						<span class="detail">&lt;style&gt;</span>
						<textarea 
							class='block_option' 
							rows = '10'
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][css]'
						><?php if (isset($params['css'])) echo $params['css']; ?></textarea>
						<span class="detail">&lt;/style&gt;</span>
					</div>
					
				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][add_outer_wrappers]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][add_outer_wrappers]" class="checkbox" value="checked" <?php if (isset($params['add_outer_wrappers'])) { checked($params['add_outer_wrappers'] == "checked"); } ?>/> 
						<?php _e("Add outer wrappers", "loc_kause_core_plugin"); ?>
					</div>


				</div>
				
			</li>

		<?php	
	}
