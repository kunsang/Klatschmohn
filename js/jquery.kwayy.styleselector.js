(function($){
	
	
	// Color Selector
	$(".color-yellow" ).click(function()		{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-yellow.css" ); });
	$(".color-blue" ).click(function()			{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-blue.css" );	});
	$(".color-cream" ).click(function()			{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-cream.css" ); });
	$(".color-darkgray" ).click(function()		{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-darkgray.css" ); });
	$(".color-green" ).click(function()			{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-green.css" ); });
	$(".color-lightgray" ).click(function()		{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-lightgray.css" ); });
	$(".color-orange" ).click(function()		{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-orange.css" ); });
	$(".color-pink" ).click(function()			{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-pink.css" ); });
	$(".color-red" ).click(function()			{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-red.css" ); });
	$(".color-tan" ).click(function()			{ $("#custom_style-css" ).attr("href", "/wp-content/themes/honey/css/colors/color-tan.css" ); });
	
	
	
    var css_skin = $('#theme_css_skin-css');
    var css_layout = $('#theme_css_layout-css');
    $.fn.ThemeStyleSelector = function() {        
        var target = $(this);
        function save(name, value){
            $.cookie(name, value);
        }        
        target.find('.styles').find('a').click(function(event){			
            event.preventDefault();
            css_skin.attr('href', $(this).attr('data-css'));
            $(this).parent().parent().find('a').removeClass('active');
            $(this).addClass('active');                            
            save('skin', $(this).attr('data-save'));
            return false;
        });     
        target.find('#layout-selector').on('change', function() {
            css_layout.attr('href', $(this).val());
            $(window).resize();
            target.find('#bg-image').toggle();
            target.find('#bg-pattern').toggle();
            for (var i = 0; i < googlemaps.length; i++)
            {
                google.maps.event.trigger(googlemaps[i], 'resize');
                googlemaps[i].setCenter(new google.maps.LatLng(34.021453, -118.785027)); 
            }
            save('layout', $(this).find('option:selected').attr('data-save'));
        });
        target.find('.defaults').click(function(){
            /*
            var skins = target.find('.styles').find('a');
            if (skins.length > 0)
            {
                $(skins[0]).trigger('click');
            }
            var layout = target.find('#layout-selector');
            var layoutval = layout.val();
            layout.val(layout.attr('data-default'));            
            if (layoutval != layout.val())
            {
                target.find('#bg-image').toggle();
                target.find('#bg-pattern').toggle();                            
            }
            $('body').removeClass('bg-cover');
            $('body').css('background-image', '');     
            target.find('#bg-pattern').find('a').removeClass('active');
            target.find('#bg-image').find('a').removeClass('active');
            */
            $.removeCookie('background');
            $.removeCookie('skin');
            $.removeCookie('layout');
            $.removeCookie('bgimage');
            $.removeCookie('bgpattern');
            location.reload();
            return false;
        })
        $(document).ready(function(){
            target.animate({
                left: '-200px'
            });            
        });        
        target.find('a.close').click(function(e){
            e.preventDefault();
            if (target.css('left') === '-200px') {
                target.animate({
                    left: '0'
                });
                $(this).removeClass('icon-chevron-right');
                $(this).addClass('icon-chevron-left');
            } else {
                target.animate({
                    left: '-200px'
                });
                $(this).removeClass('icon-chevron-left');
                $(this).addClass('icon-chevron-right');
            }
        });
        target.find('#bg-image').find('a').click(function(event){			
            event.preventDefault();
            $(this).parent().parent().find('a').removeClass('active');
            $(this).addClass('active');
            var bg = $(this).attr('data-save');
            $('body').addClass('bg-cover');            
            $('body').css('background-image', 'url("' + bg + '")');
            target.find('#bg-pattern').find('a').removeClass('active');            
            save('bgimage', bg);            
            save('background', 2);
        });
        target.find('#bg-pattern').find('a').click(function(event){
            event.preventDefault();
            $(this).parent().parent().find('a').removeClass('active');
            $(this).addClass('active');
            var bg = $(this).attr('data-save');
            $('body').removeClass('bg-cover');
            $('body').css('background-image', 'url("' + bg + '")');
            target.find('#bg-image').find('a').removeClass('active');
            save('bgpattern', bg);
            save('background', 1);
        });
    }
})(jQuery);