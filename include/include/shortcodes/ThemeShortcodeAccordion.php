<?php
    
class ThemeShortcodeAccordion extends ThemeShortcode {
    
    public function tag() {
        return 'accordion';
    }    

    public function process($atts, $content=null) {
        return sprintf('<div class="accordion">%s</div>', trim(do_shortcode($content)));
    }
}    
    
?>