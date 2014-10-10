<?php
	function block_text_section_input ($passed_vars) {


		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!isset($params['title'])) { $params['title'] = "More About Our Team"; }
		if (!isset($params['text'])) { $params['text'] = '<div class="half">
	<h4>Culture</h4>
	<p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
	<p>Donec sed odio dui. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
</div>

<div class="half last">
	<h4>Team Past Times</h4>
	<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Sed posuere consectetur est at lobortis. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Vestibulum id ligula porta felis euismod semper.</p>
	<ol class="graphs">
		<li><div class="per-80 blue-btn">Beer Pong <span>80%</span></div></li>
		<li><div class="per-60 green-btn">Gaming <span>60%</span></div></li>
		<li><div class="per-40">Scabble <span>40%</span></div></li>
		
	</ol>
</div>	
';
		if (!isset($params['hide_title'])) { $params['hide_title'] = "unchecked"; }
		}

		?>

			<li class="building_block block_text_section<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Text Section", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='text_section'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>

					<div class="option">
						<label>Title</label>
						<input class='block_option' type='text' id='block_title' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
					</div>
					
 				<!-- CHECKBOX -->
					<div class="option">
						<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][hide_title]" value="unchecked" />
						<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][hide_title]" class="checkbox" value="checked" <?php if (isset($params['hide_title'])) { checked($params['hide_title'] == "checked"); } ?>/> 
						<?php _e("Hide title and divider", "loc_kause_core_plugin"); ?>
					</div>

					<!-- WP EDITOR -->
 					<?php 

 						if ($exist) {
 						?>
							<div class="option">
								<label>Editor</label>

								<?php 

									wp_editor($params['text'], 'blocK_text_'.$index, array(
									    'textarea_name' => 'canon_options_pagebuilder[blocks]['.$index.'][text]',
									    'teeny' => false,
									    'media_buttons' => true,
									    'editor_class' => 'block_option',
						    			'tinymce' => true,
									));

								?>

							</div>

 						<?php	
 						} else {
 						?>

 							<div class="option">
								<label>Editor</label>
								<img class="editor_load" src="<?php echo plugins_url('', __FILE__ ) . "/../../img/ajax-loader.gif"; ?>">
 							</div>
 						
 						<?php		
 						}

 					?>
					<!-- END WP EDITOR -->




				</div>
				
			</li>

		<?php	
	}
