<?php

class ThemeMetaboxGallery extends ThemeMetabox  {
    public $id = 'mb_gallery';
    public $name = 'Gallery'; 
    
    public function getId() {
        return $this->id;
    }    
    
    function getOptions() {
        return array(
            'content' => array(
                'type' => 'uploader',
                'text' => __r('Upload Images for Gallery'),
                'hint' => __r('Upload images for gallery.'),
                'default' => ''
            ),
        );
    }
}

?>