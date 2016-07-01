/* jshint -W117 */
/* jshint -W098 */

window.addEventListener( 'DOMContentLoaded', function() {
		var nav = responsiveNav( '.nav-collapse', {
		customToggle: 'menu-toggle', /* Selector: Specify the ID of a custom toggle. */
		closeOnNavClick: true, /* Boolean: Close the navigation when one of the links are clicked. */
		openPos: 'relative' /* String: Position of the opened nav, relative or static. */
	});
}, false );
