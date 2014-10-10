<?php
	function block_sitemap_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 					= "Sitemap";
			$params['show'] 					= "latest_posts";
			$params['num_columns'] 				= 3;
			$params['num_posts'] 				= 3;
			$params['show_section_header'] 		= "checked";
			$params['show_featured_image'] 		= "checked";
			$params['link_to'] 					= "posts";
			$params['button_text'] 				= "View All";
		}

		?>

			<li class="building_block block_sitemap">

				<div class="block_header">
					<?php _e("Sitemap", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='sitemap'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Title", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
					</div>
					
				</div>
				
			</li>

		<?php	
	}
