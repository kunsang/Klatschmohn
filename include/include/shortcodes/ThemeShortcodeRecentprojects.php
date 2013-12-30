<?php
    
class ThemeShortcodeRecentprojects extends ThemeShortcode {
    
    public function tag() {
        return 'recentprojects';
    }
    
    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'columns' => 4,
                'count' => 4,
                'tags' => '',
            ), $atts));  
        $class = ThemeShortcodeColumns::$columns['1/'.$columns];
        $args = array(
            'post_type' => 'project',
            'numberposts' => $count,
            'order' => 'ASC',
            'tag' => $tags,
			'posts_per_page' => $count,
        );                    
        $html = '';
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $html .= '<div class="project-feed-alt clearfix">';
            while ($query->have_posts()) {
                $query->the_post();
                if (($thumb_id = get_post_thumbnail_id(get_the_ID())) == true) {
                    $thumb_url = wp_get_attachment_url($thumb_id);
                    $thumbsrc = wp_get_attachment_image_src($thumb_id, 'project-thumb');
                    $thumbsrc_url = $thumbsrc[0];
                    
                    $title = get_the_title();
                    $permalink = get_permalink();
                    $postterms = get_the_terms(get_the_ID(), 'txnm_project');
                    $posttermsarray = array();
                    $postslugsarray = array();
                    foreach ($postterms as $postterm) {
                        array_push($posttermsarray, $postterm->name);
                        array_push($postslugsarray, $postterm->slug);
                    }
                    $slugs = join(' ', $postslugsarray);
                    $terms = join(', ', $posttermsarray); 
                    $posthtml = <<< EOT
<div class="project-item $slugs">
    <div class="thumbnail">
        <a href="$permalink">
            <img src="$thumbsrc_url" alt="$title" />
        </a>
        <div class="overlay"></div>
        <div class="mask">
            <a href="$permalink" class="icon-image"><i class="icon-search"></i></a>
        </div>
    </div>
    <div class="thumb-item-title">
        <h6><a href="$permalink">$title</a></h6>
        <span>$terms</span>
    </div>  
</div>                
EOT;
                    $html .= do_shortcode(sprintf('[column class="1/%s"]%s[/column]', $columns.($query->current_post + 1 >= $query->post_count ? ' last' : ''), $posthtml));
                }                
            }   
            $html .= '</div>';         
        }
        return $html;
    }
}    
    
?>
