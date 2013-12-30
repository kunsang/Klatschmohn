<?php
    
class ThemeShortcodeService extends ThemeShortcode {
    
    public function tag() {
        return 'service';
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
            //
            getFramework()->content->data = do_shortcode($content);
            //
            $post = get_post($id);
            if ($post) {
                setup_postdata($post);
                ob_start();
				if( $style == 'topicon' ){
					get_template_part('shortcode', $this->tag().'-topicon');
				} else {
					get_template_part('shortcode', $this->tag());
				}
                
                $html =& ob_get_contents();
                ob_end_clean();
                wp_reset_postdata();                            
            }
        }
        return $html;
    }
}    
    
?>