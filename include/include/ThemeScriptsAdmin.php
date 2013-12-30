<?php
    
class ThemeScriptsAdmin extends ThemeScripts {
        
    public function registerScripts() {
        // bootstrap
        $this->AddStyle('/include/css/bootstrap.css', 'theme_css_bootstrap');   
        $this->AddScript('/include/js/bootstrap.min.js', 'theme_bootstrap', array('jquery'));
        // bootstrap-colorpicker
        $this->AddStyle('/include/plugins/bootstrap-colorpicker/css/colorpicker.css');
        $this->AddScript('/include/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', 'theme_js_bootstrapcolorpicker', array('jquery', 'theme_bootstrap'));
        $this->AddScript('/include/js/admin/jquery.admin.colorpicker.js', 'theme_jquery_admin_colorpicker', array('jquery', 'theme_js_bootstrapcolorpicker'));
        //
        wp_enqueue_style('thickbox');
        $this->AddStyle('/include/css/framework.css', 'theme_css_framework');   
        $this->AddStyle('/include/css/custom.css', 'theme_css_custom');   
        $this->AddStyle('/include/css/theme.css', 'theme_css_theme');   
        $this->AddStyle('/include/css/font-awesome.css', 'theme_css_font_awesome');   
        $this->AddStyle('/include/css/jquery-ui/jquery-ui-1.10.0.custom.min.css', 'theme_css_jquery_ui_jquery_ui_1_10_0_custom_min');   
        $this->AddScript('/include/js/admin/jquery.admin.popupcustom.js', 'theme_jquery_admin_popupcustom', array('jquery', 'jquery-ui-dialog'));
        $this->AddScript('/include/js/admin/jquery.admin.dropdowncustom.js', 'theme_jquery_admin_dropdowncustom', array('jquery', 'jquery-ui-sortable'));
        $this->AddScript('/include/js/admin/jquery.admin.list.js', 'theme_jquery_admin_list', array('jquery'));
        $this->AddScript('/include/js/admin/jquery.admin.options.js', 'theme_jquery_admin_options', array('jquery'));
        $this->AddScript('/include/js/admin/jquery.admin.import.js', 'theme_jquery_admin_button', array('jquery', 'jquery-ui-progressbar'));
        $this->AddScript('/include/js/admin/jquery.admin.uploader.js', 'theme_jquery_admin_uploader', array('jquery', 'jquery-ui-sortable', 'plupload-all'));
        $this->AddScript('/include/js/admin/jquery.admin.mediaupload.js', 'theme_jquery_admin_mediaupload', array('jquery', 'media-upload', 'thickbox'));                
        $this->AddScript('/include/js/jquery.funcs.js', 'theme_jquery_funcs', array('jquery'));
    }
}
    
?>