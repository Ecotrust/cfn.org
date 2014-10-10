<?php
	function block_revslider_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['alias'])) { $params['alias'] = "homepage"; }

		?>

			<li id="block_revslider" class="building_block">

				<div class="block_header">
					<?php _e("Revolution Slider", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='revslider'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>

					<div class="option">
						<label><?php _e("Slider alias", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' id='block_alias' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][alias]' value="<?php if (isset($params['alias'])) echo htmlspecialchars($params['alias']); ?>">
					</div>
					
				</div>
				
			</li>

		<?php	
	}
