<?php
	function block_qa_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['title'] 					= "Q & A";
			$params['question'][0] 				= 'My Credit Card Is Stuck In My Computer?';
			$params['answer'][0] 				= 'You should probably get it out of there!';
			$params['toggletype'] 				= 'toggle';
		}

		$params['question'] = array_values($params['question']);
		$params['answer'] = array_values($params['answer']);

		?>

			<li class="building_block block_qa">

				<div class="block_header">
					<?php _e("Q & A", "loc_kause_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='qa'>
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
					
					
				<!-- SELECT -->
					<div class="option">
						<label><?php _e("Type", "loc_kause_core_plugin"); ?></label>
						<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][toggletype]"> 
			     			<option value="toggle" <?php if (isset($params['toggletype'])) {if ($params['toggletype'] == "toggle") echo "selected='selected'";} ?>>Toggle</option> 
			     			<option value="accordion" <?php if (isset($params['toggletype'])) {if ($params['toggletype'] == "accordion") echo "selected='selected'";} ?>>Accordion</option> 
						</select> 
					</div>

					<ul class="pb_sortable qa_sortable">

						<?php 

							for ($i = 0; $i < count($params['question']); $i++) {  
							?>

								<li>

									<table class="options_table option">
										<tr>
											<th>Question</th>
											<td>
												<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][question][<?php echo $i; ?>]' value="<?php if (isset($params['question'][$i])) echo htmlspecialchars($params['question'][$i]); ?>">
											</td>
										</tr>

										<tr>
											<th>Answer</th>
											<td>
												<textarea 
													class='block_option' 
													rows = '3'
													name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][answer][<?php echo $i; ?>]'
												><?php if (isset($params['answer'][$i])) echo $params['answer'][$i]; ?></textarea>
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

					<div class="pb_sortable_controls" data-min_num_elements="1" data-max_num_elements="10000">
						<input type="button" class="button button_add_to_sortable" value="<?php _e("Add new Q&A", "loc_kause_core_plugin"); ?>" />
					</div>

				</div>
			</li>

		<?php	
	}
