// JavaScript Document


( function( window, $, undefined ) {
	'use strict';
 
	$( 'nav' ).before( '<button class="menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to menus
	$( 'nav .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to sub menus
	//added
 	$(".menu-toggle").each(function(index) {
    $(this).attr("id", this.id + 1 + index);
});
document.getElementById('10').style.display = "none";
//added
	// Show/hide the navigation
	$( '.menu-toggle, .sub-menu-toggle' ).on( 'click', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
 
		$this.toggleClass( 'activated' );
		$this.next( 'nav, .sub-menu' ).slideToggle( 'fast' );
 
	});
 
})( this, jQuery );