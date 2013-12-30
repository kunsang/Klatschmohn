<?php
    
class ThemeShortcodeAccordionitem extends ThemeShortcode {
    
    public function tag() {
        return 'accordionitem';
    }
    
    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'title' => ''
            ), $atts));  
        // Set shortcoce data
        $this->content->data = array(
            'title' => $title,
            'text' => trim(do_shortcode($content)),
        );
        ob_start();
        get_template_part('shortcode', $this->tag());
        $html =& ob_get_contents();
        ob_end_clean();            
        return $html;
    }
}    
    
?>
