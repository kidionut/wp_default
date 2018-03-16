/*******************************************/
/**************** VENDORS ******************/
/*******************************************/
//
// Import Bootstrap 4 JS
//
// ! All js files are invluded
// ! You can comment what you dont want from vendor/bootstrap/_bootstrap.js file
@import '../src/js/vendors/_vendor.js'; 


/*******************************************/
/**************** Components ***************/
/*******************************************/
//
// Import Components
//
// If using jquery 1.9.1 or below import the components inside the ( function($) )
(function($) {
	@import '../src/js/vendors/_vendor.js'
	@import '../src/js/components/_components.js'
	
	$(document).ready(function(){

	});

	
})( jQuery );