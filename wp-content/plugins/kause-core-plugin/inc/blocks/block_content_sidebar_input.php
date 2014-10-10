<?php
	function block_content_sidebar_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		// get array of registered sidebars
		$registered_sidebars_array = array();

		foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
			array_push($registered_sidebars_array, $value);
		}

		?>

			<li id="block_content_sidebar" class="building_block">

				<div class="block_header">
					<?php _e("Page Content + Sidebar", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='content_sidebar'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params)) {echo $params['status'];} else {echo "open";} ?>'>

					<div class="option">
						<span class="detail"><?php _e("Displays the content of your page. Make sure the page using this pagebuilder template has content.", "loc_kause_core_plugin"); ?></span>
					</div>

				<!-- SELECT -->
					<div class="option">
						<label><?php _e("Select sidebar", "loc_kause_core_plugin"); ?></label>
						<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][sidebar_id]"> 

							<?php 
								for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
								?>
				     				<option value="<?php echo $registered_sidebars_array[$i]['id']; ?>" <?php if (isset($params['sidebar_id'])) {if ($params['sidebar_id'] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo  $registered_sidebars_array[$i]['name']; ?></option> 
								<?php
								}
							?>

						</select> 
					</div>


				</div>
			</li>

		<?php	
	}
