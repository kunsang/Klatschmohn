(function ($) {
    var original_send_to_editor = window.send_to_editor;
    
    $.fn.ThemeMediaupload = function() 
    {
        var target = this;
        var input_id = target.attr('data-id');
        var hdn = target.find('input[id={0}]'.format(input_id));        
        var btnupload = target.find('input[id={0}-btnupload]'.format(input_id));
        var btnremove = target.find('input[id={0}-btnremove]'.format(input_id));
        var preview = target.find('img[id={0}-preview]'.format(input_id));        
        function setValue(val) {
            preview.attr('src', val);
            hdn.val(val);
            if (!val)
            {
                preview.hide();
            } else
            {
                preview.show();
            }
            return false;
        }        
        function sendToEditor(html, id) {
            window.send_to_editor = original_send_to_editor;
            html = $(html);
            var url = html.find("img").attr("src");
            tb_remove();
            setValue(url);
            return false;                        
        }         
        function click() {   
            original_send_to_editor = window.send_to_editor;
            window.send_to_editor = sendToEditor;    
            tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
            return false;
        }
        btnupload.click(click);
        function remove() {   
            setValue('');
            return false;
        }
        btnremove.click(remove);        
        if (hdn.val())
        {
            setValue(hdn.val());
        }
   
        return this; 
    };    
    
}(jQuery));
  