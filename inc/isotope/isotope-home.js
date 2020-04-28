(function ($) {

	var $grid = $('.grid').imagesLoaded( function() {
		$grid.isotope({
			itemSelector: '.moodboard',
			percentPosition: true,
			masonry: { }
		});
	});

})(jQuery);