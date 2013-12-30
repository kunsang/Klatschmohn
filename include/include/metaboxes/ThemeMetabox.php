<?php

class ThemeMetabox {    
    
    public $name = 'Price Table';      
    public $title;
    
    public function getId() {
        return '';
    }
    
    public function __construct()  {
        $this->title = HONEY_THEME_NAME.' - '.$this->name;
    }    
    
    function getOptions() {
        return array();
    }    
    
    public function getValue($data, $value) {
        if (isset($data[$value]))
        {
            return $data[$value];
        }
        return null;
    }        
    
    public function form() {
        global $post;
        $data = get_post_meta($post->ID, 'theme_metabox', true);
        $options = $this->getOptions();
        foreach($options as $key => $option) {
            $options[$key]['name'] = 'metabox['.$this->getId().']['.$key.']';
        }
        echo '<div id="framework-inc">';
        $elements = new ThemeElements($options, new ThemeSettings($data[$this->getId()]));
        echo $elements->render();
        echo '</div>';
    }
}

?>
