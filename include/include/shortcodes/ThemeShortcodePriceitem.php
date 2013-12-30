<?php
    
class ThemeShortcodePriceitem extends ThemeShortcode {
    
    protected static $styles = array(
        'labels'   => 'features-list',
        'starter' => 'level-one',
        'popular' => 'level-max',
    );
    
    public static function isLabels($style) {
        return $style == 'labels';
    }
    
    public static function isPopular($style) {
        return $style == 'popular';
    }    
    
    public static function getStyle($style) {
        foreach (self::$styles as $key => $value) {
            if ($key == $style) {
                return $value;
            }
        }
        return '';
    }
    
    public function tag() {
        return 'priceitem';
    }
    
    public function process($atts, $content=null) {
        global $post;
        extract(shortcode_atts(
            array(
                'id' => -1,
                'style' => ''
            ), $atts));  
        $html = '';      
        if ($id != -1) {           
            $post = get_post($id);
            if ($post) {
                setup_postdata($post);  
                // Set shortcoce data
                $this->content->data = array('style' => $style);
                ob_start();
                get_template_part('shortcode', $this->tag());
                $html =& ob_get_contents();
                ob_end_clean();
                wp_reset_postdata();                
            }            
        }
        return $html;
    }
}    
    
?>