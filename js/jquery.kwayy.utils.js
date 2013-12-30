(function($){    
    $.fn.ThemeFocusing = function() {                
        var target = $(this);
        target.bind('focusin', function(){ 
            if($(this).val() == $(this).attr('default-value')) { 
                $(this).val(''); 
            } 
        });
        target.bind('focusout', function(){ 
            if($(this).val() == '') { 
                $(this).val( $(this).attr('default-value') ); 
            } 
        });
    }
})(jQuery);