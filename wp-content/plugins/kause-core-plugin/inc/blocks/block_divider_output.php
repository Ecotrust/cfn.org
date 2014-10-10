<?php

	function block_divider_output ($params) {

		extract($params);
		?>

		<!-- BLOCK: DIVIDER-->

			<?php
				
				if ($divider_type == "hr") {
				?>
					
		            <!-- Start Outter Wrapper -->   
		            <div <?php pb_block_id_class('outter-wrapper feature', $params); ?>>
		                <hr>
		            </div>
		            <!-- End Outter Wrapper --> 
		            
				<?php
				}
			
				if ($divider_type == "text_bar") {
				?>
					
	        		<!-- start outter-wrapper -->   
			        <div <?php pb_block_id_class('outter-wrapper feature callout-block centered', $params); ?>>
			            <!-- start main-container -->
			            <div class="main-container">
			                <!-- start main wrapper -->
			                <div class="main wrapper clearfix">
			                    <!-- start main-content -->
			                    <div class="main-content">

			                    	<!-- Start Post --> 
			                    	<div class="clearfix">

					  					<h4><?php echo $divider_text; ?></h4>
			                         
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
