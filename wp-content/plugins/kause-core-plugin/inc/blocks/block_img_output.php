<?php

	function block_img_output ($params) {

		extract($params);

        // set classes

        switch ($layout) {
            case 'full_width_fit':
                $block_class = "outter-wrapper pb_no_top_hr";
                $outer_wrapper_class = "outter-wrapper feature";
                $inner_wrapper_class = "";
                break;
            case 'boxed_fit':
                $block_class = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper feature";
                $inner_wrapper_class = "wrapper feature-boxed";
                break;
            case 'boxed':
                $block_class = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper";
                $inner_wrapper_class = "wrapper";
                break;
            case 'boxed_center':
                $block_class = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper";
                $inner_wrapper_class = "wrapper align_center";
                break;
            case 'boxed_right':
                $block_class = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper";
                $inner_wrapper_class = "wrapper align_right";
                break;
            default:
                $block_class = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper feature";
                $inner_wrapper_class = "";
                break;
        }

		?>

		<!-- BLOCK: IMAGE-->
        <?php

            if (!empty($img_url)) { 
            ?>

                <div <?php pb_block_id_class($block_class, $params); ?>>
                    <div class="<?php echo $outer_wrapper_class; ?>">
                        <div class="<?php echo $inner_wrapper_class; ?>">

                            <img src="<?php echo $img_url; ?>" alt="blockimage">

                        </div>
                    </div>
                </div>

            <?php
            } 

        ?>
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
