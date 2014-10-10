<?php
	function block_featured_posts_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['title'] 					= "Our Projects";
			$params['show'] 					= "latest_posts";
			$params['num_columns'] 				= 3;
			$params['num_posts'] 				= 3;
			$params['show_section_header'] 		= "checked";
			$params['show_featured_image'] 		= "checked";
			$params['show_title'] 				= "checked";
			$params['show_excerpt'] 			= "checked";
			$params['show_more_link'] 			= "checked";
			$params['show_date'] 				= "checked";
			$params['link_to'] 					= "posts";
			$params['button_text'] 				= "View All";
		}

		?>

			<li id="block_featured_posts" class="building_block">

				<div class="block_header">
					<?php _e("Featured Posts", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='featured_posts'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXT INPUT -->
					<div class="option">
						<label>Title</label>
						<input class='block_option' type='text' id='block_title' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
					</div>
					

				<!-- DYNAMIC SELECT -->
					<?php 

						$cat_list = get_categories(array(
							'hide_empty' => 0
						));
						$cat_list = array_values($cat_list);

					 ?>
					<div class="option">
						<label>Show</label>
						<select class='block_option' id="show" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show]"> 
			     			<option value="latest_posts" <?php if (isset($params['show'])) {if ($params['show'] == "latest_posts") echo "selected='selected'";} ?>><?php _e("Latest posts", "loc_kause_core_plugin"); ?></option> 
			     			<option value="random_posts" <?php if (isset($params['show'])) {if ($params['show'] == "random_posts") echo "selected='selected'";} ?>><?php _e("Random posts", "loc_kause_core_plugin"); ?></option> 
			     			<option value="latest_posts"></option> 

			     			<option value="popular_views" <?php if (isset($params['show'])) {if ($params['show'] == "popular_views") echo "selected='selected'";} ?>><?php _e("Popular posts by views", "loc_kause_core_plugin"); ?>	</option> 
		 					<option value="popular_comments" <?php if (isset($params['show'])) {if ($params['show'] == "popular_comments") echo "selected='selected'";} ?>><?php _e("Popular posts by comments", "loc_kause_core_plugin"); ?>	</option> 
			     			<option value="latest_posts"></option> 

						<?php 
							for ($i = 0; $i < count($cat_list); $i++) { 
							?>
			     				<option value="postcat_<?php echo $cat_list[$i]->slug; ?>" <?php if (isset($params['show'])) {if ($params['show'] == "postcat_" . $cat_list[$i]->slug) echo "selected='selected'";} ?>><?php echo $cat_list[$i]->name; ?> category</option> 
							<?php
							}
						?>
						</select> 
					</div>
					
					

				<!-- NUMBER -->
					<div class="option">
						<input 
							type='number' 
							class='block_option'
							id='num_columns' 
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][num_columns]' 
							min='2'
							max='5'
							step='1'
							style='width: 45px;'
							value='<?php if (isset($params['num_columns'])) echo esc_attr($params['num_columns']); ?>'
						><?php _e("Number of columns", "loc_kause_core_plugin"); ?>
					</div>

					

				<!-- NUMBER -->
					<div class="option">
						<input 
							type='number' 
							class='block_option'
							id='num_posts' 
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][num_posts]' 
							min='1'
							max='100'
							step='1'
							style='width: 45px;'
							value='<?php if (isset($params['num_posts'])) echo esc_attr($params['num_posts']); ?>'
						><?php _e("Number of posts to show", "loc_kause_core_plugin"); ?>
					</div>


				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_section_header]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_section_header]" class="checkbox" value="checked" <?php if (isset($params['show_section_header'])) { checked($params['show_section_header'] == "checked"); } ?>/> 
						<?php _e("Show section header", "loc_kause_core_plugin"); ?>
					</div>

				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_featured_image]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_featured_image]" class="checkbox" value="checked" <?php if (isset($params['show_featured_image'])) { checked($params['show_featured_image'] == "checked"); } ?>/> 
						<?php _e("Show featured image", "loc_kause_core_plugin"); ?>
					</div>

				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_date]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_date]" class="checkbox" value="checked" <?php if (isset($params['show_date'])) { checked($params['show_date'] == "checked"); } ?>/> 
						<?php _e("Show publish date", "loc_kause_core_plugin"); ?>
					</div>

				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_title]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_title]" class="checkbox" value="checked" <?php if (isset($params['show_title'])) { checked($params['show_title'] == "checked"); } ?>/> 
						<?php _e("Show title", "loc_kause_core_plugin"); ?>
					</div>

				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_excerpt]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_excerpt]" class="checkbox" value="checked" <?php if (isset($params['show_excerpt'])) { checked($params['show_excerpt'] == "checked"); } ?>/> 
						<?php _e("Show excerpt", "loc_kause_core_plugin"); ?>
					</div>

				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_more_link]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show_more_link]" class="checkbox" value="checked" <?php if (isset($params['show_more_link'])) { checked($params['show_more_link'] == "checked"); } ?>/> 
						<?php _e("Show more link", "loc_kause_core_plugin"); ?>
					</div>


				<!-- DYNAMIC SELECT -->
					<div class="option">
						<label><?php _e("Featured images link to", "loc_kause_core_plugin"); ?></label>
						<select class='block_option' id="link_to" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][link_to]"> 
			     			<option value="post" <?php if (isset($params['link_to'])) {if ($params['link_to'] == "post") echo "selected='selected'";} ?>>Posts</option> 
			     			<option value="lightbox" <?php if (isset($params['link_to'])) {if ($params['link_to'] == "lightbox") echo "selected='selected'";} ?>>Lightbox</option> 
						</select> 
					</div>
					

				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Button text", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' id='button_text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][button_text]' value="<?php if (isset($params['button_text'])) echo htmlspecialchars($params['button_text']); ?>">
					</div>
					
				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Button link", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' id='button_link' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][button_link]' value="<?php if (isset($params['button_link'])) echo htmlspecialchars($params['button_link']); ?>">
					</div>
					

				</div>
				
			</li>

		<?php	
	}
