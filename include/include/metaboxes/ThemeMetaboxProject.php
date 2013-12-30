<?php

class ThemeMetaboxProject extends ThemeMetabox {
    
    public $id = 'mb_project';
    public $name = 'Project'; 
    
    public function getId() {
        return $this->id;
    }
    
    function getOptions() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-portfolio.php',
        );        
        $portfolio = array(0 => '');
        $posts = get_pages($args);
        if ($posts) {
            foreach ($posts as $post) {   
                $portfolio[$post->ID] = sprintf('%s (%s)', $post->post_title, $post->ID);
            }
        }
        return array(
            'template' => array(
                'type' => 'dropdown',
                'text' => __r('Template'),
                'hint' => __r('Select the template for the project page.'),
                'items' => array('default' => __r('Default'), 'alternative' => __r('Alternative')),
                'default' => 'default',
            ),
            'portfolio' => array(
                'type' => 'dropdown',
                'text' => __r('Portfolio Link'),
                'hint' => __r('Select the portfolio page to which the portfolio button will point to.'),                
                'items' => $portfolio,
                'default' => '',
            ),
        );
    }
}

?>
