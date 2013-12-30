(function ($) {
    
    var rowtemplate = '\
    <div class="draggable-box">\
        <input name="{1}[]" type="hidden" value="{0}">\
        <strong>{0}</strong>\
        <a href="#" class="remove">remove</a>\
    </div>';
    
    $.fn.ThemeList = function() {
        var target = $(this);
        var dataname = target.attr("data-name");
        var dataid = target.attr("data-id");
        var datavalue = target.attr("data-value");
        var btn = target.find("button");
        var textbox = target.find("input[type=text]");
        var list = target.find("#{0}-list".format(dataid));
        var i = 0;        
        function addRow()
        {
            var value = textbox.val();
            textbox.val("");
            addValue(value);
            return false;
        }
        function addValue(val)
        {
            list.append(rowtemplate.format(val, dataname));
            return false;
        }        
        function removeRow()
        {
            $(this).parents('.draggable-box').remove();
            return false;
        }        
        btn.click(addRow);
        if (datavalue) 
        {
            var dataitems = JSON.parse(datavalue);
            if (typeof(dataitems) === "object") 
            {
                for (i = 0; i < dataitems.length; i++) 
                {                    
                    addValue(dataitems[i]);
                }
            }
        }
        list.delegate("a.remove", "click", removeRow);
        list.sortable({
            cursor: 'move',
            items: '> div'
        });
        list.disableSelection();
        return this;   
    };    
    
}(jQuery));