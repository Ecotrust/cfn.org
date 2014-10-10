<?php

	function block_cta_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: CALL TO ACTION BOX-->


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

								<style type="text/css" scoped>
									.message.promo {
										background-color: <?php echo $bg_color; ?>;
										color: <?php echo $text_color; ?>;
									}
									.message.promo a{
										color: <?php echo $link_color; ?>;
									}
								</style>
								
			                	<div class="message promo clearfix">
			                		<h4><?php echo do_shortcode($params['text']); ?></h4>
			                	</div>
	                         
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
