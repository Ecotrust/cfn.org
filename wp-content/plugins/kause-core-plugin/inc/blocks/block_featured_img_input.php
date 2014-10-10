<?php
	function block_featured_img_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;


		?>

		<li class="building_block block_featured_img">

			<div class="block_header">
				<?php _e("Featured Image", "loc_kause_core_plugin"); ?>
				<span class="block-edit"></span>
			</div>

			<div class="block_options">

				<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='featured_img'>
				<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params)) {echo $params['status'];} else {echo "open";} ?>'>
				
				<div class="option">
					<span class="detail"><?php _e("Displays the featured image of your page. Make sure the page using this pagebuilder template has a featured image.", "loc_kause_core_plugin"); ?></span>
				</div>

			</div>
			<!-- END BLOCK_OPTIONS -->
		</li>

		<?php	
	}
