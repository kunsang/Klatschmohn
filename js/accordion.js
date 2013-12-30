jQuery(document).ready(function() {
	jQuery('.accordion-tab').click(function() {
		jQuery('.accordion-tab').removeClass('on');
	 	jQuery('.accordion-content').slideUp('normal');
		if(jQuery(this).next().is(':hidden') == true) {
			jQuery(this).addClass('on');
			jQuery(this).next().slideDown('normal');
		 } 
	 });
	jQuery('.accordion-tab').mouseover(function() {
		jQuery(this).addClass('over');
	}).mouseout(function() {
		jQuery(this).removeClass('over');										
	});
	jQuery('.accordion-content').hide();
});