<?php

	function block_TEMPLATE_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: LATEST POSTS-->

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

	                            <!-- THE TITLE -->  
	                            <h1><?php the_title(); ?></h1>
	                            
	                           
	                             <!-- THE CONTENT -->
	                            <?php the_content(); ?>
	                            
	                            <!-- WP_LINK_PAGES -->
	                            <?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_kause_core_plugin'))); ?>
	                         
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
