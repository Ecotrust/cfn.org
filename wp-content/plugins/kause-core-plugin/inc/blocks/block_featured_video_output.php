<?php

	function block_featured_video_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: FEATURED VIDEO-->

			
			
	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class('outter-wrapper feature parallax-block centered', $params); ?> data-stellar-background-ratio="<?php echo $parallax_ratio; ?>">
	            <!-- start main-container -->
	            
	            <style type="text/css" scoped>
	            	.outter-wrapper.parallax-block {
	            		background: url(<?php echo $bg_img; ?>) repeat 0 0 <?php echo $bg_color; ?>;
	            	}
	            </style>
	            
				<div class="main-container" id="skrollr-body">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix">
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

								

						  		<?php echo do_shortcode($before_video); ?>
						  		<?php echo $embed_code; ?>
						  		<?php echo do_shortcode($after_video); ?>
	                         
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
