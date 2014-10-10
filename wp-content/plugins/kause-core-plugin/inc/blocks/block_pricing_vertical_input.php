<?php
	function block_pricing_vertical_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['title'] 					= "Make a donation";

			$params['tables']					= array(
				0									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'unchecked',
					'table_title'						=> 'Platinum',
					'price'								=> '$990',
					'interval'							=> 'Once',
					'content'							=> '<h3>Lifetime membership</h3>
<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>',
					'bonus_content_1'					=> '<h3>2500 Trees</h3>
<p>We will plant 2500 native trees, helping to offset carbon.</p>',
					'bonus_content_2'					=> '<h3>1000 Litres</h3>
<p>We will recycle 100 litres of grey water.</p>',
					'btn_text'							=> 'Join Up',
					'btn_link'							=> '',
				),

				1									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'checked',
					'table_title'						=> 'Gold',
					'price'								=> '$35',
					'interval'							=> 'p/year',
					'content'							=> '<h3>365 days membership</h3>
<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>',
					'bonus_content_1'					=> '<h3>300 Trees</h3>
<p>We will plant 300 native trees, helping to offset carbon.</p>',
					'bonus_content_2'					=> '',
					'btn_text'							=> 'Join Up',
					'btn_link'							=> '',
				),

				2									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'unchecked',
					'table_title'						=> 'Silver',
					'price'								=> '$29',
					'interval'							=> 'p/year',
					'content'							=> '<h3>365 days membership</h3>
<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>',
					'bonus_content_1'					=> '<h3>200 Trees</h3>
<p>We will plant 200 native trees, helping to offset carbon.</p>',
					'bonus_content_2'					=> '',
					'btn_text'							=> 'Join Up',
					'btn_link'							=> '',
				),
			);
		}

		// var_dump($params['tables']);



		?>

			<li class="building_block block_pricing_vertical">

				<div class="block_header">
					<?php _e("Vertical Pricing Tables", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='pricing_vertical'>
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
										<?php _e("Table", "loc_kause_core_plugin"); ?>
									</div>

									<table class="options_table option">

										<input class='block_option table_status' type="hidden" name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][table_status]' value='<?php if (isset($params['tables'][$i]['table_status'])) {echo $params['tables'][$i]['table_status'];} else {echo "open";} ?>'>
										
										<tr>
											<th><?php _e("Featured table", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][feature]" value="unchecked" />
												<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][feature]" class="checkbox" value="checked" <?php if (isset($params['tables'][$i]['feature'])) { checked($params['tables'][$i]['feature'] == "checked"); } ?>/> 
											</td>
										</tr>

										<tr>
											<th><?php _e("Table title", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][table_title]' value="<?php if (isset($params['tables'][$i]['table_title'])) echo htmlspecialchars($params['tables'][$i]['table_title']); ?>">
											</td>
										</tr>

										<tr>
											<th><?php _e("Price", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][price]' value="<?php if (isset($params['tables'][$i]['price'])) echo htmlspecialchars($params['tables'][$i]['price']); ?>">
											</td>
										</tr>

										<tr>
											<th><?php _e("Interval", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][interval]' value="<?php if (isset($params['tables'][$i]['interval'])) echo htmlspecialchars($params['tables'][$i]['interval']); ?>">
											</td>
										</tr>

										<tr>
											<th><?php _e("Content", "loc_kause_core_plugin"); ?></th>
											<td>
												<textarea 
													class='block_option' 
													rows = '4'
													name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][content]'
												><?php if (isset($params['tables'][$i]['content'])) echo $params['tables'][$i]['content']; ?></textarea>
											</td>
										</tr>

										<tr>
											<th><?php _e("Bonus content 1 (optional)", "loc_kause_core_plugin"); ?></th>
											<td>
												<textarea 
													class='block_option' 
													rows = '4'
													name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][bonus_content_1]'
												><?php if (isset($params['tables'][$i]['bonus_content_1'])) echo $params['tables'][$i]['bonus_content_1']; ?></textarea>
											</td>
										</tr>

										<tr>
											<th><?php _e("Bonus content 2 (optional)", "loc_kause_core_plugin"); ?></th>
											<td>
												<textarea 
													class='block_option' 
													rows = '4'
													name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][bonus_content_2]'
												><?php if (isset($params['tables'][$i]['bonus_content_2'])) echo $params['tables'][$i]['bonus_content_2']; ?></textarea>
											</td>
										</tr>

										<tr>
											<th><?php _e("Button text", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][btn_text]' value="<?php if (isset($params['tables'][$i]['btn_text'])) echo htmlspecialchars($params['tables'][$i]['btn_text']); ?>">
											</td>
										</tr>

										<tr>
											<th><?php _e("Button link", "loc_kause_core_plugin"); ?></th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][btn_link]' value="<?php if (isset($params['tables'][$i]['btn_link'])) echo htmlspecialchars($params['tables'][$i]['btn_link']); ?>">
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
