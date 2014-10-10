<?php

	function block_pricing_output ($params) {

		extract($params);

		$tables = array_values($tables);

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

    	                	<?php if (!empty($title)) { printf('<h1>%s</h1>', esc_attr($title)); } ?>
    	                	<?php if (!empty($text)) { printf('<p class="lead">%s</p>', do_shortcode($text)); } ?>
		                	
	                		<hr/>
	                		
	                    	<!-- Start Post --> 
	                    	<div class="clearfix">


    	                		<?php 
    	                			$base_class = "price";
    	                			$size_class  = " " .mb_get_size_class_from_num(count($tables), 'third');

    	                		
    	                			for ($i = 0; $i < count($tables); $i++) { 

    	                				$feature_class = ($tables[$i]['feature'] == "checked") ? " price-feature" : "";
    	                				$last_class = ($i === count($tables)-1) ? " last" : "" ;
    	                				$final_class = $base_class . $size_class . $feature_class . $last_class;
    	                			?>

			    	                	<div class="<?php echo $final_class; ?>">
			    	                		<h3>
			    	                			<?php echo $tables[$i]['table_title']; ?>
			    	                			<span><?php echo $tables[$i]['price']; ?></span>
			    	                		</h3>

			    	                		<div class="price-detail">
			    	                			<?php echo do_shortcode($tables[$i]['content']); ?>

			    	                			<?php if (!empty($tables[$i]['btn_text'])) { printf('<a class="btn" href="%s">%s</a>', esc_url($tables[$i]['btn_link']), esc_attr($tables[$i]['btn_text'])); } ?>
			    	                			
		    	                			</div>	

    	                				</div>
    	                			<?php
    	                			}
    	                		
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
