<?php
    
class ThemeShortcodeProjects extends ThemeShortcode {
    
    public function tag() {
        return 'projects';
    }
    
    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'count' => 10,
				'title' => ''
            ), $atts));  
        $args = array(
            'post_type' => 'project',
            'numberposts' => $count,
            'order' => 'DESC'
        );
        $html = '';
        $posts = get_posts($args);
		
		if( $title!='' ){
			$html .= '<div class="sc-projects-wrapper sc-projects-with-title">';
			$html .= '<h3 class="sc-projects-title">'.$title.'</h3>';
		} else {
			$html .= '<div class="sc-projects-wrapper sc-projects-without-title">';
		}
		
		$nextPrevLinks = ( $count>4 ? '<div class="sc-projects-arrows"><a id="project-prev" class="jcarousel-prev" href="#"><i class="icon-chevron-left"></i></a>
    <a id="project-next" class="jcarousel-next" href="#"><i class="icon-chevron-right"></i></a></div>' : '' );
		
        if ($posts) {
            $html .= <<< EOT
<div class="project-carousel sc-projects clearfix">
    $nextPrevLinks
    <ul>            
EOT;
            foreach ($posts as $post) {
                if (($thumb_id = get_post_thumbnail_id($post->ID)) == true) {
                    $thumburl = wp_get_attachment_url($thumb_id);
                    $thumbsrc = wp_get_attachment_image_src($thumb_id, 'project-thumb');
                    
                    $thumbsrc_url = $thumbsrc[0];
                    
                    $ptitle = $post->post_title;
                    $permalink = get_permalink($post->ID);
                    $html .= <<< EOT
<li class="project-item">
    <img src="$thumbsrc_url" alt="" />
    <div class="overlay"></div>
    <div class="mask">
    // EDIT REMOVED CLASS
        <a href="$permalink" class="icon-image"><i class="icon-search"></i></a>
        <a href="$permalink" class="item-title">$ptitle</a>
    </div>
</li>                                
EOT;
                }
            }
            $html .= <<< EOT
    </ul>
</div>
</div><!-- .sc-projects-wrapper -->
EOT;
        }   
        return $html;
    }
}    
    
?>
