(function ($) {

	var $grid = $('.grid-moodboard').imagesLoaded( function() {
		$grid.isotope({
			itemSelector: '.moodboard',
			percentPosition: true,
			masonry: { }
		});
	});

	// init Isotope
	var $collection = $('.grid-collection').imagesLoaded( function() {
		$collection.isotope({
			itemSelector: '.collection',
			layoutMode: 'fitRows'
		});
	});

	// Filter items on button click
	$('.filter').on( 'click', 'button', function() {
		var filterValue = $(this).attr( 'data-filter' );
		$collection.isotope({ 
			filter: filterValue
		});
	});

})(jQuery);