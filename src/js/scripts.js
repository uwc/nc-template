/* jshint -W117 */
/* jshint -W098 */
( function ( $ ) {

  $( document ).on( 'turbolinks:load', function () {

    // RESPONSIVE NAV //

    var nav = responsiveNav( '.navigation-links', {
      customToggle: 'js-menu',
      /* Selector: Specify the ID of a custom toggle. */
      navClass: 'navigation-links', // String: Default CSS class. If changed, you need to edit the CSS too!
      navActiveClass: '-navigation-open', // String: Class that is added to  element when nav is active
      openPos: 'relative' /* String: Position of the opened nav, relative or static. */
    } );

    // SMOOTHSCROLL //

    smoothScroll.init( {
      offset: 100
    } );

    // HEADROOM //

    // Grab an element.
    var hrBody = document.body;

    // Construct an instance of Headroom, passing the element.
    var headroom = new Headroom( hrBody, {

      // Vertical offset in px before element is first unpinned.
      offset: 64,

      // Scroll tolerance in px before state changes for up/down scroll.
      tolerance: {
        up: 10,
        down: 5
      }
    } );

    // Initialise.
    headroom.init();

    // SLICK LIGHTBOX //

    $( '.gallery' ).each( function () {
      $( this ).slickLightbox( {
        itemSelector: '> figure > div > a',
        caption: function ( element ) {
          return $( element ).parent().next().text();
        },
        captionPosition: 'bottom',
        useHistoryApi: true
      } );
    } );

    // CONTACT BUTTON //

    $( '#js-contact' ).on( 'click', function () {
      $( '#js-body' ).toggleClass( '-contact-open' );
    } );

    // SEARCH //

    $( '#js-search' ).on( 'click', function () {
      $( '#js-body' ).toggleClass( '-search-open' );

      function focusInput() {
        $( '.site-search' ).find( 'input' ).focus();
      }

      // Set timeout to accommodate for the fade in animation.
      setTimeout( focusInput, 300 );
    } );

    // Close everything on escape.
    $( document ).on( 'keyup', function ( e ) {
      if ( 27 === e.keyCode ) {
        $( '#js-body' ).removeClass( '-search-open' );
        $( '#js-body' ).removeClass( '-contact-open' );
      }
    } );

    // Shows a gradient bar at the top of the navigation to indicate that the page has loaded.
    $( '#js-body' ).addClass( '-turbolinks-loaded' );
  } );

  // Hides the gradient bar at the top of the navigation to allow the progress bar to show.
  $( document ).on( 'turbolinks:click', function () {
    $( '#js-body' ).removeClass( '-turbolinks-loaded' );
  } );

}( jQuery ) );
