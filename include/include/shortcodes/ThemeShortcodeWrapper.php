<?php
    
class ThemeShortcodeWrapper extends ThemeShortcode {
    public function tag() {
        return 'wrapper';
    }    
    
    public static $social = array(
        'acrobat', 'yahoo', 'ycombinator', 'yelp', 'youtube',
    );

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'bgcolor' => '',
            ), $atts));
		
		$colors = array('grey');
		if( in_array($bgcolor, $colors) ){
			$col = $bgcolor;
		}
        $html  = '';
		$html .= '<div class="data-wrapper data-wrapper-'.$bgcolor.'">';
		$html .= '<div class="data-inner-wrapper container">';
		$html .= do_shortcode($content);
		$html .= '</div><!-- .data-inner-wrapper -->';
		$html .= '</div><!-- .data-wrapper -->';
		
        return $html;
    }
}    
    
?>