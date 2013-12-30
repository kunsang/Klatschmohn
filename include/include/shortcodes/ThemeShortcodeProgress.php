<?php
    
class ThemeShortcodeProgress extends ThemeShortcode {
    public function tag() {
        return 'progress';
    }    

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'title' => '',
                'percent' => 50
            ), $atts));  
        return sprintf('%s<div class="skillbar" data-perc="%s"><div class="skill-progress" style=""></div></div>', $title ? sprintf('<div class="skill-title">%s</div>', $title) : '', $percent);
    }
}    
    
?>