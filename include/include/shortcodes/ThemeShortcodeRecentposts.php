<?php

class ThemeShortcodeRecentposts extends ThemeShortcode {

    public function tag() {
        return 'recentposts';
    }

    public function process($atts, $content=null) {
        extract(shortcode_atts(
            array(
                'columns' => 2,
                'count' => 4,
                'categories' => '',
                'tags' => '',
                'excerpt' => 160,
            ), $atts));
        $args = array(
            'post_type' => 'post',
            'numberposts' => $count,
            'order' => 'DESC',
            'tag' => $tags,
            'category_name' => $categories,
            'posts_per_page' => $count,
        );
        $html = '';
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            $html .= '<div class="blog-feed clearfix">';
            while ($query->have_posts()) {
                $query->the_post();
                //
                $meta = new ThemeMetaboxFeaturedcontent();
                $thumnbail = $meta->get_content(get_the_ID(), 'blog-thumb');
                $title = get_the_title();
                $content = ThemeUtils::cutExcerpt(get_the_excerpt(), $excerpt);
                $date = get_the_time(get_option('date_format'));
                $comments = sprintf('%s %s', get_comments_number(), __r('Comments'));
                $permalink = get_permalink();
                $posthtml = <<< EOT
$thumnbail
<h5><a href="$permalink">$title</a></h5>
<div class="post-meta clearfix">
    <span class="date">$date</span>
    <span class="comments"><a href="$permalink">$comments</a></span>
</div>
<p>$content</p>
EOT;
                $calc = ($query->current_post+1) / $columns;
                $html .= do_shortcode(sprintf('[column class="1/%s"]%s[/column]', $columns.( floor($calc)==$calc || ($query->current_post + 1 >= $query->post_count) ? ' last' : ''), $posthtml));
            }
            $html .= '</div>';
        }
        return $html;
    }
}

?>
