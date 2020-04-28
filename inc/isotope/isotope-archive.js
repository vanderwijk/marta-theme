(function ($) {

	// init Isotope
	var $grid = $('.grid').imagesLoaded( function() {
		$grid.isotope({
			itemSelector: '.collection',
			layoutMode: 'fitRows'
		});
	});

	// Filter items on button click
	$('.filter').on( 'click', 'button', function() {
		var filterValue = $(this).attr( 'data-filter' );
		$grid.isotope({ 
			filter: filterValue
		});
	});

})(jQuery);