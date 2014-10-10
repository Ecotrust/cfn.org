<?php
	function block_content_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;


		?>

			<li id="block_content" class="building_block">

				<div class="block_header">
					<?php _e("Page Content", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='content'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params)) {echo $params['status'];} else {echo "open";} ?>'>

					<div class="option">
						<span class="detail"><?php _e("Displays the content of your page. Make sure the page using this pagebuilder template has content.", "loc_kause_core_plugin"); ?></span>
					</div>

				</div>
			</li>

		<?php	
	}
