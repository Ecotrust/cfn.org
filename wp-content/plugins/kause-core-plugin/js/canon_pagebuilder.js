"use strict";

/*************************************************************
PAGEBUILDER INDEX

PAGE BUILDER MAIN
AUTOSUBMIT ON TEMPLATE SELECT CHANGE
PAGEBUILDER DELETE TEMPLATE
INIT OPEN CLOSED STATUS
PAGEBUILDER OPTIONS TOGGLE
PAGEBUILDER SUBOPTIONS TOGGLE
PAGEBUILDER COPY/PASTE BLOCK SETTINGS

BLOCK: WIDGETS
PAGEBUILDER COLORPICKER
BLOCK: SUPPORTERS
BLOCK: Q&A & PRICING
PAGEBUILDER DYNAMIC OPTION

*************************************************************/

/*************************************************************
PAGE BUILDER MAIN
*************************************************************/

	jQuery(document).ready(function($) {

		//DRAGGABLE
		$('#building_blocks .building_block').draggable({
			helper: 'clone',
			connectToSortable: '#building_stage_sortable',
		});

		//SORTABLE
		$('.td_sortable').sortable ({
			connectWith: '.td_sortable',
			placeholder: 'building_stage_sortable_placeholder',
			revert: true,
			update: onSortUpdate,
			stop: onSortStop
		});

		function onSortStop (event, ui) {
			//check if editor has been moved and if so then reload
			checkEditorMove(event, ui);
		}
		
		//onSortUpdate
		function onSortUpdate (event, ui) {
			//check if trashbin
			if(this.id == 'building_trashbin') {
				ui.item.remove();
			}

			//update indexes
			updateIndexes();

			//open new blocks
			updateOpenClosedStatus();

			//check for save_reload class
			if ($('#building_stage_sortable .save_reload').size() > 0 ) {
				$('button.save').click();
			}

		}


		function updateIndexes (event, ui) {

			//DYNAMIC TO STATIC
			var blockName ="";
			var liIndex = 0;
			var optionNameArray = new Array();
			var $block_lis = $('#building_stage_sortable li.building_block');
			$block_lis.each(function (index, element) {
				var $this = $(this);
				var liIndex = index;
				var $block_options = $this.find('.block_options .block_option');
				$block_options.each(function (index, element) {
					var $thisOption = $(this);
					//update option name (make sure it only updates numbers in 2nd bracket)
					var optionName = $thisOption.attr('name');
					var optionNameArray = optionName.split('[');
					optionNameArray[2] = liIndex+"]";

					optionName = optionNameArray.join('[');
					$thisOption.attr('name',optionName);
				});
			}); 


		}

		function checkEditorMove (event, ui) {
			var $this = ui.item;
			var $editors = $this.find('.wp-editor-wrap');
			if ($editors.size() > 0) {
				$('button.save').click();
			}
		}




	/*************************************************************
	INIT OPEN CLOSED STATUS
	*************************************************************/

		//init
		updateOpenClosedStatus();

		function updateOpenClosedStatus() {
			$('#building_stage #building_stage_sortable li').each(function (i) {
				var $this = $(this);
				var status = $this.find('#block_status').val();
				if (status == "closed") $this.find('.block_options').hide();
			});
				
		}


	});


/*************************************************************
AUTOSUBMIT ON TEMPLATE SELECT CHANGE
*************************************************************/

	jQuery(document).ready(function($) {

		//autosubmit on template select change
		$('#building_control #template_id').on('change', function() {
			$(this).closest('form').submit();	
		})
		
	});

/*************************************************************
PAGEBUILDER DELETE TEMPLATE
*************************************************************/

	jQuery(document).ready(function($) {

		$('#building_control button.button-primary.delete').on('click', function() {
			var conf = confirm("WARNING: You are about to delete this template!");
			if (conf === false) {
				event.preventDefault();
			}
		});
	});



/*****************************************
PAGEBUILDER OPTIONS TOGGLE
*****************************************/

	jQuery(document).ready(function($) {

		$('#building_stage').on('click', '.block_header', function() {
			var $this = $(this);
			var $inputStatus = $this.next('.block_options').find('#block_status');
			var status = $inputStatus.val();
			if (status == "open") {
				$inputStatus.val('closed');
			} else {
				$inputStatus.val('open');
			}
			$this.next('.block_options').slideToggle(300);
		});

	});

