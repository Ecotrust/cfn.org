<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_canon_posts');
	add_action ('save_post', 'update_cmb_canon_posts');

	function register_cmb_canon_posts () {
		add_meta_box('cmb_canon_posts','Kause Post Settings', 'display_cmb_canon_posts','post');
	}

	function display_cmb_canon_posts ($post) {

	/**************************************
	GET VALUES
	***************************************/

	// OPTIONS
		$default_excerpt_len = 300;
	    $canon_options_post = get_option('canon_options_post'); 

	//SET DEFAULT
	    if (!isset($canon_options_post['post_slider'])) { $canon_options_post['post_slider'] = "automatic"; }


	// GENERAL

		$cmb_single_style = get_post_meta($post->ID, 'cmb_single_style', true);
		$cmb_feature = get_post_meta($post->ID, 'cmb_feature', true);
		$cmb_media_link = get_post_meta($post->ID, 'cmb_media_link', true);
		$cmb_excerpt = get_post_meta($post->ID, 'cmb_excerpt', true);
		$cmb_quote_is_tweet = get_post_meta($post->ID, 'cmb_quote_is_tweet', true);
		$cmb_byline = get_post_meta($post->ID, 'cmb_byline', true);
		$cmb_multi_intro = get_post_meta($post->ID, 'cmb_multi_intro', true);
		$cmb_hide_from_archive = get_post_meta($post->ID, 'cmb_hide_from_archive', true);
		$cmb_hide_from_gallery = get_post_meta($post->ID, 'cmb_hide_from_gallery', true);
		$cmb_hide_from_popular = get_post_meta($post->ID, 'cmb_hide_from_popular', true);
		$cmb_hide_feat_img = get_post_meta($post->ID, 'cmb_hide_feat_img', true);
		$cmb_hide_from_post_slider = get_post_meta($post->ID, 'cmb_hide_from_post_slider', true);

		$cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);

	    //GET POST ATTACHMENTS
	    $args = array(
	        'post_type' => 'attachment',
	        'numberposts' => -1,
	        'post_status' => null,
	        'orderby' => 'title',
	        'order'  => 'ASC',
	        'post_parent' => $post->ID
	    );

	    $post_attachments = get_posts( $args );

		//defaults
		if (empty($cmb_exist)) {

			update_post_meta($post->ID, 'cmb_quote_is_tweet', 'unchecked');
			update_post_meta($post->ID, 'cmb_single_style', 'full');
			update_post_meta($post->ID, 'cmb_feature', 'image');

			update_post_meta($post->ID, 'cmb_hide_from_archive', 'unchecked');
			update_post_meta($post->ID, 'cmb_hide_from_gallery', 'unchecked');
			update_post_meta($post->ID, 'cmb_hide_from_popular', 'unchecked');

		}

	/**************************************
	DISPLAY CONTENT
	***************************************/
		?>

	<!-- GENERAL -->

		<div class="option_heading">
			<span>General</span>
		</div>

		<!-- specific post format options: quote -->
		<div class="options_post_format default_hidden" data-post_format="quote">
			
			<?php
				
				fw_cmb_option(array(
					'type'					=> 'checkbox',
					'title' 				=> __('Display quote as a tweet', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_quote_is_tweet',
					'post_id'				=> $post->ID,
				)); 
							
				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Quote byline', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_byline',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 
							
			?>

		</div>


		<?php
			
			fw_cmb_option(array(
				'type'					=> 'select',
				'title' 				=> __('Post style', 'loc_kause_core_plugin'),
				'slug' 					=> 'cmb_single_style',
				'select_options'		=> array(
					'full'				=> __('Featured full width (standard)', 'loc_kause_core_plugin'),
					'boxed'				=> __('Featured boxed', 'loc_kause_core_plugin'),
					'compact'			=> __('Featured compact', 'loc_kause_core_plugin'),
					'project'			=> __('Project post', 'loc_kause_core_plugin'),
					'multi'				=> __('Multi post', 'loc_kause_core_plugin'),
				),
				'post_id'				=> $post->ID,
			)); 

		?>

	<!-- MULTI POST SPECIFIC -->

		<div class="dynamic_option default_hidden" data-listen_to="#cmb_single_style" data-listen_for="multi">

			<?php
				
				fw_cmb_option(array(
					'type'					=> 'textarea',
					'title' 				=> __('Multi post intro', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_multi_intro',
					'cols'					=> '100',
					'rows'					=> '5',
					'class'					=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

			?>

		</div>

	<!-- NON SPECIFIC -->

		<?php
						
			fw_cmb_option(array(
				'type'					=> 'select',
				'title' 				=> __('Feature style', 'loc_kause_core_plugin'),
				'slug' 					=> 'cmb_feature',
				'select_options'		=> array(
					'image'				=> __('Featured image', 'loc_kause_core_plugin'),
					'media'				=> __('Use embeddable media instead of featured image', 'loc_kause_core_plugin'),
					'media_in_lightbox'	=> __('Use featured image but open media link in lightbox', 'loc_kause_core_plugin'),
				),
				'post_id'				=> $post->ID,
			)); 
						
			fw_cmb_option(array(
				'type'					=> 'text',
				'title' 				=> __('Featured media - <i>(optional)</i>', 'loc_kause_core_plugin'),
				'slug' 					=> 'cmb_media_link',
				'class' 				=> 'widefat',
				'post_id'				=> $post->ID,
			)); 


		?>


		<div class="option_item">
			<label for='cmb_excerpt'><?php _e("Excerpt / Quote", "loc_kause_core_plugin"); ?></label><br>
			<textarea id='cmb_excerpt' name='cmb_excerpt' class='widefat' rows='5'><?php if (!empty($cmb_excerpt)) echo $cmb_excerpt; ?></textarea>
			<button type="button" name="button_generate_excerpt" id='button_generate_excerpt' class="button-secondary auto_generate" value="<?php echo mb_make_excerpt($post->post_content, $default_excerpt_len, true); ?>">Auto-generate</button>
			<span class="item_hint float_right"><?php _e("HTML allowed", "loc_kause_core_plugin"); ?></span>
		</div>

		<?php
			
			fw_cmb_option(array(
				'type'					=> 'checkbox_multiple',
				'title' 				=> __('Display quote as a tweet', 'loc_kause_core_plugin'),
				'slug' 					=> 'cmb_quote_is_tweet',
				'checkboxes'			=> array(
					'cmb_hide_from_archive'		=> __('Hide from blog', 'loc_kause_core_plugin'),
					'cmb_hide_from_gallery'		=> __('Hide from gallery', 'loc_kause_core_plugin'),
					'cmb_hide_from_popular'		=> __('Hide from popular lists', 'loc_kause_core_plugin'),
				),

				'post_id'				=> $post->ID,
			)); 

		?>

		<?php
			
			if (has_post_thumbnail($post->ID)) {
			?>
				<div class="option_item">
					<input type="hidden" name="cmb_hide_feat_img" value="unchecked" />
					<input type='checkbox' id='cmb_hide_feat_img' name='cmb_hide_feat_img' value='checked' <?php checked($cmb_hide_feat_img == "checked"); ?>>
					<label for='cmb_hide_feat_img'><?php _e("Hide featured image", "loc_kause_core_plugin"); ?></label>
				</div>
					
			<?php
			}
		
		?>	

	<!-- POST SLIDER -->

		<div class="option_heading">
			<span>Post slider</span>
		</div>

		<?php 
			if (count($post_attachments) < 1) {
			?>				
				<div class="option_item">
					<i><?php _e("No images have been attached to your post", "loc_kause_core_plugin"); ?></i>
				</div>
			<?php
			} else {
			?>

				<div class="option_item">

					<?php
						
						if ($canon_options_post['post_slider'] == "automatic") {
							_e("Post slider is set to <strong>Automatic</strong> - images attached to this post will automatically be added to the post slider.", "loc_kause_core_plugin");
							echo "<br><br>";	
							_e("Select images to hide from the post slider:", "loc_kause_core_plugin");
						} elseif ($canon_options_post['post_slider'] == "manual") {
							_e("Post slider is set to <strong>Manual</strong> - images have to be manually added to the post slider.", "loc_kause_core_plugin");
							echo "<br><br>";	
							_e("Select images to add to the post slider:", "loc_kause_core_plugin");
						} elseif ($canon_options_post['post_slider'] == "off") {
							_e("Post slider is set to <strong>Off</strong>", "loc_kause_core_plugin");
						}
					
					?>

					<br><br>

					<?php 

						if ($canon_options_post['post_slider'] != "off") {
							for ($i = 0; $i < count($post_attachments); $i++) {  
								if (get_post_thumbnail_id($post->ID) != $post_attachments[$i]->ID) {
								?>
									<input type="hidden" name="cmb_hide_from_post_slider[<?php echo $post_attachments[$i]->ID; ?>]" value="unchecked" />
									<input type='checkbox' id='cmb_hide_from_post_slider' name='cmb_hide_from_post_slider[<?php echo $post_attachments[$i]->ID; ?>]' value='checked' <?php if (isset($cmb_hide_from_post_slider[$post_attachments[$i]->ID])) { checked($cmb_hide_from_post_slider[$post_attachments[$i]->ID] == "checked"); } ?>>
									<label for='cmb_hide_from_post_slider'><?php echo $post_attachments[$i]->post_title; ?></label><br>

								<?php
								}
							}
						}


					?>

				</div>

			<?php
			}


		?>





		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />






		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_canon_posts ($post_id) {
		// avoid activation on irrelevant admin pages
		if (!isset($_POST['cmb_nonce'])) {
			return false;		
		}

		// verify nonce.    
		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__)) || !isset($_POST['cmb_nonce'])) {
			return false;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		} else {

		//GENERAL
			if (isset($_POST['cmb_single_style'])) { update_post_meta($post_id, 'cmb_single_style', $_POST['cmb_single_style']); } else { update_post_meta($post_id, 'cmb_single_style', null); };
			if (isset($_POST['cmb_feature'])) { update_post_meta($post_id, 'cmb_feature', $_POST['cmb_feature']); } else { update_post_meta($post_id, 'cmb_feature', null); };
			if (isset($_POST['cmb_media_link'])) { update_post_meta($post_id, 'cmb_media_link', $_POST['cmb_media_link']); } else { update_post_meta($post_id, 'cmb_media_link', null); };
			if (isset($_POST['cmb_excerpt'])) { update_post_meta($post_id, 'cmb_excerpt', $_POST['cmb_excerpt']); } else { update_post_meta($post_id, 'cmb_excerpt', null); };
			if (isset($_POST['cmb_quote_is_tweet'])) { update_post_meta($post_id, 'cmb_quote_is_tweet', $_POST['cmb_quote_is_tweet']); } else { update_post_meta($post_id, 'cmb_quote_is_tweet', null); };
			if (isset($_POST['cmb_byline'])) { update_post_meta($post_id, 'cmb_byline', $_POST['cmb_byline']); } else { update_post_meta($post_id, 'cmb_byline', null); };
			if (isset($_POST['cmb_multi_intro'])) { update_post_meta($post_id, 'cmb_multi_intro', $_POST['cmb_multi_intro']); } else { update_post_meta($post_id, 'cmb_multi_intro', null); };
			if (isset($_POST['cmb_hide_from_archive'])) { update_post_meta($post_id, 'cmb_hide_from_archive', $_POST['cmb_hide_from_archive']); } else { update_post_meta($post_id, 'cmb_hide_from_archive', null); };
			if (isset($_POST['cmb_hide_from_gallery'])) { update_post_meta($post_id, 'cmb_hide_from_gallery', $_POST['cmb_hide_from_gallery']); } else { update_post_meta($post_id, 'cmb_hide_from_gallery', null); };
			if (isset($_POST['cmb_hide_from_popular'])) { update_post_meta($post_id, 'cmb_hide_from_popular', $_POST['cmb_hide_from_popular']); } else { update_post_meta($post_id, 'cmb_hide_from_popular', null); };
			if (isset($_POST['cmb_hide_feat_img'])) { update_post_meta($post_id, 'cmb_hide_feat_img', $_POST['cmb_hide_feat_img']); } else { update_post_meta($post_id, 'cmb_hide_feat_img', null); };
			if (isset($_POST['cmb_hide_from_post_slider'])) { update_post_meta($post_id, 'cmb_hide_from_post_slider', $_POST['cmb_hide_from_post_slider']); } else { update_post_meta($post_id, 'cmb_hide_from_post_slider', null); };
			
			if (isset($_POST['cmb_exist'])) { update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']); } else { update_post_meta($post_id, 'cmb_exist', null); };

		}
	}


