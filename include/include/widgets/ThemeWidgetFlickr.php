<?php

class ThemeWidgetFlickr extends ThemeWidget {

    var $slug = 'flickr';
    var $name = 'Flickr';
    var $sets = array(
                'description' => 'Displays Flickr Image Thumbnails',
                'classname' => 'widget_flickr'
            );
    
    function widget( $args, $instance ) {                          
        $title = $instance['title'];
        $flickr_uid = $instance['flickr_uid'];
        $images_count = $instance['images_count'];        
        $html = <<<EOT
<h3>$title</h3>
<div class="photo-stream" data-cols="$images_count" data-uid="$flickr_uid"></div>        
EOT;
        echo $args['before_widget'];
        echo $html;
        echo $args['after_widget'];
    }

    function getOptions() {
        $items = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6,
                  7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12);
        return array(
            'title' => array(
                'type' => 'edit',
                'text' => __r('Title'),
                'hint' => __r(''),
                'default' => __r('Photo Stream'),
            ),
            'flickr_uid' => array(
                'type' => 'edit',
                'text' => __r('Flickr User ID'),
                'hint' => __r(''),
                'default' => __r(''),
            ),
            'images_count' => array(
                'type' => 'dropdown',
                'text' => __r('Number of images to show (4 per row)'),
                'hint' => __r(''),
                'items' => $items,
                'default' => 8,
            ),                        
        );
    }    
}
?>