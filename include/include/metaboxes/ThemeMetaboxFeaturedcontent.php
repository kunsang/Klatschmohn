<?php

class ThemeMetaboxFeaturedcontent extends ThemeMetabox {
    public $id = 'mb_featuredcontent';
    public $name = 'Featured Content';

    public function getId() {
        return $this->id;
    }

    private function plain_thumbnail($post_id, $class='') {
        $html = '';

		$imgSize = '';
		if($class!=''){
			$imgSize = $class;
		}

		if ( has_post_thumbnail( $post_id ) ) {
			$html .= '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title($post_id) ) . '">';
			$html .= get_the_post_thumbnail($post_id, $imgSize);
			$html .= '</a>';
		}

        return $html;
    }

    public function get_content($post_id, $class = 'project-slide-2x') {
        $html = '';
        $data = get_post_meta($post_id, 'theme_metabox', true);
        // Check if the data of current metabox exists
        if (isset($data[$this->getId()])) {
            $data = $data[$this->getId()];
            switch ($this->getValue($data, 'type')) {
                default:
                case 0: {
                    $html .= $this->plain_thumbnail($post_id, $class);
                    break;
                }
                case 1: {
                    $html .= do_shortcode(sprintf('[slider gallery="%s" class="%s"]', $this->getValue($data, 'slider'), $class));
                    break;
                }
                case 2: {
                    $html .= '<div class="video">'.$this->getValue($data, 'html').'</div>';
                    break;
                }
            }
        } else {
            $html .= $this->plain_thumbnail($post_id);
        }
        return $html;
    }

    public function content($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        echo $this->get_content($post_id);
    }

    function getOptions() {
        // Get posts
        $args = array(
            'post_type' => 'gallery',
            'numberposts' => -1,
            'order' => 'DESC'
        );
        $items = array();
        $posts = get_posts($args);
        if ($posts) {
            foreach ($posts as $p) {
                $items[$p->ID] = $p->post_title;
            }
        }
        return array(
            'type' => array(
                'type' => 'radiolist',
                'text' => __r('Featured Content'),
                'hint' => __r('Specify the featured content that will be displaied except featured image.'),
                'items' => array(
                    0 => __r('Featured Image'),
                    1 => __r('Slider'),
                    2 => __r('Video (Custom HTML)'),
                ),
                'default' => 0,
            ),
            'slider' => array(
                'type' => 'dropdown',
                'text' => __r('Select the Gallery'),
                'hint' => __r('Select the gallery which images to show.'),
                'items' => $items,
            ),
            'html' => array(
                'type' => 'text',
                'text' => __r('Video (Custom HTML)'),
                'hint' => __r('Enter the html version of the youtube/vimeo video, or any other custom html content.'),
                'default' => '',
            ),
        );
    }
}

?>
