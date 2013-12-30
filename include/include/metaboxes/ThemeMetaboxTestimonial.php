<?php

class ThemeMetaboxTestimonial extends ThemeMetabox {
    public $id = 'mb_testimonial';
    public $name = 'Details';
    
    public function getId() {
        return $this->id;
    }
    
    function getOptions() {
        return array(
            'company' => array(
                'type' => 'edit',
                'text' => __r('Company Name'),
                'hint' => __r('Insert company name so it will appear below the reviewer\'s name'),
                'default' => ''
            ),
		);          
	}
}

?>