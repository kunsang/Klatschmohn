<?php
    
class ThemeShortcodeTabs extends ThemeShortcode {
    public function tag() {
        return 'tabs';
    }    

    public function process($atts, $content=null) {
        $this->content->data = array();
        $content = trim(do_shortcode($content));
        // Make items
        $items = '';
        for ($i = 0; $i < count($this->content->data); $i++) {
            $items .= sprintf('<li><a href="#tabs-%s">%s</a></li>', $i + 1, $this->content->data[$i]);
        }
        return sprintf('<div class="bordered tabs"><ul>%s</ul><div class="tabs-content-wrapper">%s</div></div>', $items, $content);
    }
}    
    
?>