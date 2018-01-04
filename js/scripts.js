jQuery(document).ready(function($){

	// mobile menu style
	jQuery('.mobile_menu_button .triggerMobileMenu').click(function(){
		jQuery(this).toggleClass('open');
		var targetID = jQuery(this).data('toggle');
        jQuery('#'+targetID).toggleClass('is-open');
	});
	
}); // End of document.ready



/***************************************************
* FUNCTIONS
* **************************************************/
