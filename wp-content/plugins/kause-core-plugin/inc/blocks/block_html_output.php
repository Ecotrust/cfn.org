<?php

	function block_html_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: HTML+CSS-->


		<?php 

			if ($add_outer_wrappers != "checked") {
			?>

		        <!-- start outter-wrapper -->   
	        	<div <?php pb_block_id_class('outter-wrapper', $params); ?>>
					
					<style type="text/css" scoped>
						<?php echo $css; ?>
					</style>

					<?php echo $html; ?>

		        </div>
		        <!-- end outter-wrapper -->

			<?php
			} else {
			?>

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
										<?php echo $css; ?>
									</style>
									
		                            <?php echo do_shortcode($html); ?>
		                         
		                        </div>


		                    </div>
		                    <!-- end main-content -->
		                </div>
		                <!-- end main wrapper -->
		            </div>
		             <!-- end main-container -->
		        </div>
		        <!-- end outter-wrapper -->

			<?php		
			}

		?>

	        
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
