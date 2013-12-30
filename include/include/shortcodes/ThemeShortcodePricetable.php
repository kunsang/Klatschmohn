<?php
    
class ThemeShortcodePricetable extends ThemeShortcode {
    
    protected $columns = array(
        'extended' => array(
            1 => 'one-cols', 
            2 => 'one-cols', 
            3 => 'two-cols', 
            4 => 'three-cols', 
            5 => 'four-cols', 
            6 => 'five-cols', 
        ),
        'simple' => array(
            1 => 'one-cols', 
            2 => 'two-cols', 
            3 => 'three-cols', 
            4 => 'four-cols', 
            5 => 'five-cols', 
        ),
    );
    
    public function tag() {
        return 'pricetable';
    }    
    
    public function process($atts, $content=null) {
        global $post;
        extract(shortcode_atts(
            array(
                'type' => 'extended',
                'columns' => 0
            ), $atts));  
        $html = '';  
        if ($columns >= 1 && $columns <= 6) {
            $html = sprintf('<div class="pricing-table-%s %s clearfix">%s</div>', $type, $this->columns[$type][$columns], trim(do_shortcode($content)));
        }
        return $html;
    }
}    
    
?>