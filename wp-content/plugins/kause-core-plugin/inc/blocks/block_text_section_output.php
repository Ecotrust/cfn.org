<?php

	function block_text_section_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: PEOPLE-->

	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class('outter-wrapper', $params); ?>>
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix">
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

	    	                	<?php if ($hide_title != "checked" && !empty($title)) { printf('<div class="text-seperator"><h5>%s</h5></div>', $title); } ?>
	    	                	
	    	                	<?php echo do_shortcode($text); ?>
	                         
	                        </div>


	                    </div>
	                    <!-- end main-content -->
	                </div>
	                <!-- end main wrapper -->
	            </div>
	             <!-- end main-container -->
	        </div>
	        <!-- end outter-wrapper -->
		
		<!-- END BLOCK -->

		<?php

		return true;		
	}
