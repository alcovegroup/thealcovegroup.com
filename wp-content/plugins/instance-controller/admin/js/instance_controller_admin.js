jQuery( document ).ready(function() {
    console.log( "ready!" );
	jQuery( ".ic_ao_toggle" ).click(function() {
	  jQuery( "#ic_advanced_options" ).toggle( "slow", function() {
	    // Animation complete.
	  });
	});
});