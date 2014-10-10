<?php
	function block_featured_video_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['bg_color'])) { $params['bg_color'] = '#344158'; }
		if (!isset($params['before_video'])) { $params['before_video'] = "<h4>Annually, <span>500 billion Plastic Bags</span> are used worldwide. </h4>"; }
		if (!isset($params['embed_code'])) { $params['embed_code'] = '<iframe src="http://player.vimeo.com/video/15188552?title=0&amp;byline=0&amp;portrait=0&amp;color=ff6666" width="640" height="360"></iframe>'; }
		if (!isset($params['after_video'])) { $params['after_video'] = "<h5>See how this is impacting our oceans.</h5>"; }
		if (!isset($params['use_parallax'])) { $params['use_parallax'] = "checked"; }
		if (!isset($params['parallax_ratio'])) { $params['parallax_ratio'] = 0.5; }

		?>

			<li id="block_featured_video" class="building_block">

				<div class="block_header">
					<?php _e("Featured Video", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='featured_video'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>

					<div class="option">
						<label><?php _e("Background Image", "loc_kause_core_plugin"); ?></label>
						<input class='block_option upload_text' type='text' id='block_bg_image' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][bg_img]' value='<?php if (isset($params['bg_img'])) echo $params['bg_img']; ?>'>
						<input class='upload_button' type="button" id="upload_bg_img_button" value="Select Background Image" />
					</div>

					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][use_parallax]" value="unchecked" />
						<input class='block_option' type="checkbox" id="show_header_banner" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][use_parallax]" class="checkbox" value="checked" <?php if (isset($params['use_parallax'])) { checked($params['use_parallax'] == "checked"); } ?>/> 
						<?php _e("Use parallax scrolling for background image", "loc_kause_core_plugin"); ?>
					</div>

					<div class="option">
						<input 
							type='number' 
							class='block_option'
							id='num_columns' 
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][parallax_ratio]' 
							min='0'
							max='2'
							step='0.1'
							style='width: 45px;'
							value='<?php if (isset($params['parallax_ratio'])) echo esc_attr($params['parallax_ratio']); ?>'
						><?php _e("Parallax ratio", "loc_kause_core_plugin"); ?>
					</div>

					<div class="option">
						<label><?php _e("Background Color", "loc_kause_core_plugin"); ?></label>
						<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['bg_color']; ?>"></div></div>
						<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][bg_color]" value="<?php if (isset($params['bg_color'])) echo $params['bg_color']; ?>" />    
					</div>


					<div class="option">
						<label>Before video</label>
						<textarea 
							class='block_option services' 
							id='block_before_video' 
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][before_video]'
						><?php if (isset($params['before_video'])) echo $params['before_video']; ?></textarea>
						<span class="detail">Text / HTML</span>
					</div>

					<div class="option">
						<label>Embeddable media code</label>
						<input class='block_option' type='text' id='block_embed_code' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][embed_code]' value="<?php if (isset($params['embed_code'])) echo htmlspecialchars($params['embed_code']); ?>">
					</div>

					<div class="option">
						<label>After video</label>
						<textarea 
							class='block_option services' 
							id='block_after_video' 
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][after_video]'
						><?php if (isset($params['after_video'])) echo $params['after_video']; ?></textarea>
						<span class="detail">Text / HTML</span>
					</div>

					
				</div>
				
			</li>

		<?php	
	}
