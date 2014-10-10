<?php

	function block_supporters_output ($params) {

		//remove template and do array_values
		unset($params['img']['image_index']);
		$params['img'] = array_values($params['img']);
		
		extract($params);

		?>

		<!-- BLOCK: SUPPORTERS-->

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

			  					<h4><?php echo $banner_text; ?></h4>
	                         
	                        </div>


	                    </div>
	                    <!-- end main-content -->
	                </div>
	                <!-- end main wrapper -->
	            </div>
	             <!-- end main-container -->
	        </div>
	        <!-- end outter-wrapper -->


			  
			  
  


	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_class('outter-wrapper feature social-block centered', $params); ?>>
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->

                    	<div class="clearfix">

					  		<ul class="social-thumbs">

					  			<?php 
					  				$max_num_images = 66;

					  				if ( ($repeat == "checked") && (count($img) > 0) ) {
					  					$times_to_repeat = round( $max_num_images / count($img) );
					  					for ($n = 0; $n < $times_to_repeat; $n++) {  
							  				for ($i = 0; $i < count($img); $i++) { 
							  				?>
									  			<li><img src="<?php echo $img[$i]; ?>" alt="mock" /></li>
							  				 <?php 
							  				}
					  					}
					  				} else {
						  				for ($i = 0; $i < count($img); $i++) { 
						  				?>
								  			<li><img src="<?php echo $img[$i]; ?>" alt="mock" /></li>
						  				 <?php 
						  				}
					  						
					  				}

					  			?>
					  		</ul>
					  		
					  		<div class="wrapper">	

					  			<?php if (!empty($btn_1_text)) { printf('<a href="%s" class="btn">%s</a>', esc_url($btn_1_link), esc_attr($btn_1_text)); }  ?>
					  			<?php if (!empty($btn_2_text)) { printf('<a href="%s" class="btn green-btn">%s</a>', esc_url($btn_2_link), esc_attr($btn_2_text)); }  ?>

					  			<?php if (!empty($html)) { echo $html; } ?>
						  		
					  		</div>

                         
                        </div>

	            </div>
	             <!-- end main-container -->
	        </div>
	        <!-- end outter-wrapper -->
	        
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
