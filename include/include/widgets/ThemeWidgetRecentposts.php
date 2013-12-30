<?php

class ThemeWidgetRecentposts extends ThemeWidget {

    var $slug = 'recentposts';
    var $name = 'Recent Posts';
    var $sets = array(
                'description' => 'Displays Recent Posts',
                'classname' => 'widget_recent_entries'
            );

    function widget( $args, $instance ) {
        $title = $instance['title'];
        $count = intval($instance['count']);
        $count = $count > 0 ? $count : 3;
        $posts = get_posts(
            array(
                'numberposts' => $count,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            )
        );
        echo $args['before_widget'];
        echo "<h3>$title</h3>";
        echo '<ul class="posts">';
        global $post;
        foreach ($posts as $post)
        {
            setup_postdata($post);
            $permalink = get_permalink();
            $excerpt = get_the_excerpt();
            $date = get_the_date(get_option('date_format'));
            $thumbnail = '';
            if (has_post_thumbnail())
            {
                $excerpt = ThemeUtils::cutExcerpt($excerpt, 60);
                $thumbnail = sprintf('<a href="%s">%s</a>', $permalink, get_the_post_thumbnail(null, array(50, 50)));
            } else
            {
                $excerpt = ThemeUtils::cutExcerpt($excerpt, 100);
            }
            echo <<< EOT
<li>
    $thumbnail
    <div class="entry">
       <a href="$permalink">$excerpt</a>
       <span class="date">$date</span>
    </div>
</li>
EOT;
            wp_reset_postdata();
        }
        echo '</ul>';
        echo $args['after_widget'];
    }

    function getOptions() {
        return array(
            'title' => array(
                'type' => 'edit',
                'text' => __r('Title'),
                'hint' => __r(''),
                'default' => __r('Recent Posts'),
            ),
            'count' => array(
                'type' => 'edit',
                'text' => __r('Number of post to show'),
                'hint' => __r(''),
                'default' => '3',
            ),                        
        );  
    } 
}
?>