<?php
    
class ThemeShortcodeSeparator extends ThemeShortcode {
    
    public function tag() {
        return 'sep';
    }    
    
    public function process($atts, $content=null) {
        $html = '';
        if ($atts && isset($atts['height'])) {            
            $html = sprintf('<hr style="height: %spx">', $atts['height']);
        }
        return $html;
    }
}    
    
?>