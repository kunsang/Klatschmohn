(function ($) {
    
    $.fn.ThemeColorPicker = function() {
        var target = $(this);
        /*
        target.colorpicker().on('changeColor', function (event){
            target.find('input').val(event.color.toHex());
        });
        */
        target.colorpicker().on('show', function (event){
			//alert('1');
            //event.color.setColor('#ffffff');
            target.colorpicker( 'setValue', target.find('input').val() );
            //alert('2');
        });
        
        
        return this;   
    };    
    
}(jQuery));
