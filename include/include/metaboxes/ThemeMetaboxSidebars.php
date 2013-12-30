<?php

class ThemeMetaboxSidebars extends ThemeMetabox {
    public $id = 'mb_sidebars';
    public $name = 'Sidebars';
    
    public function getId() {
        return $this->id;
    }    
    
    function getOptions() {
        $items = array('' => 'No Sidebar');
        $items = array_merge($items, getFramework()->sidebars);
        reset($items);
        return array(
            'sidebar' => array(
                'type' => 'dropdown',
                'text' => __r('Sidebar'),
                'hint' => __r('Select sidebar for a page.'),
                'items' => $items,
                'default' => key($items)
            ),
        );          
    }
}

?>