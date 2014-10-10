<?php

	function block_sermon_output ($params) {

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
	                    

	                         

	                    		<div class="sermon_wrapper clearfix">

									
			    	                

	                    			
	                    			
	                    			

	                    			<div class="sermon_content">
			    	                	<?php if (!empty($title)) { printf('<div class="sermon_title"><h1>%s</h1></div>', esc_attr($title)); } ?>

	                    				<div class="sermon_meta">
	                    					<!-- byline -->
	                    					<?php 
	                    						if (!empty($sermon_by)) { 
	                    							if (!empty($sermon_by_link)) {
	                    								printf('<a href="%s">%s</a>', esc_url($sermon_by_link), esc_attr($sermon_by));
	                    							} else {
	                    								echo esc_attr($sermon_by);
	                    							}
	                    						} 
	                    					?>

	                    					<!-- divider -->
	  	                    				<?php if (!empty($sermon_by) && !empty($meta_info)) { echo " - "; } ?>
                  					
	                    					<!-- meta info -->
	                    					<?php if (!empty($meta_info)) { echo $meta_info; } ?>
	                    				</div>
	                    				
	                    				
	                    				
	                    				<div class="sermon_links">
	                    					<ul>
	                    						<?php if (!empty($video_link)) { printf("<li><a href='%s' class='fancybox_media fancybox.iframe'><em class='fa fa-video-camera'></em></a></li>", $video_link); } ?>
	                    						<?php if (!empty($audio_link)) { printf("<li><a href='%s' class='fancybox_media fancybox.iframe'><em class='fa fa-volume-up'></em></a></li>", $audio_link); } ?>
	                    						<?php if (!empty($text_link)) { printf("<li><a href='%s'><em class='fa fa-file-text-o'></em></a></li>", $text_link); } ?>
	                    					</ul>
	                    				</div>
	                    				
	                    				
	                    				<?php if (!empty($img_url)) { printf('<div class="sermon_image"><img src="%s"></div>', esc_url($img_url)); } ?>
	                    				

	                    				<div class="sermon_description">
				    	                	<!-- description -->
				    	                	<?php if (!empty($description)) { echo do_shortcode($description); } ?>

				                        	<!-- more link -->
				                        	<?php if (!empty($read_more_link)) { printf('<a class="more" href="%s">%s</a>', esc_url($read_more_link), __("more", "loc_kause_core_plugin")); } ?>
	                    				</div>


				                        	
	                    				

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
