<?php
    
class ThemeShortcodeTab extends ThemeShortcode {
    public function tag() {
        return 'tab';
    }
    
    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'title' => ''
            ), $atts));
        // Set shortcoce data
        array_push($this->content->data, $title);
        return sprintf('<div id="tabs-%s">%s</div>', count($this->content->data), trim(do_shortcode($content)));
    }
}    
    
?>