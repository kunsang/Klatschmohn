<?php

class ThemeWidgetPosttabs extends ThemeWidget {

    var $slug = 'posttabs';
    var $name = 'Post Tabs';
    var $sets = array(
                'description' => 'Displays Recent and Popular Posts in Tabs',
                'classname' => 'pyre_tabs'
            );
    
    protected function printPosts($count, $orderby) {
        global $post;
        
        $posts = get_posts(
            array(
                'numberposts' => $count,
                'orderby' => $orderby,
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            )
        );        
        foreach ($posts as $post) {
            setup_postdata($post);
            $permalink = get_permalink();
            $excerpt = get_the_excerpt();
            $date = get_the_date(get_option('date_format'));
            $thumbnail = '';
            if (has_post_thumbnail()) {
                $excerpt = ThemeUtils::cutExcerpt($excerpt, 60);
                $thumbnail = sprintf('<a href="%s">%s</a>', $permalink, get_the_post_thumbnail(null, array(50, 50)));
            } else {
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
    }

    function widget( $args, $instance ) {        
        $title = $instance['title'];
        $rtitle = $instance['rtitle'];
        $ptitle = $instance['ptitle'];
        $count = intval($instance['count']);
        $count = $count > 0 ? $count : 3;
        echo $args['before_widget'];
        echo <<< EOT
<h3>$title</h3>
<div class="tabs">
    <ul>
        <li><a href="#tabs-1">$rtitle</a></li>
        <li><a href="#tabs-2">$ptitle</a></li>
    </ul>
    <div class="tabs-content-wrapper">
        <div id="tabs-1">
            <ul class="posts">
EOT;
        $this->printPosts($count, 'post_date');
        echo <<< EOT
    </ul>
</div>
<div id="tabs-2">
    <ul class="posts">
EOT;
        $this->printPosts($count, 'comments_count');
        echo <<< EOT
             </ul>
        </div>
    </div>
</div>    
EOT;
        echo $args['after_widget'];
    } 

    function getOptions() {
        return array(
            'title' => array(
                'type' => 'edit',
                'text' => __r('Title'),
                'hint' => __r(''),
                'default' => __r('Post Tabs'),
            ),
            'rtitle' => array(
                'type' => 'edit',
                'text' => __r('"Recent Tab" title'),
                'hint' => __r(''),
                'default' => __r('Recent'),
            ),            
            'ptitle' => array(
                'type' => 'edit',
                'text' => __r('"Popular Tab" title'),
                'hint' => __r(''),
                'default' => __r('Popular'),
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