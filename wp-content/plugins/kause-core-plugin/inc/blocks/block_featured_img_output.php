<?php

	function block_featured_img_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: FEATURED IMAGE-->
        <?php

            if (has_post_thumbnail(get_the_ID())) { 
            ?>

                <div <?php pb_block_id_class('outter-wrapper feature', $params); ?>>
                    <div class="outter-wrapper feature">
                        <div class="wrapper">
                            
                        </div>
                        <?php the_post_thumbnail(); ?>
                    </div>
                </div>

            <?php
            } else {
            ?>

                <!-- Start Outter Wrapper -->   
                <div <?php pb_block_id_class('outter-wrapper feature', $params); ?>>
                    <hr>
                </div>
                <!-- End Outter Wrapper --> 
                       
            <?php       
                    
            }

        ?>
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
