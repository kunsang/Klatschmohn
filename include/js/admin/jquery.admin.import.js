(function ($) {
    
    $.fn.ThemeImport = function() 
    {
        var target = this;
        var id = target.attr('id');
        var progress = $('#{0}-progress'.format(id));
        var status = $('#{0}-status'.format(id));
        var timer = null;
                
        function get_progress()
        {            
            var params = {
                    action : 'action_import_demo_progress'
                };
            jQuery.post(
                ajaxurl,
                params,
                function (response) {     
                    if (response) {                        
                        var data = $.parseJSON(response);
                        status.html(data['message']);
                        progress.progressbar({value: data['progress']});
                        if (data['progress'] == 100)
                        {
                            clearInterval(timer);
                        }
                    } else
                    {
                        clearInterval(timer);
                    }
                }
            );
        }        
        target.click(function(){
            if (confirm(target.attr('data-msg')))
            {
                status.show();
                progress.show();
                progress.progressbar({value: 0});
                timer = setInterval(get_progress, 1500);
                var params = {
                        action : 'action_import_demo'
                    };
                jQuery.post(
                    ajaxurl,
                    params
                );                
            }
            return false;
        });
        return this;  
    };    
    
}(jQuery));
  