/* jshint -W117 */
/* jshint -W098 */

(function( $ ) {

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
		        'featureType': 'landscape',
		        'stylers': [
		            {
		                'hue': '#FFBB00'
		            },
		            {
		                'saturation': 43.400000000000006
		            },
		            {
		                'lightness': 37.599999999999994
		            },
		            {
		                'gamma': 1
		            }
		        ]
		    },
		    {
		        'featureType': 'road.highway',
		        'stylers': [
		            {
		                'hue': '#FFC200'
		            },
		            {
		                'saturation': -61.8
		            },
		            {
		                'lightness': 45.599999999999994
		            },
		            {
		                'gamma': 1
		            }
		        ]
		    },
		    {
		        'featureType': 'road.arterial',
		        'stylers': [
		            {
		                'hue': '#FF0300'
		            },
		            {
		                'saturation': -100
		            },
		            {
		                'lightness': 51.19999999999999
		            },
		            {
		                'gamma': 1
		            }
		        ]
		    },
		    {
		        'featureType': 'road.local',
		        'stylers': [
		            {
		                'hue': '#FF0300'
		            },
		            {
		                'saturation': -100
		            },
		            {
		                'lightness': 52
		            },
		            {
		                'gamma': 1
		            }
		        ]
		    },
		    {
		        'featureType': 'water',
		        'stylers': [
		            {
		                'hue': '#0078FF'
		            },
		            {
		                'saturation': -13.200000000000003
		            },
		            {
		                'lightness': 2.4000000000000057
		            },
		            {
		                'gamma': 1
		            }
		        ]
		    },
		    {
		        'featureType': 'poi',
		        'stylers': [
		            {
		                'hue': '#00FF6A'
		            },
		            {
		                'saturation': -1.0989010989011234
		            },
		            {
		                'lightness': 11.200000000000017
		            },
		            {
		                'gamma': 1
		            }
		        ]
		    }
		]
	};

	// Create map.        	
	var map = new google.maps.Map( $el[0], args );

	// Add a markers reference.
	map.markers = [];

	// Add markers.
	$markers.each( function() {

		addMarker( $( this ), map );

	});

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
	var marker = new google.maps.Marker({
		position: latlng,
		map: map
	});

	// Add to array.
	map.markers.push( marker );

	// If marker contains HTML, add it to an infoWindow.
	if ( $marker.html() ) {

		// Create info window.
		var infowindow = new google.maps.InfoWindow({
			content: $marker.html()
		});

		// Show info window when marker is clicked.
		google.maps.event.addListener( marker, 'click', function() {

			infowindow.open( map, marker );

		});
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
	});

	// Only 1 marker?
	if ( 1 == map.markers.length ) {

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

$( document ).ready(function() {

	$( '.acf-map' ).each(function() {

		// Create map.
		map = newMap( $( this ) );

	});
});

})( jQuery );
