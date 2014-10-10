jQuery( document ).ready( function( $ ) {
	
	add_post_link_to_image();

	function add_post_link_to_image () {
		// Remove the overlay
	    $('.home .kause_single_post .mosaic-block a').remove(); 
	    var post_image = jQuery('.home .kause_single_post .mosaic-backdrop img'); // this is the image needed to wrap
	    
	    // Loop through the featured posts and add the title link to the image
	    $(post_image).each(function(index) {
	    	var currentImage = $(this); 
	    	var post_link = $('.kause_single_post .title a')[index].attributes[0].value;
	     	currentImage.wrap('<a href="' + post_link + '"></a>');
	    })
	}

});

