(function ($) {
    
    $.fn.ThemeUploader = function() 
    {
        var target = this;
        var input_id = target.attr('data-id');
        var input_name = target.attr('data-name');
        var post_id = target.attr('post-id');
        var config = $.parseJSON(target.attr("data-config"));
        var thumbs = $('#{0}-thumbs'.format(input_id));
        var params = {
                action : 'action_theme_gallery_fetch',
                post_id : post_id
            };
        jQuery.post(
            ajaxurl,
            params,
            function (response) {           
                var imgdata = $.parseJSON(response);                
                if (imgdata)
                {                    
                    var images = imgdata['images'];  
                    for (var i = 0; i < images.length; i++)
                    {
                        add_thumb(images[i]['thumbnail'], images[i]['post_id'], images[i]['hint']);
                    }
                }                
            }
        );
        
        function add_thumb(img, post_id, text)
        {
            var template = 
                '<div class="ui-sortable gallery-item">\
                    <p>{3}</p>\
                    <input type="text" name="{0}[{1}]" value="{2}">\
                    <div class="remove"><a href="#"><i class="icon-remove-sign"></i></a></div>\
                </div>';
            
            var element = $(template.format(input_name, post_id, text, img));
            thumbs.append(element);
            element.find('a').click(function() 
            {
                element.remove();
                return false;
            });
        }
       
        function init(up) {
        }
        function filesAdded(up, files) {
            $.each(files, function(i, file) {
                target.find('.filelist').append('<div class="file" id="{0}"><b>{1}</b> (<span>{2}</span>/{3}) <div class="fileprogress"></div></div>'.format(file.id, file.name, plupload.formatSize(0), plupload.formatSize(file.size)));
            });
            up.refresh();
            up.start();            
        }        
        function uploadProgress(up, file) {
            $('#{0} .fileprogress'.format(file.id)).width(file.percent + "%");
            $('#{0} span'.format(file.id)).html(plupload.formatSize(parseInt(file.size * file.percent / 100)));
        }        
        function fileUploaded(up, file, response) {
            $('#{0}'.format(file.id)).fadeOut();
            if (response.response) {
                response.response = $.parseJSON(response.response); 
                add_thumb(response.response['thumbnail'], response.response['post_id'], '');
            }
        }
                       
        var uploader = new plupload.Uploader(config);
        uploader.bind('Init', init);
        uploader.init();  
        uploader.bind('FilesAdded', filesAdded);
        uploader.bind('UploadProgress', uploadProgress);
        uploader.bind('FileUploaded', fileUploaded);
        thumbs.sortable({
            cursor: 'move',
            items: '> div'
        });
        return this;   
    };    
    
}(jQuery));
  