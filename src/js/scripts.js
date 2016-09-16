/* jshint -W117 */
/* jshint -W098 */
(function( $ ) {

$( document ).on( 'turbolinks:load', function() {

	// RESPONSIVE NAV //

	var nav = responsiveNav( '.nav-collapse', {
		customToggle: 'js-menu', /* Selector: Specify the ID of a custom toggle. */
		closeOnNavClick: true, /* Boolean: Close the navigation when one of the links are clicked. */
		openPos: 'relative' /* String: Position of the opened nav, relative or static. */
	});

	// SMOOTHSCROLL //

	smoothScroll.init( { offset: 36 } );

	// HEADROOM //

	// Grab an element.
	var hrBody = document.body;

	// Construct an instance of Headroom, passing the element.
	var headroom  = new Headroom( hrBody, {

	    // Vertical offset in px before element is first unpinned.
	    offset: 64,

	    // Scroll tolerance in px before state changes for up/down scroll.
	    tolerance: {
	        up: 10,
	        down: 5
	    }
	});

	// Initialise.
	headroom.init();

	// SLICK LIGHTBOX //

	$( '.gallery' ).each( function() {
        $( this ).slickLightbox( {
			itemSelector: '> figure > div > a',
			caption: function( element ) {
				return $( element ).parent().next().text();
			},
			captionPosition: 'bottom',
			useHistoryApi: true
		});
	});

	// CONTACT BUTTON //

	$( '#js-contact' ).on( 'click', function() {
		$( '#js-body' ).toggleClass( '-contact-open' );
	});

	// SEARCH //

	$( '#js-search' ).on( 'click', function() {
		$( '#js-body' ).toggleClass( '-search-open' );
		$( '.site-search' ).find( 'input' ).focus();
	});

	// Shows a gradient bar at the top of the navigation to indicate that the page has loaded.
	$( '#js-body' ).addClass( '-turbolinks-loaded' );
});

// Hides the gradient bar at the top of the navigation to allow the progress bar to show.
$( document ).on( 'turbolinks:click', function() {
	$( '#js-body' ).removeClass( '-turbolinks-loaded' );
});

// Open and close the search in the navigation bar.
function search() {
  $( '#js-navigation' ).toggleClass( 'js-search' );
  return false;
}

$( '#js-search' ).on( 'click', function( element ) {
	element.preventDefault();
	search();

	// $('#form1_q').focus();
});

})( jQuery );