/*****************************************
PAGEBUILDER SUBOPTIONS TOGGLE
*****************************************/

	jQuery(document).ready(function($) {

		$('#building_stage').on('click','.block_options .option.toggle_header', function () {
			var $this = $(this)	;
			$this.next('.option.toggle_container').slideToggle();
		});

	});

/*****************************************
PAGEBUILDER COPY/PASTE BLOCK SETTINGS
*****************************************/

	jQuery(document).ready(function($) {

		$('#building_stage').on('click','.copy_paste', function (event) {
			event.preventDefault();
			var $this = $(this);
			var $thisBlock = $this.closest('.building_block');
			var $ajaxController = $('#ajax_controller');

			var postContent = extDataPagebuilder.postContent;
			var nonce = extDataPagebuilder.nonce;

			var blockIndex = $this.closest('#building_stage_sortable').find('li').index($this.closest('.building_block'));
			var blockType = $this.closest('.block_options').find('#block_type').val();
			var blockAction = $this.closest('span').attr('data-action');

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: extDataPagebuilder.ajaxURL,
				data: {
					action: 'pagebuilder_block_copy_paste',
					block_index: blockIndex,
					post_content: postContent,
					block_type: blockType,
					block_action: blockAction,
					nonce: nonce
				},
				success: function(response) {
					var settingsObject = response.clipboard;
					var optionID = "";
					var tagName = "";
					$thisBlock.find('.copy_paste_msg').text(response.msg);
					//console.log("SUCCES");
					//console.log(response);
					//console.log(settingsObject);

 					if (blockAction == "paste" && response.type == "success") {
	 					$.each(settingsObject, function (index, element) {
							if (index != "type" && index != "status") {
								var optionSelector = "#block_" + index;
								//console.log(optionSelector);
								var $currentOption = $thisBlock.find(optionSelector);
								//console.log($currentOption.size());
								if ($currentOption.size() > 0) {
									tagName = $currentOption.prop('tagName');
									//console.log("INSERTING IN INPUT NOW");
									$currentOption.val(element);
								}
							} 

						});
					}

				}

			}); //end ajax

		});

	});



/*****************************************
BLOCK: WIDGETS
*****************************************/


	jQuery(document).ready(function($) {

		// init
		$('#building_stage_sortable #block_widgets').each(function(index, element) {
			var $this = $(this);

			canonUpdateNumNeededWidgetAreas($this);
		});

		// on change
		$('#building_stage_sortable').on('change', '#layout', function(event) {
			var $this = $(this);
			var $thisBlock = $this.closest('#block_widgets');

			canonUpdateNumNeededWidgetAreas($thisBlock);
		})

		function canonUpdateNumNeededWidgetAreas($currentBlock) {

			var $this = $currentBlock;

			//get number of needed widget areas
			var $layoutSelect = $this.find('#layout');
			var selectedOptionValue = $layoutSelect.find(':selected').val();
			var valueArray = selectedOptionValue.split("_");
			var numNeededWidgets = valueArray.length;

			//hide unused widget area selects
			var waSelects = $this.find('.widget_area_select').closest('.option');
			waSelects.hide();
			for (var $i = 0; $i < numNeededWidgets; $i++) {  
				waSelects.eq($i).show();
			}
		}

	});


/*****************************************
PAGEBUILDER COLORPICKER
*****************************************/

	jQuery(document).ready(function($) {

		if ($('.colorSelectorBox.pb_color_selector').size() > 0) {

			$('.colorSelectorBox.pb_color_selector').each(function (index, e) {
				var $this = $(this);
				var $relatedInput = $this.next('input');
				$this.ColorPicker({
					color: $relatedInput.val(),
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$this.find('div').css('backgroundColor', '#' + hex);
						$relatedInput.val("#" + hex);
						// console.log(rgb.b);
					}
				});
					
			});

		}	
	});

