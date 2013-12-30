<?php
    
class ThemeShortcodeTestimonials extends ThemeShortcode {
    
    public function tag() {
        return 'testimonials';
    }
    
    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'count' => 10
            ), $atts));  
        $args = array(
            'post_type' => 'testimonial',
            'numberposts' => $count,
            'order' => 'DESC'
        );
        $html = '';
        $posts = get_posts($args);
        if ($posts) {
            $html .= <<< EOT
<div class="testimonial-wrapper">
	<div class="sc-testimonials testimonials-carousel clearfix">
	<ul class="slides">
EOT;
            foreach ($posts as $post) {
				$title     = $post->post_title;
				$company   = get_post_meta($post->ID, 'theme_metabox', true);
				$company   = trim($company['mb_testimonial']['company']);
				$thumbcode = '';
				$content   = $post->post_content;
				
				
                if (($thumb_id = get_post_thumbnail_id($post->ID)) == true) {
                    $thumburl     = wp_get_attachment_url($thumb_id);
                    $thumbsrc     = wp_get_attachment_image_src($thumb_id, 'thumbnail');
                    $thumbsrc_url = $thumbsrc[0];
                    $thumbcode    = '<div class="image-container"><img src="'.$thumbsrc_url.'" alt="'.$title.'" /></div>';
                }
				
				
				$html .= <<< EOT
	<li class="testimonial-item">
		<div class="testimonial-left">
			$thumbcode
			<h6 class="testimonial-title">$title</h6>
			<div class="testimonial-coname">$company</div>
		</div>
		<div class="testimonial-right">
			<div class="testimonial-content">$content</div>
		</div>
		
		<div class="overlay"></div>
	</li>
EOT;
            }
            $html .= <<< EOT
    </ul>
	</div>
</div>
EOT;
        }   
        return $html;
    }
}    
    
?>
