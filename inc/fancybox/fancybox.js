jQuery(function(){
	jQuery.fn.getTitle = function() {
		var arr = jQuery("a.fancybox");
		jQuery.each(arr, function() {
			var title = jQuery(this).children("img").attr("title");
			jQuery(this).attr('title',title);
		})
	}
	// Supported file extensions
	var thumbnails = 'a:has(img)[href$=".bmp"],a:has(img)[href$=".gif"],a:has(img)[href$=".jpg"],a:has(img)[href$=".jpeg"],a:has(img)[href$=".png"],a:has(img)[href$=".BMP"],a:has(img)[href$=".GIF"],a:has(img)[href$=".JPG"],a:has(img)[href$=".JPEG"],a:has(img)[href$=".PNG"]';
	jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();
	jQuery("a.fancybox").fancybox({
		'imageScale': true,
		'padding': 0,
		'zoomOpacity': true,
		'zoomSpeedIn': 500,
		'zoomSpeedOut': 500,
		'zoomSpeedChange': 300,
		'overlayShow': true,
		'overlayColor': "#ffffff",
		'overlayOpacity': 0.6,
		'enableEscapeButton': true,
		'showCloseButton': true,
		'hideOnOverlayClick': true,
		'hideOnContentClick': false,
		'centerOnScroll': true,
		'titleShow': false
		});
})