<?php
    
class ThemeShortcode {
    protected $content;

    public function __construct(&$content) {
        $this->content = $content;
        $tag = $this->tag();
        if ($tag) {
            add_shortcode($tag, array(&$this, 'process'));
        }        
    }
    
    public function tag() {
        return null;
    } 
}    
    
?>