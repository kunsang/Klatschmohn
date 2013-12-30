<?php
    
class ThemeShortcodeInfobox extends ThemeShortcode {
    public function tag() {
        return 'infobox';
    }    

    public function process($atts, $content=null) {
		/*
        extract(shortcode_atts(
            array(
                'lat' => 0,
                'lng' => 0,
                'zoom' => 10,
                'title' => '',
            ), $atts));        
        */
        return sprintf('<div class="infobox intro">%s</div>', do_shortcode($content) );
    }
}    
    
?>
