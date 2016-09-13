/* jshint -W117 */
/* jshint -W098 */
(function( $ ) {

$( document ).on( 'turbolinks:load', function() {
	var nav = responsiveNav( '.nav-collapse', {
		customToggle: 'menu-toggle', /* Selector: Specify the ID of a custom toggle. */
		closeOnNavClick: true, /* Boolean: Close the navigation when one of the links are clicked. */
		openPos: 'relative' /* String: Position of the opened nav, relative or static. */
	});

	smoothScroll.init( { offset: 36 } );

	$( '.gallery' ).slickLightbox( {
		itemSelector: '> figure > div > a',
		caption: function( element ) {
			return $( element ).parent().next().text();
		},
		captionPosition: 'bottom',
		useHistoryApi: true
	});
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
