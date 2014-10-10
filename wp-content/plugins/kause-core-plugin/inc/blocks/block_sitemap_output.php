<?php

	function block_sitemap_output ($params) {

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
    	                		<?php if (!empty($title)) { printf('<h1>%s</h1>', esc_attr($title)); } ?>
	                            
	                            <!-- SITEMAP-->
	                            <?php wp_nav_menu(array( 
	                                'theme_location'     => 'main_navigation_menu',
	                                'menu_id'           => 'sitemap',
	                                'menu_class'        => 'sitemap',
	                                'container'         => 'false',
	                                'show_home'         => '1'
	                                ));
	                            ?>
	                         
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
