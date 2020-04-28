jQuery(document).ready(function ($) {

	$( '.menu-toggle' ).click( function() {
		$( '.nav' ).toggleClass( 'expand' );
	})

	$( 'a[rel="external"]' ).attr( 'target', '_blank' );

});