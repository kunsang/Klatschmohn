(function ($) {
    
    $.fn.ThemePopupcustom = function() {
        var target = this;        
        var id = target.attr("data-id");
        var holder = target.find('div[id={0}-holder]'.format(id));   
        var container = target.find('div[id={0}-container]'.format(id));   
        var hdn = target.find('input[type=hidden]');         
        $(window).resize(function() {
            if (container.dialog('isOpen'))
            {
                container.dialog('option', 'width', $(window).width() * 0.7);
                container.dialog('option', 'height', $(window).height() * 0.7);
            }
        });
        function click()
        {
            hdn.val($(this).html());
            holder.html($(this).html());
            container.dialog('close');
            return false;
        }
        holder.click(function(){
            container.dialog({
                width: $(window).width() * 0.7,
                height: $(window).height() * 0.7,
                modal: true,
                open: function(event, ui) {
                    $(event.target).dialog('widget')
                        .css({ position: 'fixed' })
                        .position({ my: 'center', at: 'center', of: window });
                }                
            });
        });
        holder.html(hdn.val());
        container.delegate('a.popupitem', 'click', click);
        return this;   
    };    
    
}(jQuery));