<?php

	function block_revslider_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: REVSLIDER-->
		<div <?php pb_block_id_class('outter-wrapper feature', $params); ?>>
	    	<div class="fullwidthbanner-container">
	    		<div class="fullwidthbanner">

	                <?php 
	                    if (function_exists("putRevSlider")) {
	                        putRevSlider($alias);    
	                    }
	                ?>

	    		</div>
	    	</div>
		</div>	
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
