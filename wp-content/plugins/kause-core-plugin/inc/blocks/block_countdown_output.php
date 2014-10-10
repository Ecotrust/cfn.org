<?php

	function block_countdown_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: COUNTDOWN-->

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

    	                		<?php if (!empty($title)) { printf('<h1>%s</h1>', esc_attr($title)); } ?>

	                            <div class="countdown"
	                            	data-label_years = "<?php _e("Years", "loc_kause_core_plugin"); ?>"
	                            	data-label_months = "<?php _e("Months", "loc_kause_core_plugin"); ?>"
	                            	data-label_weeks = "<?php _e("Weeks", "loc_kause_core_plugin"); ?>"
	                            	data-label_days = "<?php _e("Days", "loc_kause_core_plugin"); ?>"
	                            	data-label_hours = "<?php _e("Hours", "loc_kause_core_plugin"); ?>"
	                            	data-label_minutes= "<?php _e("Minutes", "loc_kause_core_plugin"); ?>"
	                            	data-label_seconds = "<?php _e("Seconds", "loc_kause_core_plugin"); ?>"
	                            	
	                            	data-label_year = "<?php _e("Year", "loc_kause_core_plugin"); ?>"
	                            	data-label_month = "<?php _e("Month", "loc_kause_core_plugin"); ?>"
	                            	data-label_week = "<?php _e("Week", "loc_kause_core_plugin"); ?>"
	                            	data-label_day = "<?php _e("Day", "loc_kause_core_plugin"); ?>"
	                            	data-label_hour = "<?php _e("Hour", "loc_kause_core_plugin"); ?>"
	                            	data-label_minute= "<?php _e("Minute", "loc_kause_core_plugin"); ?>"
	                            	data-label_second = "<?php _e("Second", "loc_kause_core_plugin"); ?>"
	                            	
	                            	data-label_y = "<?php _e("Y", "loc_kause_core_plugin"); ?>"
	                            	data-label_m = "<?php _e("M", "loc_kause_core_plugin"); ?>"
	                            	data-label_w = "<?php _e("W", "loc_kause_core_plugin"); ?>"
	                            	data-label_d = "<?php _e("D", "loc_kause_core_plugin"); ?>"

	                            	data-datetime_string = "<?php echo $datetime_string; ?>"
	                            	data-gmt_offset = "<?php echo $gmt_offset; ?>"
	                            	data-format = "<?php echo $format; ?>"
	                            	data-use_compact = "<?php echo $use_compact; ?>"
	                            	data-description = '<?php echo $description; ?>'
	                            ></div>
	                         
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
