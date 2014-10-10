<?php
	function block_download_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['title'] 					= "Download";
			$params['text'] 					= 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id neque urna. Morbi fringilla risus non risus ornare elementum. In vitae sollicitudin arcu. Cras dui massa, ullamcorper vel porta eget, porttitor sit amet lorem.';

			$params['tables']					= array(
				0									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'checked',
					'icon'								=> 'fa-download',
					'box_title'							=> 'File 1',
					'description'						=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id neque urna. Morbi fringilla risus non risus ornare elementum. In vitae sollicitudin arcu. Cras dui massa, ullamcorper vel porta eget, porttitor sit amet lorem.',
					'btn_text'							=> 'Download',
					'file_url'							=> '',
				),

				1									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'unchecked',
					'icon'								=> 'fa-download',
					'box_title'							=> 'File 2',
					'description'						=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id neque urna. Morbi fringilla risus non risus ornare elementum. In vitae sollicitudin arcu. Cras dui massa, ullamcorper vel porta eget, porttitor sit amet lorem.',
					'btn_text'							=> 'Download',
					'file_url'							=> '',
				),

				2									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'unchecked',
					'icon'								=> 'fa-download',
					'box_title'							=> 'File 3',
					'description'						=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id neque urna. Morbi fringilla risus non risus ornare elementum. In vitae sollicitudin arcu. Cras dui massa, ullamcorper vel porta eget, porttitor sit amet lorem.',
					'btn_text'							=> 'Download',
					'file_url'							=> '',
				),
			);
		}

		// var_dump($params['tables']);



		?>

			<li class="building_block block_download">

				<div class="block_header">
					<?php _e("Download List", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='download'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>


				<!-- TEXT INPUT -->
					<div class="option">
						<label><?php _e("Title", "loc_kause_core_plugin"); ?></label>
						<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
					</div>
					
				<!-- TEXTAREA -->
					<div class="option">
						<label><?php _e("Text", "loc_kause_core_plugin"); ?></label>
						<textarea 
							class='block_option' 
							rows = '3'
							name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][text]'
						><?php if (isset($params['text'])) echo $params['text']; ?></textarea>
						<span class="detail">Enter text / HTML</span>
					</div>
					
				<!-- SORTABLE -->
					<ul class="pb_sortable pricing_sortable">

						<?php 

							for ($i = 0; $i < count($params['tables']); $i++) {  
							?>

								<li>

									<div class="block_subheader table_toggle">
										<?php _e("Download Box", "loc_kause_core_plugin"); ?>
									</div>

									<table class="options_table option">

										<input class='block_option table_status' type="hidden" name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][table_status]' value='<?php if (isset($params['tables'][$i]['table_status'])) {echo $params['tables'][$i]['table_status'];} else {echo "open";} ?>'>
										
										<tr>
											<th><?php _e("Featured download", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][feature]" value="unchecked" />
												<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][feature]" class="checkbox" value="checked" <?php if (isset($params['tables'][$i]['feature'])) { checked($params['tables'][$i]['feature'] == "checked"); } ?>/> 
											</td>
										</tr>


										<!-- ICON -->
										<?php $font_awesome_array = mb_get_font_awesome_icon_names_in_array(); ?>

										<tr>
											<th><?php _e("Icon", "loc_canon"); ?></th>
											<td>
												<select class="block_option fa_select" name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][icon]'> 
													<?php 

														for ($n = 0; $n < count($font_awesome_array); $n++) {  
														?>
									     					<option value="<?php echo $font_awesome_array[$n]; ?>" <?php if (isset($params['tables'][$i]['icon'])) {if ($params['tables'][$i]['icon'] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo $font_awesome_array[$n]; ?></option> 
														<?php
														}

													?>
												</select> 

												<i class="fa <?php if (isset($params['tables'][$i]['icon'])) { echo $params['tables'][$i]['icon']; } else { echo "fa-flag"; } ?>"></i>

											</td>
										</tr>



										<tr>
											<th><?php _e("Title", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][box_title]' value="<?php if (isset($params['tables'][$i]['box_title'])) echo htmlspecialchars($params['tables'][$i]['box_title']); ?>">
											</td>
										</tr>

										<tr>
											<th><?php _e("Description", "loc_kause_core_plugin"); ?></th>
											<td>
												<textarea 
													class='block_option' 
													rows = '4'
													name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][description]'
												><?php if (isset($params['tables'][$i]['description'])) echo $params['tables'][$i]['description']; ?></textarea>
											</td>
										</tr>

										<tr>
											<th><?php _e("Button text", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][btn_text]' value="<?php if (isset($params['tables'][$i]['btn_text'])) echo htmlspecialchars($params['tables'][$i]['btn_text']); ?>">
											</td>
										</tr>

										<!-- UPLOAD -->
										<tr>
											<th><?php _e("File URL", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option url' type='text' id='file_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][file_url]' value='<?php if (isset($params['tables'][$i]['file_url'])) echo $params['tables'][$i]['file_url']; ?>'>
												<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Select file", "loc_kause_core_plugin"); ?>" />
											</td>
										</tr>


										<tr>
											<td colspan="2" class="del_question_link"><a href="">delete</a></td>
										</tr>

									</table>

								</li>
								
							<?php
							}

						?>
					</ul>

					<div class="pb_sortable_controls" data-min_num_elements="1" data-max_num_elements="1000">
						<input type="button" class="button button_add_to_sortable" value="<?php _e("Add new pricing table", "loc_kause_core_plugin"); ?>" />
					</div>


				</div>
			</li>

		<?php	
	}
