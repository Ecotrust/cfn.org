<?php
	function block_sermon_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 						= "Sermon";
			$params['sermon_by'] 					= "";
			$params['sermon_by_link'] 				= "";
			$params['meta_info'] 					= "";
			$params['img_url'] 						= "";
			$params['video_link'] 					= "http://player.vimeo.com/video/22428395";
			$params['audio_link'] 					= "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/48574136";
			$params['text_link'] 					= "";
			$params['description'] 					= "";
			$params['read_more_link']				= "";
		}

		?>

			<li class="building_block block_sermon">

				<div class="block_header">
					<?php _e("Sermon", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='sermon'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Title", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Sermon by", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][sermon_by]' value="<?php if (isset($params['sermon_by'])) echo htmlspecialchars($params['sermon_by']); ?>">
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Sermon by link", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][sermon_by_link]' value="<?php if (isset($params['sermon_by_link'])) echo htmlspecialchars($params['sermon_by_link']); ?>">
					</div>
					

				<!-- TEXT INPUT -->
					<div class="option">
						<p><strong><?php _e("Meta info", "loc_kause_core_plugin"); ?></strong> <i>(<?php _e("e.g. location, time, bible passage etc.", "loc_kause_core_plugin"); ?>)</i></p>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][meta_info]' value="<?php if (isset($params['meta_info'])) echo htmlspecialchars($params['meta_info']); ?>">
					</div>
					
				<!-- UPLOAD -->
					<div class="option">
						<label><?php _e("Image", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][img_url]' class='url' value='<?php if (isset($params['img_url'])) echo $params['img_url']; ?>'>
						<input type="button" id="upload_img_url_btn" class="upload button upload_button" value="<?php _e("Select image", "loc_kause_core_plugin"); ?>" />
					</div>

				<!-- UPLOAD -->
					<div class="option">
						<p><strong><?php _e("Video Link", "loc_kause_core_plugin"); ?></strong> <i>(<?php _e("supply external video link or choose video from media library", "loc_kause_core_plugin"); ?>)</i></p>
						<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][video_link]' class='url' value='<?php if (isset($params['video_link'])) echo $params['video_link']; ?>'>
						<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Media library", "loc_kause_core_plugin"); ?>" /> 
					</div>
					
				<!-- UPLOAD -->
					<div class="option">
						<p><strong><?php _e("Audio Link", "loc_kause_core_plugin"); ?></strong> <i>(<?php _e("supply external audio link or choose audio from media library", "loc_kause_core_plugin"); ?>)</i></p>
						<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][audio_link]' class='url' value='<?php if (isset($params['audio_link'])) echo $params['audio_link']; ?>'>
						<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Media library", "loc_kause_core_plugin"); ?>" />
					</div>
					
				<!-- UPLOAD -->
					<div class="option">
						<p><strong><?php _e("Text Link", "loc_kause_core_plugin"); ?></strong> <i>(<?php _e("supply external text link or choose text file from media library", "loc_kause_core_plugin"); ?>)</i></p>
						<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][text_link]' class='url' value='<?php if (isset($params['text_link'])) echo $params['text_link']; ?>'>
						<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Media library", "loc_kause_core_plugin"); ?>" />
					</div>
					
				<!-- TEXTAREA -->
					<div class="option">
						<label><?php _e("Sermon description", "loc_kause_core_plugin"); ?></label>
						<textarea 
							class='block_option' 
							rows = '4'
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][description]'
						><?php if (isset($params['description'])) echo $params['description']; ?></textarea>
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Read more link", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][read_more_link]' value="<?php if (isset($params['read_more_link'])) echo htmlspecialchars($params['read_more_link']); ?>">
					</div>
					
				


				</div>
				
			</li>

		<?php	
	}
