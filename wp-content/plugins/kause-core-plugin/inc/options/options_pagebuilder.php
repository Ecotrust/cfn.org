	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2>Kause - <?php _e("Pagebuilder", "loc_kause_core_plugin"); ?></h2>

		<?php 
			// GET VARS
			//delete_option('canon_options_pagebuilder');
			$canon_options_pagebuilder = get_option('canon_options_pagebuilder'); 

			// echo "canon_options_pagebuilder";
			// echo "<pre>";
			// print_r($canon_options_pagebuilder);
			// echo "</pre>";

			//GET LATEST TEMPLATE BEFORE ACTIONS
			$this_post = get_posts(array(
				'numberposts'	=> 1,
				'post_type'		=> 'pb_template',
				'orderby'		=> 'post_date',
				'order'			=> 'DESC',
			));

			//DETERMINE ACTION

			//if templates do not exist new else default edit
			if (!$this_post) {
				//NO TEMPLATES
				delete_option('canon_options_pagebuilder');
				$canon_options_pagebuilder = get_option('canon_options_pagebuilder'); 
				$action = 'new';
			} else {
				//DEFAULT IF TEMPLATES EXIST
				$action = 'edit';
				$current_template_id = isset($canon_options_pagebuilder['template_id']) ? $canon_options_pagebuilder['template_id'] : $this_post[0]->ID;
			}

			//if a button has been clicked
			if (isset($canon_options_pagebuilder['action'])) {

				//IF NEW HAS BEEN CLICKED
				if ($canon_options_pagebuilder['action'] == "new") {
					unset($canon_options_pagebuilder['action']);
					$action = 'new'	;
				} elseif ($canon_options_pagebuilder['action'] == "save") {
					unset($canon_options_pagebuilder['action']);
					$action = 'save';
				} elseif ($canon_options_pagebuilder['action'] == "del") {
					unset($canon_options_pagebuilder['action']);
					delete_option('canon_options_pagebuilder');
					$action = 'del';
				}
			}


			// echo "this_post";
			// var_dump($this_post);
			// echo "post_content";
			// var_dump($this_post[0]->post_content);
			// echo "action";
			// var_dump($action);
			// echo '$canon_options_pagebuilder';
			// var_dump($canon_options_pagebuilder);

			//EXECUTE ACTION
			//del must come before new
			if ($action == 'del') {
				wp_delete_post($current_template_id, true);

				//check if there are more posts
				$this_post = get_posts(array(
					'numberposts'	=> 1,
					'post_type'		=> 'pb_template',
					'orderby'		=> 'post_date',
					'order'			=> 'DESC',
				));
				if (!$this_post) {
					//NO TEMPLATES
					delete_option('canon_options_pagebuilder');
					$canon_options_pagebuilder = get_option('canon_options_pagebuilder'); 
					$action = 'new';
				} else {
					//DEFAULT IF TEMPLATES EXIST
					$action = 'edit';
					$current_template_id = $this_post[0]->ID;
					$canon_options_pagebuilder['template_id'] = $current_template_id;
					update_option('canon_options_pagebuilder', $canon_options_pagebuilder);

				}
			}

			if ($action == 'new') {
				$template_array = array(
					'post_type' 	=> 'pb_template',
					'post_status'	=> 'publish'
				);
				$current_template_id = wp_insert_post($template_array);
				$canon_options_pagebuilder['template_id'] = $current_template_id;
				update_option('canon_options_pagebuilder', $canon_options_pagebuilder);
			}

			if ($action == 'save') {
				$template_array = array(
					'ID' 			=> $current_template_id,
					'post_title'	=> $canon_options_pagebuilder['name'],
					'post_content'	=> base64_encode(serialize($canon_options_pagebuilder))
				);
				wp_update_post($template_array);
			}

			// echo "current_template_id";
			// var_dump($current_template_id);
			// var_dump($this_post[0]->ID);

			//GET TEMPLATE AFTER ACTIONS
			$this_post = get_posts(array(
				'include'		=> $current_template_id,
				'numberposts'	=> 1,
				'post_type'		=> 'pb_template',
				'orderby'		=> 'post_date',
				'order'			=> 'DESC',
			));

			//GET ALL TEMPLATES
			$all_posts = get_posts(array(
				'numberposts'	=> -1,
				'post_type'		=> 'pb_template',
				'orderby'		=> 'post_title',
				'order'			=> 'ASC',
			));

			//AJAX NONCE
			$pagebuilder_nonce = wp_create_nonce("pagebuilder_block_copy_paste_nonce");


			// var_dump($this_post);
			//echo '$canon_options_pagebuilder';
			//var_dump($canon_options_pagebuilder);

			//var_dump($all_posts);


			//$canon_options_pagebuilder holds all the old values (from the page you just came from)
			//$this_post holds all the updated values that should be displayed on the page.
			// var_dump(unserialize($this_post[0]->post_content));

			//debug get transient
			$pagebuilder_clipboard = get_transient('boost_pagebuilder_clipboard');
			//var_dump($pagebuilder_clipboard);

			//$filtered_post_content = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $this_post[0]->post_content ); 
			$filtered_post_content = $this_post[0]->post_content;

			//send data to ajax copy-paste
			wp_localize_script('canon_pagebuilder_scripts','extDataPagebuilder', array(
				'templateURI'		=> get_template_directory_uri(), 
				'ajaxURL'			=> admin_url('admin-ajax.php'),
				'postContent'		=> unserialize(base64_decode($filtered_post_content)),
				'nonce'				=> $pagebuilder_nonce
			));        

		?>

		<br>
		
		<div class="canon_pagebuilder_options_wrapper">

		<!-- BLOCKS -->
			<div id="building_blocks-wrapper" class="light-box">
			
				<h3 class="building-title">Blocks</h3>
				
				<div class="inner-content stage">
				
					<ul id="building_blocks">

						<?php 
							block_featured_img_input(array());
							block_content_input(array());
							block_content_sidebar_input(array());
							block_revslider_input(array());
							block_text_section_input(array());
							block_widgets_input(array());
							block_featured_video_input(array());
							block_featured_posts_input(array());
							block_supporters_input(array());
							block_people_input(array());
							block_qa_input(array());
							block_cta_input(array());
							block_html_input(array());
							block_pricing_input(array());
							block_pricing_vertical_input(array());
							block_countdown_input(array());
							block_sitemap_input(array());
							block_img_input(array());
							block_divider_input(array());
							block_space_input(array());
							block_download_input(array());
							block_sermon_input(array());
							if (class_exists('TribeEvents')) { block_events_calendar_event_input(array()); }
						 ?>

					</ul>
					
				</div>
				
			</div>

			<div class="form_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_pagebuilder'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_pagebuilder'); ?>		

				<!-- STAGE -->
					
					<div id="building_stage" class="light-box">
					<h3 class="building-title">Template Canvas</h3>
						<div class="inner-content sort">
							<ul id='building_stage_sortable' class="td_sortable">

								<?php 
									$post_content = unserialize(base64_decode($filtered_post_content));

									//SHOW TEMPLATE BLOCKS
									if (isset($post_content['blocks'])) {
										$blocks = $post_content['blocks'];
										for ($pbi = 0; $pbi < count($blocks); $pbi++) {

											if ($blocks[$pbi]['type'] == "featured_img") { block_featured_img_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "content") { block_content_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "content_sidebar") { block_content_sidebar_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "revslider") { block_revslider_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "text_section") { block_text_section_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "widgets") { block_widgets_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "featured_video") { block_featured_video_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "featured_posts") { block_featured_posts_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "supporters") { block_supporters_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "people") { block_people_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "qa") { block_qa_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "cta") { block_cta_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "html") { block_html_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "pricing") { block_pricing_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "pricing_vertical") { block_pricing_vertical_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "countdown") { block_countdown_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "sitemap") { block_sitemap_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "img") { block_img_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "divider") { block_divider_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "space") { block_space_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "download") { block_download_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "sermon") { block_sermon_input(array($pbi,$blocks[$pbi])); }
											if ($blocks[$pbi]['type'] == "events_calendar_event") { block_events_calendar_event_input(array($pbi,$blocks[$pbi])); }

										}	//end fori
									}	//end if blocks exist

								?>
							</ul>
							
						</div>
						
					<!-- TRASHBIN -->
					
						<ul id="building_trashbin" class="td_sortable">
							
						</ul>
						
					</div>
					
				<!-- CONTROL -->
					
					<div id="building_control" class="light-box">
					
						<h3 class="building-title">Template Controls</h3>
						<div class="inner-content">
						
							<label>Current template:</label>
							<select id="template_id" name="canon_options_pagebuilder[template_id]">
								<?php
									for ($pbi = 0; $pbi < count($all_posts); $pbi++) {
									?>
										<option value="<?php echo $all_posts[$pbi]->ID; ?>" <?php if (isset($current_template_id)) {if ($current_template_id == $all_posts[$pbi]->ID) echo "selected='selected'";} ?>><?php if (!empty($all_posts[$pbi]->post_title)) {echo $all_posts[$pbi]->post_title;} else {echo 'Untitled';} ?></option> 
									<?php
									}
								?>
							</select> 



							<p>
								<label>Template name:</label>
								<input type="text" id="template_name" name="canon_options_pagebuilder[name]" value="<?php echo $this_post[0]->post_title; ?>">
							</p>
							
							<button id="action" name="canon_options_pagebuilder[action]" class="button-primary save" value="save">Save Changes</button>
							<button id="action" name="canon_options_pagebuilder[action]" class="button-primary create" value="new">Create New Template</button>
							<button id="action" name="canon_options_pagebuilder[action]" class="button-primary delete" value="del">Delete this template</button>
							
						</div>
						
					</div>

				</form>
				
			</div> <!-- end form container -->	

		</div>

	</div>

