"use strict";

/*************************************************************
PAGEBUILDER FRONT SCRIPTS

ADD PB_FIRST PB_LAST CLASSES TO PB BLOCKS

*************************************************************/

/*****************************************
ADD PB_FIRST PB_LAST CLASSES TO PB BLOCKS
*****************************************/


	jQuery(document).ready(function($) {

		if ($('.pb_block').size() > 0) {

			var $pbBlocks = $('.pb_block');
			$pbBlocks.first().addClass('pb_block_first');
			$pbBlocks.last().addClass('pb_block_last');

		}
		
	});
