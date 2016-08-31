/*
 * Front End Scripts
 * Handles universal front-end interactivity for the theme
 */

jQuery(document).ready(function($){
	
	$('.layout-toggle').on('click', function(){
		
		var $blogListing = $('.blog-listing'); 
		var $toggle = $(this);
		
		//set active class for toggle
		$toggle.addClass('active');
		$toggle.siblings().removeClass('active');
		
		//toggle from column to grid
		if($blogListing.hasClass('column')){
			
			$blogListing.addClass('grid').removeClass('column');
			
			
			//set up masonry
			SetUpBlogMasonry($blogListing);
				
		}
		//toggling from grid to standard, remove masonry if needed
		else if($blogListing.hasClass('grid')){
			$blogListing.addClass('column').removeClass('grid');
			$blogListing.masonry('destroy');
		}
		
		
	});
	
	//sets up the masonry blog if required
	function SetUpBlogMasonry($blogListing){
		
		if($blogListing.length != 0){
			//set up masonry
			$blogListing.masonry({
				itemSelector: '.hentry',
				percentPosition: true,
				gutter: 20,
				resize: true,
			});	
		}
		
		
	}
	SetUpBlogMasonry($('.blog-listing.grid'));  
	
});
