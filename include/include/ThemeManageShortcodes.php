<?php

class ThemeManageShortcodes {
    
    private $js;

    public function __construct() {                        
        $this->js = HONEY_URL_TO_THEME.'/include/js/jquery.shortcodes.js';
        // TinyMCE extension
        if (current_user_can('edit_posts') && current_user_can('edit_pages')) {  
            add_filter('mce_external_plugins', array(&$this, 'action_mce_external_plugins'));  
            add_filter('mce_buttons_3', array(&$this, 'action_mce_buttons_3'));  
            add_action('wp_ajax_action_shortcode_galleries', array($this, 'action_shortcode_galleries'));
            add_action('wp_ajax_action_shortcode_staffmember', array($this, 'action_shortcode_staffmember'));
            add_action('wp_ajax_action_shortcode_service', array($this, 'action_shortcode_service'));
            add_action('wp_ajax_action_shortcode_pricetable', array($this, 'action_shortcode_pricetable'));
            add_action('wp_ajax_action_shortcode_slides', array($this, 'action_shortcode_slides'));
        }       
    }
    
    public function action_mce_external_plugins($plugins) {
		$plugins['wrapper'] = $this->js;
        $plugins['staffmember'] = $this->js;
        $plugins['service'] = $this->js;
        $plugins['pricetable'] = $this->js;
        $plugins['accordion'] = $this->js;
        $plugins['tabs'] = $this->js;
        $plugins['button'] = $this->js;
        $plugins['col12'] = $this->js;
        $plugins['col13'] = $this->js;
        $plugins['col23'] = $this->js;
        $plugins['col14'] = $this->js;
        $plugins['col34'] = $this->js;
        // Do not use in editor
        //$plugins['pagetitle'] = $this->js;
        $plugins['progress'] = $this->js;
        $plugins['sep'] = $this->js;
        $plugins['infobox'] = $this->js;
        $plugins['logos'] = $this->js;
        $plugins['googlemap'] = $this->js;
        $plugins['projects'] = $this->js;
        $plugins['recentposts'] = $this->js;
        $plugins['imagesslider'] = $this->js;
        $plugins['slidesslider'] = $this->js;
		$plugins['calltoaction'] = $this->js;
        return $plugins;
    }
    
    public function action_mce_buttons_3($buttons) {
		$buttons[] = 'wrapper';
        $buttons[] = 'staffmember';
        $buttons[] = 'service';
        $buttons[] = 'pricetable';
        $buttons[] = 'accordion';
        $buttons[] = 'tabs';
        $buttons[] = 'button';
        $buttons[] = 'col12';
        $buttons[] = 'col13';
        $buttons[] = 'col23';
        $buttons[] = 'col14';
        $buttons[] = 'col34';
        // Do not use in editor
        //$buttons[] = 'pagetitle';
        $buttons[] = 'progress';
        $buttons[] = 'sep';
        $buttons[] = 'infobox';
        $buttons[] = 'logos';
        $buttons[] = 'googlemap';
        $buttons[] = 'projects';
        $buttons[] = 'recentposts';
        $buttons[] = 'imagesslider';
        $buttons[] = 'slidesslider';
		$buttons[] = 'calltoaction';
        return $buttons;
    }         
    
    public function action_shortcode_slides() {
        $args = array(
            'post_type' => 'slides',
            'numberposts' => 30,
            'order' => 'DESC'
        );        
        $posts = get_posts($args);
        $data = array();
        if ($posts) {
            foreach ($posts as $post) {     
                $data[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'thumbnail' => wp_get_attachment_image(get_post_thumbnail_id($post->ID), array(55, 55)),
                    'date' => get_the_time(get_option('date_format'), $post->ID),
                );       
            }
        }
        echo json_encode($data);
        die();
    }    
    
    public function action_shortcode_galleries() {
        $args = array(
            'post_type' => 'gallery',
            'numberposts' => 30,
            'order' => 'DESC'
        );        
        $posts = get_posts($args);
        $data = array();
        if ($posts) {
            foreach ($posts as $post) {
                $data[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'date' => get_the_time(get_option('date_format'), $post->ID),
                );       
            }
        }
        echo json_encode($data);
        die();        
    }
    
    public function action_shortcode_pricetable() {
        $args = array(
            'post_type' => 'pricetable',
            'numberposts' => 30,
            'order' => 'DESC'
        );        
        $posts = get_posts($args);
        $data = array();
        if ($posts) {
            foreach ($posts as $post) {
                $data[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'date' => get_the_time(get_option('date_format'), $post->ID),
                );       
            }
        }
        echo json_encode($data);
        die();
    }                                               
    
    public function action_shortcode_service() {
        $args = array(
            'post_type' => 'services',
            'numberposts' => 30,
            'order' => 'DESC'
        );        
        $posts = get_posts($args);
        $data = array();
        if ($posts) {
            $service = new ThemeMetaboxServices();
            foreach ($posts as $post) {     
                $meta = get_post_meta($post->ID, 'theme_metabox', true);
                $position = '';
                if ($meta && isset($meta[$service->getId()])) {
                    if (isset($meta[$service->getId()]['icon'])) {
                        $icon = $meta[$service->getId()]['icon'];
                    }
                }
                $data[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'icon' => $icon,
                    'date' => get_the_time(get_option('date_format'), $post->ID),
                );       
            }
        }
        echo json_encode($data);
        die();
    }                                       
    
    public function action_shortcode_staffmember() {
        $args = array(
            'post_type' => 'staffmembers',
            'numberposts' => 30,
            'order' => 'DESC'
        );        
        $posts = get_posts($args);
        $data = array();
        if ($posts) {
            $staff = new ThemeMetaboxStaffmembers();
            foreach ($posts as $post) {     
                $meta = get_post_meta($post->ID, 'theme_metabox', true);
                $position = '';
                if ($meta && isset($meta[$staff->getId()])) {
                    if (isset($meta[$staff->getId()]['position'])) {
                        $position = $meta[$staff->getId()]['position'];
                    }
                }
                $data[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'position' => $position,
                    'thumbnail' => wp_get_attachment_image(get_post_thumbnail_id($post->ID), array(55, 55)),
                    'date' => get_the_time(get_option('date_format'), $post->ID),
                );       
            }
        }
        echo json_encode($data);
        die();
    }
}

?>
