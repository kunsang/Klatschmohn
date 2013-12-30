<?php
    
class ThemeShortcodeLogos extends ThemeShortcode {
    
    public function tag() {
        return 'logos';
    }    

    public function process($atts, $content=null) {
        global $post;
        extract(shortcode_atts(
            array(
                'id' => -1
            ), $atts));  
        $html = '';      
        if ($id != -1) {           
            $gallery = getFramework()->content->gallery->getData($id);
            if ($gallery && is_array($gallery) && count($gallery) > 0) {
                $cols = min(count($gallery), 8);
                $html .= '<ul class="logo-list clearfix">';
                for ($i = 0; $i < $cols; $i++) {
                    $image = $gallery[$i];
                    // EDIT CHANGED COLUMNS
                    $class = ThemeShortcodeColumns::$columns['1/4'];
                    if ($i == ($cols - 1)) {
                        $class .= ' '.ThemeShortcodeColumns::$columns['last'];
                    }
                    $html .= sprintf('<li class="%s"><a href="%s"><img src="%s" alt="" /></a></li>', $class, $image['hint'], $image['url']);
                }
                $html .= '</ul>';
            }
        }
        return $html;
    }
}    
    
?>
