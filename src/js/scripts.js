/* jshint -W117 */
/* jshint -W098 */
(function( $ ) {

$( document ).on( 'turbolinks:load', function() {

	var nav = responsiveNav( '.nav-collapse', {
		customToggle: 'menu-toggle', /* Selector: Specify the ID of a custom toggle. */
		closeOnNavClick: true, /* Boolean: Close the navigation when one of the links are clicked. */
		openPos: 'relative' /* String: Position of the opened nav, relative or static. */
	});



	// Initialize and configure SmoothScroll.
	smoothScroll.init( { offset: 36 } );

	$( '.gallery' ).each( function() {
        $(this).slickLightbox( {
			itemSelector: '> figure > div > a',
			caption: function( element ) {
				return $( element ).parent().next().text();
			},
			captionPosition: 'bottom',
			useHistoryApi: true
		});
	});

	$( '#js-contact' ).on( 'click', function() {
		$( this ).parent().toggleClass( '-open' );
	});

	// Shows the gradient top border of the navigation bar to indicate that the page has loaded.
	$( '#js-navigation' ).addClass( '-loaded' );
});

// Hides the gradient top border of the navigation bar to allow the progress bar to show.
$( document ).on( 'turbolinks:click', function() {
	$( '#js-navigation' ).removeClass( '-loaded' );
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
