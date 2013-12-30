<?php
    
class ThemeShortcodeButton extends ThemeShortcode {
    public function tag() {
        return 'button';
    }    

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'url' => '#',
                'class' => 'yellow',
                'text' => '',
            ), $atts));        
            
        return $text ? sprintf('<a href="%s" class="button %s">%s</a>', $url, $class, $text) : '';
    }
}    
    
?>