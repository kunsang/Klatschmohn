<?php
    
class ThemeShortcodeColumns extends ThemeShortcode {  
    
    public static $columns = array(
        '1/2'  => 'one-half', 
        
        '1/3'  => 'one-third',
        '2/3'  => 'two-third',           
    
        '1/4'  => 'one-fourth',
        '2/4'  => 'one-half',
        '3/4'  => 'three-fourth',
        
        '1/5'  => 'one-fifth',
        '2/5'  => 'two-fifth',
        '3/5'  => 'three-fifth',
        '4/5'  => 'four-fifth',
        
        '1/6'  => 'one-sixth',
        '2/6'  => 'one-third',
        '3/6'  => 'one-half',
        '4/6'  => 'two-third',
        '5/6'  => 'five-sixth',
        
        'last' => 'column-last'
    );
    
    public function tag() {
        return 'column';
    }    
    
    public function process($atts, $content=null) {
        $html = '';
        if ($atts && isset($atts['class'])) {            
            $html = sprintf('<div class="%s">%s</div>', strtr($atts['class'], self::$columns), trim(do_shortcode($content)));
        }
        return $html;
    }
}    
    
?>