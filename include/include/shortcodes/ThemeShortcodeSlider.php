<?php
    
class ThemeShortcodeSlider extends ThemeShortcode {
    public function tag() {
        return 'slider';
    }    

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'gallery' => -1,
                'class' => '',
                'slides' => ''
            ), $atts));  
        $html = '';      
        if ($gallery != -1) {           
            $gallery = getFramework()->content->gallery->getData($gallery, $class);
            
            if ($gallery && is_array($gallery) && count($gallery) > 0) {
                $html .= sprintf('<div class="flexslider image-slider %s"><ul class="slides">', $class);
                foreach ($gallery as $image) {
			        $html .= sprintf('<li>%s</li>', $image['blog_img']);
                }
                $html .= '</ul></div>';
            }
        } else
        if ($slides) {
            $slides = explode(',', $slides);
            if (is_array($slides) && count($slides) > 0) {
                $html .= <<< EOT
<div class="flexslider-wrapper">
    <div class="container">
        <div id="main-slider" class="flexslider fullwidth">
            <ul class="slides">
EOT;
                foreach ($slides as $slide) {
                    $slide = intval(trim($slide));
                    if ($slide) {
                        $post = get_post($slide);
                        if ($post) {
                            $title = $post->post_title;
                            $content = do_shortcode($post->post_content);
                            $thumbnail = '';
                            if (($thumb_id = get_post_thumbnail_id($post->ID)) == true) {
                                $thumbnail = sprintf('<img src="%s" alt="" />', wp_get_attachment_url($thumb_id));
                            }
                            $html .= <<< EOT
<li>
    $thumbnail
    <div class="overlay"></div>
    <div class="flex-caption">
        <h3>$title</h3> <p>$content</p>
    </div>
</li>
EOT;
                        }
                    }
                }
                $html .= <<< EOT
            </ul>
        </div>
    </div>
</div>                  
EOT;
            }
        }
        return $html;
    }
}    
    
?>
