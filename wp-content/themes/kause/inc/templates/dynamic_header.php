	<!-- NATIVE HEADER STUFF -->

	<?php $canon_options = get_option('canon_options'); ?>
	<?php $canon_options_appearance = get_option('canon_options_appearance'); ?>

		<?php if ($canon_options['hide_theme_meta_description'] != 'checked') { printf("<meta name='description' content='%s'>", esc_attr(get_bloginfo('description'))); } ?>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- FAVICON -->

        <link rel="shortcut icon" href="<?php if (empty($canon_options['favicon_url'])) {echo get_template_directory_uri() . "/img/default_favicon.ico";} else {echo $canon_options['favicon_url'];} ?>" />
        
	<!-- USER FONTS -->

	    <?php if (isset($canon_options_appearance['font_main'][0])) { if ($canon_options_appearance['font_main'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_main']); } ?>
	    <?php if (isset($canon_options_appearance['font_quote'][0])) { if ($canon_options_appearance['font_quote'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_quote']); } ?>
	    <?php if (isset($canon_options_appearance['font_logotext'][0])) { if ($canon_options_appearance['font_logotext'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_logotext']); } ?>
	    <?php if (isset($canon_options_appearance['font_bold'][0])) { if ($canon_options_appearance['font_bold'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_bold']); } ?>
	    <?php if (isset($canon_options_appearance['font_button'][0])) { if ($canon_options_appearance['font_button'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_button']); } ?>
	    <?php if (isset($canon_options_appearance['font_italic'][0])) { if ($canon_options_appearance['font_italic'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_italic']); } ?>
	    <?php if (isset($canon_options_appearance['font_heading'][0])) { if ($canon_options_appearance['font_heading'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_heading']); } ?>
	    <?php if (isset($canon_options_appearance['font_nav'][0])) { if ($canon_options_appearance['font_nav'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_nav']); } ?>
	    <?php if (isset($canon_options_appearance['font_widget_footer'][0])) { if ($canon_options_appearance['font_widget_footer'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_widget_footer']); } ?>

	<!-- OPEN GRAPH -->

	<?php $og_img_src = isset($post->ID) ? wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full') : ""; ?>

		<meta property="og:type" content="article" />
		<meta property="og:url" content="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

		<?php 
			if (mb_get_page_type() == 'single') {
			?>
				<meta property="og:title" content="<?php echo $post->post_title; ?>" />
			<?php	
			} else {
			?>
				<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
			<?php		
			}
		?>

		<?php 
			if (!empty($post->post_content)) {
			?>
				<meta property="og:description" content="<?php echo mb_make_excerpt($post->post_content, 350, true); ?>"/>
			<?php	
			} else {
			?>
				<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
			<?php		
			}
		?>

		<?php 
			if (!empty($og_img_src)) {
			?>
				<meta property="og:image" content="<?php echo $og_img_src[0]; ?>" />
			<?php	
			} else {
			?>
				<meta property="og:image" content="<?php if (isset($canon_options['logo_url'])) echo $canon_options['logo_url']; ?>" />
			<?php		
			}
		?>

