<?php
    
class ThemeShortcodeStaffmembers extends ThemeShortcode {
    public function tag() {
        return 'staffmember';
    }    

    public function process($atts, $content=null) {
        global $post;
        extract(shortcode_atts(
            array(
                'id' => -1
            ), $atts));  
        $html = '';    
        if ($id != -1) {           
            $post = get_post($id);
            if ($post) {
                setup_postdata($post);                                
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