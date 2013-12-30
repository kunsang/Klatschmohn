(function ($) {
    
    $.fn.ThemeDropdowncustom = function() {
        var target = this;        
        var id = target.attr("data-id");
        var hdn = target.find('input[type=hidden]');
        var ul = target.find('ul');
        var options = ul.find('li > a');
        options.on('click', function(){
            options.removeClass('selected');
            var item = $(this);
            hdn.val(item.attr('value'));
            
            
            //alert( $(this).parent().parent().prev().attr('name') );
            if( $(this).parent().parent().prev().attr('name') == 'skin' ){
				$('input[name="skincolor"]').val(item.attr('value'));
				$('.colorpickercustom').colorpicker('setValue', item.attr('value') );
				$('input[name="skincolor"]').next().children().css('background-color',item.attr('value'));
				//$("#skincolor-div").colorpicker.setColor( item.attr('value') );
			} else {
				item.addClass('selected');
			}
            
            
            
            return false;
        });        
        var i;
        var found = false;
        for (i = 0; i < options.length; i++)
        {
            var item = $(options[i]);
            if (hdn.val() == item.attr('value'))
            {
                item.addClass('selected');
                found = true;
                break;
            }
        }
        return this;   
    };    
    
}(jQuery));