/*****************************************
BLOCK: SUPPORTERS
*****************************************/

	jQuery(document).ready(function($) {


			//SORTABLE
			$('.supporter_images').sortable ({
				placeholder: 'supporter_images_sortable_placeholder',
				revert: true,
				update: updateIndexesSupporterImages,
			});

			function updateIndexesSupporterImages (event, ui) {

				var $this = $(this); // refers to the sortable list

				var optionsClass = ".block_option";
				var splitPos = 4; // when splitting the name attr select which fragment to update

				var liIndex = 0;
				var optionNameArray = new Array();
				var $list_lis = $this.find('li');
				$list_lis.each(function (index, element) {
					var $this = $(this);
					var liIndex = index;
					//console.log(liIndex);
					var $options = $this.find(optionsClass);
					$options.each(function (index, element) {
						var $thisOption = $(this);
						//update option name (make sure it only updates numbers in 2nd bracket)
						var optionName = $thisOption.attr('name');
						var optionNameArray = optionName.split('[');
						optionNameArray[splitPos] = liIndex+"]";

						optionName = optionNameArray.join('[');
						// console.log(optionName);
						$thisOption.attr('name',optionName);
						//console.log($thisOption.attr('name'));
					});
				}); 

			}

			//upload 
			$('#building_stage_sortable').on('click', '.button_upload_supporter_image', function () {
				var $this = $(this);
				var $optionContainer = $this.closest('.supporters');

				var buttonVal = $this.val().toUpperCase();
				var referer = "boost_default";


		        tb_show(buttonVal, 'media-upload.php?referer=' + referer + '&type=image&TB_iframe=true&post_id=0', false);
		        
				window.send_to_editor = function(html) {
				    var image_url = $('img',html).attr('src'); 
				    // console.log($('img',html).prevObject[0].href); 

					//create new li
					var $template = $optionContainer.find('.supporter_template li');
					$template.clone().prependTo($optionContainer.find('.supporter_images'));

					// get new li
					var $newLI = $optionContainer.find('.supporter_images li').first();

				    // update
				    $newLI.find('input').val(image_url);
				    $newLI.find('img').attr('src', image_url);

				    //mark as active
				    $optionContainer.find('.supporter_images li').removeClass('active');
				    $newLI.addClass('active');

				    //update indexes
					var $this = $optionContainer.find('.supporter_images'); // refers to the sortable list

					var optionsClass = ".block_option";
					var splitPos = 4; // when splitting the name attr select which fragment to update

					var liIndex = 0;
					var optionNameArray = new Array();
					var $list_lis = $this.find('li');
					$list_lis.each(function (index, element) {
						var $this = $(this);
						var liIndex = index;
						//console.log(liIndex);
						var $options = $this.find(optionsClass);
						$options.each(function (index, element) {
							var $thisOption = $(this);
							//update option name (make sure it only updates numbers in 2nd bracket)
							var optionName = $thisOption.attr('name');
							var optionNameArray = optionName.split('[');
							optionNameArray[splitPos] = liIndex+"]";

							optionName = optionNameArray.join('[');
							// console.log(optionName);
							$thisOption.attr('name',optionName);
							//console.log($thisOption.attr('name'));
						});
					}); 


				    tb_remove();  
				};
			});

			//mark active
			$("#building_stage_sortable .supporter_images li").removeClass("active");
			$("#building_stage_sortable .supporter_images li").first().addClass("active");

			$('#building_stage_sortable').on('click', '.supporter_images li', function(event) {
				var $this = $(this);
				var $mainUL = $this.closest('.supporter_images');
				$mainUL.find('li').removeClass("active");
				$this.addClass("active");
			});

			//remove img
			$('#building_stage_sortable').on('click', '.button_remove_supporter_image', function (event) {
				var $this = $(this);
				var $mainOption = $this.closest('.supporters');
				$mainOption.find('.supporter_images li.active').remove();
				$mainOption.find('.supporter_images li').first().addClass("active");

			});


	});

