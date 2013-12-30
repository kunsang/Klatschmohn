<?php
    
class ThemeShortcodeGooglemap extends ThemeShortcode {
    public function tag() {
        return 'googlemap';
    }    

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'lat' => 0,
                'lng' => 0,
                'zoom' => 10,
                'title' => '',
            ), $atts));        
        return sprintf('<div class="google-map" data-lat="%s" data-lng="%s" data-zoom="%s" data-title="%s"></div>', $lat, $lng, $zoom, esc_attr($title));
    }
}    
    
?>