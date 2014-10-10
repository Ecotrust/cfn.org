<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_canon_pages');
	add_action ('save_post', 'update_cmb_canon_pages');

	function register_cmb_canon_pages () {
		add_meta_box('cmb_canon_pages','Kause Page Settings', 'display_cmb_canon_pages','page','normal','high');
	}

	function display_cmb_canon_pages ($post) {

	/**************************************
	GET VALUES
	***************************************/

		//page with sidebar specific
		$cmb_page_sidebar_id = get_post_meta($post->ID, 'cmb_page_sidebar_id', true);

		//gallery specific
		$cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);
		$cmb_gallery_click = get_post_meta($post->ID, 'cmb_gallery_click', true);
		$cmb_gallery_excerpt = get_post_meta($post->ID, 'cmb_gallery_excerpt', true);
		$cmb_gallery_cat = get_post_meta($post->ID, 'cmb_gallery_cat', true);
		$cmb_gallery_client_name = get_post_meta($post->ID, 'cmb_gallery_client_name', true);
		$cmb_gallery_client_url = get_post_meta($post->ID, 'cmb_gallery_client_url', true);

		//blog specific
		$cmb_pages_blog_style = get_post_meta($post->ID, 'cmb_pages_blog_style', true);

		//contact specific
		$cmb_kause_contact = get_post_meta($post->ID, 'cmb_kause_contact', true);

		//pagebuilder specific
		$cmb_pages_template_attachment = get_post_meta($post->ID, 'cmb_pages_template_attachment', true);
		$cmb_template_id = get_post_meta($post->ID, 'cmb_template_id', true);
		//get pagebuilder templates
		$results_templates = get_posts(array(
			'numberposts'	=> -1,
			'post_type'		=> 'pb_template',
			'orderby'		=> 'post_title',
			'order'			=> 'ASC',
		));

		//timeline specific
		$cmb_timeline_cat = get_post_meta($post->ID, 'cmb_timeline_cat', true);
		$cmb_timeline_order = get_post_meta($post->ID, 'cmb_timeline_order', true);
		$cmb_timeline_link_through = get_post_meta($post->ID, 'cmb_timeline_link_through', true);
		$cmb_timeline_display_content = get_post_meta($post->ID, 'cmb_timeline_display_content', true);
		$cmb_timeline_posts_per_page = get_post_meta($post->ID, 'cmb_timeline_posts_per_page', true);

		//to be or not to be
		$cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);


		//make sure (empty) arrays are defined as arrays
		if (empty($cmb_kause_blog)) $cmb_kause_blog = array();
		if (empty($cmb_kause_contact)) $cmb_kause_contact = array();


		//defaults
		if (empty($cmb_exist)) {

			update_post_meta($post->ID, 'cmb_page_sidebar_id', 'canon_page_sidebar_widget_area');

			update_post_meta($post->ID, 'cmb_gallery_style', 'one');
			update_post_meta($post->ID, 'cmb_gallery_click', 'lightbox');

			update_post_meta($post->ID, 'cmb_kause_blog', array (
				'style'						=> 'default',
			));

			update_post_meta($post->ID, 'cmb_kause_contact', array (
				'use_embeddable_media'		=> 'checked',
				'grayscale'					=> 'checked',
				'embed_code'				=> '<iframe width="100%" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.au/maps?f=q&source=s_q&hl=en&geocode=&q=San+Diego,+CA,+United+States&aq=0&oq=san+die&sll=-25.335448,135.745076&sspn=83.735932,130.605469&ie=UTF8&hq=&hnear=San+Diego,+California,+United+States&ll=32.715329,-117.157255&spn=0.164801,0.255089&t=m&z=13&output=embed"></iframe>',
			));

			update_post_meta($post->ID, 'cmb_timeline_order', 'DESC');
			update_post_meta($post->ID, 'cmb_timeline_link_through', 'checked');
			update_post_meta($post->ID, 'cmb_timeline_display_content', 'unchecked');
			update_post_meta($post->ID, 'cmb_timeline_posts_per_page', 10);

			update_post_meta($post->ID, 'cmb_pages_template_attachment', 'none');

		}

	/**************************************
	DISPLAY CONTENT
	***************************************/

		?>

	<!-- TEMPLATE SPECIFIC: DEFAULT EMPTY -->

		<div class="option_item default_hidden option_template_specific 
						option_page-galleries
						option_page-full-width

		">
			<i><?php _e("No additional page settings available for this template type.", "loc_kause_core_plugin"); ?></i>
		</div>

		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: PAGE WITH SIDEBAR 
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page option_default">

			<?php 

				// get array of registered sidebars
				$registered_sidebars_array = array();

				foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
					array_push($registered_sidebars_array, $value);
				}


			?>

			<div class="option_item">
				<label for='cmb_page_sidebar_id'><?php _e("Select sidebar", "loc_kause_core_plugin"); ?></label><br>
				<select name="cmb_page_sidebar_id">
					<?php 
						for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
						?>
		     				<option value="<?php echo $registered_sidebars_array[$i]['id']; ?>" <?php if (isset($cmb_page_sidebar_id)) {if ($cmb_page_sidebar_id ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo  $registered_sidebars_array[$i]['name']; ?></option> 
						<?php
						}
					?>
				</select> 
			</div>

		</div>

		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: GALLERY 
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-gallery">

			<div class="option_heading">
				<span><?php _e("Gallery Settings", "loc_kause_core_plugin"); ?></span>
			</div>

			<?php
				
				fw_cmb_option(array(
					'type'					=> 'select',
					'title' 				=> __('Gallery Style', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_gallery_style',
					'select_options'		=> array(
						'one'					=> __('Gallery Style 1', 'loc_kause_core_plugin'),
						'two'					=> __('Gallery Style 2', 'loc_kause_core_plugin'),
						'three'					=> __('Gallery Style 3', 'loc_kause_core_plugin'),
					),
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'select',
					'title' 				=> __('Clicking image', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_gallery_click',
					'select_options'		=> array(
						'lightbox'				=> __('Opens lightbox', 'loc_kause_core_plugin'),
						'post'					=> __('Opens post', 'loc_kause_core_plugin'),
					),
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'textarea',
					'title' 				=> __('Excerpt', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_gallery_excerpt',
					'cols'					=> '100',
					'rows'					=> '5',
					'class'					=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Client name', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_gallery_client_name',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Client URL', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_gallery_client_url',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

			?>


			<div class="option_item">

				<label for='cmb_gallery_cat'><?php _e("Categories to be displayed in gallery", "loc_kause_core_plugin"); ?></label><br><br>

     			<?php 
     				$categories = get_categories(array(
     					'orderby' => 'name',
     					'order' => 'ASC'
     				));

					$categories = array_values($categories);

					for ($i = 0; $i < count($categories); $i++) {  
					?>
						<input type="checkbox" id="cmb_gallery_cat[<?php echo $categories[$i]->slug; ?>]" name="cmb_gallery_cat[<?php echo $categories[$i]->slug; ?>]" class="checkbox" value="checked" <?php checked(isset($cmb_gallery_cat[$categories[$i]->slug])); ?>/> 
						<?php echo $categories[$i]->name; ?><br>
					<?php
					}

     			 ?>


			</div>


		</div>

		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: BLOG 
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-blog">

			<div class="option_heading">
				<span><?php _e("Blog Settings", "loc_kause_core_plugin"); ?></span>
			</div>

			<?php
				
				fw_cmb_option(array(
					'type'					=> 'select',
					'title' 				=> __('Blog Style', 'loc_kause_core_plugin'),
					'slug' 					=> 'cmb_pages_blog_style',
					'select_options'		=> array(
						'default'				=> __('Site default', 'loc_kause_core_plugin'),
						'full'					=> __('Blog full width', 'loc_kause_core_plugin'),
						'sidebar'				=> __('Blog with sidebar', 'loc_kause_core_plugin'),
					),
					'post_id'				=> $post->ID,
				)); 

			?>


		</div>



		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: CONTACT
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-contact">

			<!-- CONTACT -->
			<div class="option_heading togglable">
				<span><?php _e("Contact", "loc_kause_core_plugin"); ?></span>
			</div>

			<div class="option_content_container">

				<?php
					
					fw_cmb_option(array(
						'type'					=> 'checkbox',
						'title' 				=> __('Use embeddable media instead of featured image', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_kause_contact[use_embeddable_media]',
						'post_id'				=> $post->ID,
					)); 
								
					fw_cmb_option(array(
						'type'					=> 'checkbox',
						'title' 				=> __('Grayscale media <i>(if available)</i>', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_kause_contact[grayscale]',
						'post_id'				=> $post->ID,
					)); 
								
					fw_cmb_option(array(
						'type'					=> 'text',
						'title' 				=> __('Embed code', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_kause_contact[embed_code]',
						'class' 				=> 'widefat',
						'post_id'				=> $post->ID,
					)); 

				?>

			</div>

		</div>


		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: TIMELINE
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-timeline">

			<!-- CONTACT -->
			<div class="option_heading togglable">
				<span><?php _e("Timeline", "loc_kause_core_plugin"); ?></span>
			</div>

			<div class="option_content_container">

     			<?php 
     				$categories = get_categories(array(
     					'orderby' => 'name',
     					'order' => 'ASC'
     				));

					$categories = array_values($categories);

     			 ?>

				<div class="option_item">
					<label for='cmb_timeline_cat'><?php _e("Timeline displays", "loc_kause_core_plugin"); ?></label><br>
					<select id="cmb_timeline_cat" name="cmb_timeline_cat"> 
			 			<option value="" <?php if (isset($cmb_timeline_cat)) {if ($cmb_timeline_cat == "") echo "selected='selected'";} ?>><?php _e("All categories", "loc_kause_core_plugin"); ?></option> 

		     			<?php 
		     				foreach ($categories as $single_category) {
		     				?>
		     					<option value="<?php echo $single_category->slug; ?>" <?php if (isset($cmb_timeline_cat)) {if ($cmb_timeline_cat == $single_category->slug) echo "selected='selected'";} ?>><?php echo $single_category->name; ?> <?php _e("category", "loc_kause_core_plugin"); ?></option> 
		     				<?php	     						
		     				}
		     			?>

					</select> 
				</div>

				<?php
					
					fw_cmb_option(array(
						'type'					=> 'select',
						'title' 				=> __('Chronology', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_timeline_order',
						'select_options'		=> array(
							'DESC'					=> __('Descending', 'loc_kause_core_plugin'),
							'ASC'					=> __('Ascending', 'loc_kause_core_plugin'),
						),
						'post_id'				=> $post->ID,
					)); 

					fw_cmb_option(array(
						'type'					=> 'checkbox',
						'title' 				=> __('Link through to posts', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_timeline_link_through',
						'post_id'				=> $post->ID,
					)); 
								
					fw_cmb_option(array(
						'type'					=> 'checkbox',
						'title' 				=> __('Display content instead of excerpts', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_timeline_display_content',
						'post_id'				=> $post->ID,
					)); 
								
					fw_cmb_option(array(
						'type'					=> 'number',
						'title' 				=> __('Posts per page', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_timeline_posts_per_page',
						'min'					=> '1',										// optional
						'max'					=> '10000',									// optional
						'step'					=> '1',										// optional
						'width_px'				=> '60',									// optional
						'post_id'				=> $post->ID,
					)); 

				?>

			</div>

		</div>



		<!-- 
		--------------------------------------------------------------------------
			CMB ELEMENT: PAGEBUILDER ATTACHMENT
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-blog">

			<div class="option_content_container">

				<div class="option_heading">
					<span><?php _e("Pagebuilder Settings", "loc_kause_core_plugin"); ?></span>
				</div>

				<?php
					
					fw_cmb_option(array(
						'type'					=> 'select',
						'title' 				=> __('Pagebuilder Attachment', 'loc_kause_core_plugin'),
						'slug' 					=> 'cmb_pages_template_attachment',
						'select_options'		=> array(
							'none'					=> __('Do not attach', 'loc_kause_core_plugin'),
							'prepend'				=> __('Prepend', 'loc_kause_core_plugin'),
							'append'				=> __('Append', 'loc_kause_core_plugin'),
						),
						'post_id'				=> $post->ID,
					)); 

				?>

			</div>

		</div>


		<!-- 
		--------------------------------------------------------------------------
			CMB ELEMENT: PAGEBUILDER TEMPLATE ID
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-pagebuilder option_page-placeholder option_page-blog">

			<div class="option_content_container">

				<div class="option_item">
					<label for='cmb_template_id'><?php _e("Pagebuilder Template", "loc_kause_core_plugin"); ?></label><br>
					<select id="cmb_template_id" name="cmb_template_id"> 
		     			<option value="" <?php if (isset($cmb_template_id)) {if ($cmb_template_id == "") echo "selected='selected'";} ?>>No template</option> 
		     			<option value="">---</option> 
		     			<?php 
		     				for ($i = 0; $i < count($results_templates); $i++) {
		     				?>  
				     			<option value="<?php echo $results_templates[$i]->ID; ?>" <?php if (isset($cmb_template_id)) {if ($cmb_template_id == $results_templates[$i]->ID) echo "selected='selected'";} ?>><?php if (empty($results_templates[$i]->post_title)) {echo '&#060; untitled template &#062;';} else {echo $results_templates[$i]->post_title;} ?></option> 
		     				<?php
		     				}

		     			?>
					</select> 
				</div>

			</div>

		</div>





		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />
		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_canon_pages ($post_id) {
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

			//make sure $_POST['cmb_gallery_cat'] is defined
			if (!isset($_POST['cmb_gallery_cat'])) { $_POST['cmb_gallery_cat'] = array(); }

			//page with sidebar specific
			if (isset($_POST['cmb_page_sidebar_id'])) { update_post_meta($post_id, 'cmb_page_sidebar_id', $_POST['cmb_page_sidebar_id']); } else { update_post_meta($post_id, 'cmb_page_sidebar_id', null); };

			//gallery specific
			if (isset($_POST['cmb_gallery_style'])) { update_post_meta($post_id, 'cmb_gallery_style', $_POST['cmb_gallery_style']); } else { update_post_meta($post_id, 'cmb_gallery_style', null); };
			if (isset($_POST['cmb_gallery_click'])) { update_post_meta($post_id, 'cmb_gallery_click', $_POST['cmb_gallery_click']); } else { update_post_meta($post_id, 'cmb_gallery_click', null); };
			if (isset($_POST['cmb_gallery_excerpt'])) { update_post_meta($post_id, 'cmb_gallery_excerpt', $_POST['cmb_gallery_excerpt']); } else { update_post_meta($post_id, 'cmb_gallery_excerpt', null); };
			if (isset($_POST['cmb_gallery_cat'])) { update_post_meta($post_id, 'cmb_gallery_cat', $_POST['cmb_gallery_cat']); } else { update_post_meta($post_id, 'cmb_gallery_cat', null); };
			if (isset($_POST['cmb_gallery_client_name'])) { update_post_meta($post_id, 'cmb_gallery_client_name', $_POST['cmb_gallery_client_name']); } else { update_post_meta($post_id, 'cmb_gallery_client_name', null); };
			if (isset($_POST['cmb_gallery_client_url'])) { update_post_meta($post_id, 'cmb_gallery_client_url', $_POST['cmb_gallery_client_url']); } else { update_post_meta($post_id, 'cmb_gallery_client_url', null); };

			//blog specific
			if (isset($_POST['cmb_pages_blog_style'])) { update_post_meta($post_id, 'cmb_pages_blog_style', $_POST['cmb_pages_blog_style']); } else { update_post_meta($post_id, 'cmb_pages_blog_style', null); };

			//contact specific
			if (isset($_POST['cmb_kause_contact'])) { update_post_meta($post_id, 'cmb_kause_contact', $_POST['cmb_kause_contact']); } else { update_post_meta($post_id, 'cmb_kause_contact', null); };

			//pagebuilder specific
			if (isset($_POST['cmb_template_id'])) { update_post_meta($post_id, 'cmb_template_id', $_POST['cmb_template_id']); } else { update_post_meta($post_id, 'cmb_template_id', null); };
			if (isset($_POST['cmb_pages_template_attachment'])) { update_post_meta($post_id, 'cmb_pages_template_attachment', $_POST['cmb_pages_template_attachment']); } else { update_post_meta($post_id, 'cmb_pages_template_attachment', null); };

			//timeline specific
			if (isset($_POST['cmb_timeline_cat'])) { update_post_meta($post_id, 'cmb_timeline_cat', $_POST['cmb_timeline_cat']); } else { update_post_meta($post_id, 'cmb_timeline_cat', null); };
			if (isset($_POST['cmb_timeline_order'])) { update_post_meta($post_id, 'cmb_timeline_order', $_POST['cmb_timeline_order']); } else { update_post_meta($post_id, 'cmb_timeline_order', null); };
			if (isset($_POST['cmb_timeline_link_through'])) { update_post_meta($post_id, 'cmb_timeline_link_through', $_POST['cmb_timeline_link_through']); } else { update_post_meta($post_id, 'cmb_timeline_link_through', null); };
			if (isset($_POST['cmb_timeline_display_content'])) { update_post_meta($post_id, 'cmb_timeline_display_content', $_POST['cmb_timeline_display_content']); } else { update_post_meta($post_id, 'cmb_timeline_display_content', null); };
			if (isset($_POST['cmb_timeline_posts_per_page'])) { update_post_meta($post_id, 'cmb_timeline_posts_per_page', $_POST['cmb_timeline_posts_per_page']); } else { update_post_meta($post_id, 'cmb_timeline_posts_per_page', null); };

			if (isset($_POST['cmb_exist'])) { update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']); } else { update_post_meta($post_id, 'cmb_exist', null); };
				
		}
	}