/*****************************************
BLOCK: Q&A & PRICING
*****************************************/

	jQuery(document).ready(function($) {


			// Q&A SORTABLE 
			$('.qa_sortable').sortable ({
				placeholder: 'qa_sortable_placeholder',
				revert: true,
				update: updateIndexesQA,
			});

			// PRICING SORTABLE 
			$('.pricing_sortable').sortable ({
				placeholder: 'pricing_sortable_placeholder',
				revert: true,
				update: updateIndexesQA,
			});

			function updateIndexesQA (event, ui) {

				var $this = $(this); // refers to the sortable list

				var optionsClass = ".block_option";
				var splitPos = 4; // when splitting the name attr select which fragment to update

				var liIndex = 0;
				var optionNameArray = new Array();
				var $list_lis = $this.find('li');
				$list_lis.each(function (index, element) {
					var $this = $(this);
					var liIndex = index;
					//console.log(liIndex);
					var $options = $this.find(optionsClass);
					$options.each(function (index, element) {
						var $thisOption = $(this);
						//update option name (make sure it only updates numbers in 2nd bracket)
						var optionName = $thisOption.attr('name');
						var optionNameArray = optionName.split('[');
						optionNameArray[splitPos] = liIndex+"]";

						optionName = optionNameArray.join('[');
						// console.log(optionName);
						$thisOption.attr('name',optionName);
						//console.log($thisOption.attr('name'));
					});
				}); 

			}

			//add 
			$('#building_stage_sortable').on('click', '.button_add_to_sortable', function () {

				var $this = $(this);
				var $thisControls = $this.closest('.pb_sortable_controls');
				var $thisQASortable = $this.closest('.pb_sortable_controls').prev('.pb_sortable');
				var maxNumElements = $thisControls.attr('data-max_num_elements');
				var numLIs = $thisQASortable.find('li').size();

				if (numLIs < maxNumElements) {

					// create new li
					$thisQASortable.find('li').last().clone().appendTo($thisQASortable);
					
					// update option names
					var optionsClass = ".block_option";
					var splitPos = 4; // when splitting the name attr select which fragment to update
					var $newLI = $thisQASortable.find('li').last();
					var $options = $newLI.find(optionsClass);
					$options.each(function (index, element) {
						var $thisOption = $(this);
						var optionName = $thisOption.attr('name');
						var optionNameArray = optionName.split('[');
						optionNameArray[splitPos] = numLIs+"]";

						optionName = optionNameArray.join('[');
						$thisOption.attr('name',optionName);
						$thisOption.val('');
					});
						
				}



			});

			//remove Q&A
			$('#building_stage_sortable').on('click', '.del_question_link', function (event) {
				event.preventDefault();
				var $this = $(this);
				var minNumElements = $this.closest('.pb_sortable').next('.pb_sortable_controls').attr('data-min_num_elements');
				var $thisQASortable = $this.closest('.pb_sortable');
				var numLIs = $thisQASortable.find('li').size();
				if (numLIs > minNumElements) $this.closest('li').remove();
			});

			// init table_toggle
			$('#building_stage_sortable').find('.options_table').each(function(index, element) {
				var $this = $(this);
				var tableStatus = $this.find('.table_status').val();
				if (tableStatus == "closed") $this.hide();
			});

			// table_toggle
			$('#building_stage_sortable').on('click', '.table_toggle', function (event) {
				// console.log("debug");
				var $this = $(this);
				var $thisOptionsTable = $this.next('.options_table');
				var tableStatus = $thisOptionsTable.find('.table_status').val();
				$this.next('.options_table').toggle();
				if (tableStatus == "closed") {
					$thisOptionsTable.find('.table_status').val('open');
				} else {
					$thisOptionsTable.find('.table_status').val('closed');						
				}

			});


	});

/*****************************************
PAGEBUILDER DYNAMIC OPTION

This is a modified version of DYNAMIC OPTION script suited for pagebuilder.
HOW TO USE: Make an options container withs clas .pb_dynamic_option. 
Give it data-listen_to (selector of parent to listen to) 
Give it data-listen_for (value of parent that activates child).
Give it data-same_level_parent_container (selector of container containing parent, must be on same level and .pb_dynamic_option)

*****************************************/

	jQuery(document).ready(function($) {
		if ($('.pb_dynamic_option').size() > 0) {

			var $dynamicOptions = $('.pb_dynamic_option');

			$dynamicOptions.each(function(index, el) {
				var $this_child = $(this);
				var listenToSelector = $this_child.attr('data-listen_to');
				var sameLevelParentContainer = $this_child.attr('data-same_level_parent_container');
				var $listenTo = $this_child.prev(sameLevelParentContainer).find(listenToSelector);
				var listenFor = $this_child.attr('data-listen_for');

				// init
				if ($listenTo.val() == listenFor) {
					$this_child.slideDown();	
				}

				// on change
				$('body').on('change', listenToSelector, function(event) {
					var $this_parent = $(this);
					if ($this_parent.val() == listenFor) {
						$this_child.slideDown();	
					} else {
						$this_child.slideUp();	
					}
				});

			});

		}

	});

