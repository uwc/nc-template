/* jshint -W117 */
/* jshint -W098 */

( function( $ ) {

  /*
   *  This function will render a Google Map onto the selected jQuery element
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	4.3.0
   *
   *  @param	$el (jQuery element)
   *  @return	n/a
   */

  function newMap( $el ) {

    // Var.
    var $markers = $el.find( '.marker' );

    // Vars.
    var args = {
      zoom: 16,
      center: new google.maps.LatLng( 0, 0 ),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false,
      styles: [
        {
          'featureType': 'landscape.man_made',
          'elementType': 'all',
          'stylers': [
            {
              'color': '#faf5ed'
		            },
            {
              'lightness': '0'
		            },
            {
              'gamma': '1'
		            }
		        ]
		    },
        {
          'featureType': 'poi.park',
          'elementType': 'geometry.fill',
          'stylers': [
            {
              'color': '#bae5a6'
		            }
		        ]
		    },
        {
          'featureType': 'road',
          'elementType': 'all',
          'stylers': [
            {
              'weight': '1.00'
		            },
            {
              'gamma': '1.8'
		            },
            {
              'saturation': '0'
		            }
		        ]
		    },
        {
          'featureType': 'road',
          'elementType': 'geometry.fill',
          'stylers': [
            {
              'hue': '#ffb200'
		            }
		        ]
		    },
        {
          'featureType': 'road.arterial',
          'elementType': 'geometry.fill',
          'stylers': [
            {
              'lightness': '0'
		            },
            {
              'gamma': '1'
		            }
		        ]
		    },
        {
          'featureType': 'transit.station.airport',
          'elementType': 'all',
          'stylers': [
            {
              'hue': '#b000ff'
		            },
            {
              'saturation': '23'
		            },
            {
              'lightness': '-4'
		            },
            {
              'gamma': '0.80'
		            }
		        ]
		    },
        {
          'featureType': 'water',
          'elementType': 'all',
          'stylers': [
            {
              'color': '#a0daf2'
		            }
		        ]
		    }
		]
    };

    // Create map.
    var map = new google.maps.Map( $el[ 0 ], args );

    // Add a markers reference.
    map.markers = [];

    // Add markers.
    $markers.each( function() {

      addMarker( $( this ), map );

    } );

    // Center map.
    centerMap( map );

    // Return.
    return map;

  }

  /*
   *  This function will add a marker to the selected Google Map
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	4.3.0
   *
   *  @param	$marker (jQuery element)
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function addMarker( $marker, map ) {

    // Var.
    var latlng = new google.maps.LatLng( $marker.attr( 'data-lat' ), $marker.attr( 'data-lng' ) );

    // Create marker.
    var marker = new google.maps.Marker( {
      position: latlng,
      map: map
    } );

    // Add to array.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if ( $marker.html() ) {

      // Create info window.
      var infowindow = new google.maps.InfoWindow( {
        content: $marker.html()
      } );

      // Show info window when marker is clicked.
      google.maps.event.addListener( marker, 'click', function() {

        infowindow.open( map, marker );

      } );
    }

  }

  /*
   *  This function will center the map, showing all markers attached to this map
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	4.3.0
   *
   *  @param	map (Google Map object)
   *  @return	n/a
   */

  function centerMap( map ) {

    // Vars.
    var bounds = new google.maps.LatLngBounds();

    // Loop through all markers and create bounds.
    $.each( map.markers, function( i, marker ) {

      var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

      bounds.extend( latlng );
    } );

    // Only 1 marker?
    if ( 1 === map.markers.length ) {

      // Set center of map.
      map.setCenter( bounds.getCenter() );
      map.setZoom( 16 );
    } else {

      // Fit to bounds.
      map.fitBounds( bounds );
    }
  }

  /*
   *  This function will render each map when the document is ready (page has loaded)
   *
   *  @type	function
   *  @date	8/11/2013
   *  @since	5.0.0
   *
   *  @param	n/a
   *  @return	n/a
   */

  // Global var.
  var map = null;

  $( document ).ready( function() {

    $( '.acf-map' ).each( function() {

      // Create map.
      map = newMap( $( this ) );

    } );
  } );

} )( jQuery );
