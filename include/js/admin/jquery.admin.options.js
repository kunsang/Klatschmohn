(function ($) {
    
    $.fn.ThemeOptions = function() 
    {
        var target = this;
        var btnsave = target.find('#save-changes');
        var btnreset = target.find('#reset-options');
        var spansaving = target.find('#save-changes-saving');
        var spansavedone = target.find('#save-changes-done');
        var spansaveerror = target.find('#save-changes-error');
        var timer = null;     
        var ajaxnonce = target.attr('data-nonce');
        btnreset.click(function(){   
            return confirm(btnreset.attr('data-msg'));
        });
        function finalize()
        {
            if (timer)
            {
                clearInterval(timer);
            }            
            spansavedone.hide();
            spansaveerror.hide();            
        }
        function click()
        {
            finalize();
            spansaving.fadeIn();
            jQuery.post(
                ajaxurl,
                {
                    action : 'action_theme_options_save',
                    nonce : ajaxnonce,
                    data : target.find('input, textarea, select').serialize()
                },
                function (response) {   
                    spansaving.hide();        
                    if (response)
                    {
                        spansavedone.fadeIn();
                    } else
                    {
                        spansaveerror.fadeIn();
                    }
                    timer = setInterval(finalize, 3000);
                }
            );            
            return false;
        }
        btnsave.click(click);
        return this;   
    };
    
    /*
    var hideborderdiv=["logo_font","logo_font_size","heading_font"];
	for (var i=0;i<hideborderdiv.length;i++){
		ele = $('#'+hideborderdiv[i]).attr('id');
		alert(ele);
		$('#'+hideborderdiv[i]).parent().css('display','none');
		//alert('#'+hideborderdiv[i]);
	}
    */
    
    
    
}(jQuery));
  
