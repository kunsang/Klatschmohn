<?php

class ThemeStyleSelector {
    public $settings;
   
    private function getDefaultSkin() {
        return $this->settings->colors[0]['css'];
    }
    
    private function isValidSkin($name) {
        foreach ($this->settings->colors as $color) {
            if ($color['css'] == $name) {
                return true;
            }
        }
        return false;
    }    
    
    private function getDefaultLayout() {
        return $this->settings->layouts['Boxed'];
    }    
    
    private function isValidLayout($name) {
        foreach ($this->settings->layouts as $type => $value) {
            if ($value == $name) {
                return true;
            }
        }
        return false;
    }
    
    private function isValidBackground($name) {
        return in_array($name, array(0, 1, 2, 3));
    }    
    
    private function getDefaultBackground() {
        return 0;
    }        
    
    private function isValidBgpattern($name) {
        return $name != '';
    }    
    
    private function getDefaultBgpattern() {
        return $this->settings->backgrounds[0]['url'];
    }    
    
    private function isValidBgimage($name) {
        return $name != '';
    }    
    
    private function getDefaultBgimage() {
        return '';
    }    
    
    public function __get($needle) {   
        $validator = 'isValid'.ucfirst($needle);     
        if (HONEY_THEME_DEVELOPMENT) {
            if (isset($_COOKIE[$needle])) {
                $value = $_COOKIE[$needle];
                if ($this->$validator($value)) {
                    return $value;
                }
            }
        }        
        // Check value in the settings   
        $value = $this->settings->$needle;
        if ($this->$validator($value)) {
            return $value;
        }
        $default = 'getDefault'.ucfirst($needle);
        return $this->$default();
    }
    
    public function __construct(&$settings) {
        $this->settings = &$settings;                
        if (HONEY_THEME_DEVELOPMENT) {            
            add_action('action_theme_style_selector', array(&$this, 'action_theme_style_selector'));
        }           
    }    
    
    public function action_theme_style_selector() {
        echo <<< EOT
<div id="style-selector">
    <div class="style-selector-wrapper">
 <div class="style-main-title">Style Selector</div>
        <div class="styleinner2">
		
		 <div class="styleinner">
            <h3>Predefined Color Skins</h3>            
			<ul class="styles">
EOT;
        foreach ($this->settings->colors as $color) {                        
            echo sprintf('<li><a href="#" class="%s %s" data-css="%s" data-save="%s" title="%s"></a></li>', $color['class'], ($this->skin == $color['css']) ? 'active' : '', $color['url'], $color['css'], $color['title']);
        }
        $layoutdef = $this->getDefaultLayout();
        echo <<< EOT
            </ul>
			 </div>
			 
			 
		<div class="styleinner">
            <h3>Layout Style</h3>
            <div class="layout">
                <select id="layout-selector" data-default="$layoutdef">
EOT;
        foreach ($this->settings->layouts as $name => $css) {            
            echo sprintf('<option value="%s/css/%s" %s data-save="%s">%s</option>', HONEY_URL_TO_THEME, $css, ($this->layout == $css) ? 'selected="selected"' : '', $css, $name);
        }
        $widelayout = ($this->settings->layouts['Wide'] == $this->layout) ? 'style="display: none;"' : '';
        echo <<< EOT
                </select>
            </div>
		</div>
			
			
			<div id="bg-pattern" $widelayout class="styleinner">
			    <div>
                <h3>Choose a Pattern</h3>
                <ul class="styles">
EOT;
        foreach ($this->settings->backgrounds as $background) {
            echo sprintf('<li><a href="#" %s data-save="%s" style="background: url(\'%s\');"></a></li>', ($this->background == 1 && $this->bgpattern == $background['url']) ? 'class="active"' : '', $background['url'], $background['url']);
        }
        echo <<< EOT
                </ul>
            </div>
			</div>
			
			
			<div id="bg-image" $widelayout class="styleinner">
            <div>
                <h3>Choose a Background</h3>
                 <ul class="styles">
EOT;
        foreach ($this->settings->patterns as $pattern)  {
            echo sprintf('<li><a href="#" %s data-save="%s"><img src="%s" alt="" /></a></li>', ($this->background == 2 && $this->bgimage == $pattern['urlfull']) ? 'class="active"' : '', $pattern['urlfull'], $pattern['url']);
        }
        echo <<< EOT
                </ul>
            </div>
       </div>
	   
	   <div class="styleinner">
            <div class="defaults">
                <a href="#">Reset to Defaults</a>
            </div>
		</div>	
			
        </div>
    </div>
    <a href="#" class="close icon-cogs"></a>  
</div>    
<script>
    jQuery(document).ready(function() {
        jQuery("#style-selector").ThemeStyleSelector();
    });
</script>
EOT;
    }
}
    
?>
