<?php

class ThemeMetaboxStaffmembers extends ThemeMetabox {
    public $id = 'mb_stuffmembers';
    public $name = 'Staff Members';
    
    public function getId() {
        return $this->id;
    }    
    
    function getOptions() {
        return array(
            'position' => array(
                'type' => 'edit',
                'text' => __r('Position'),
                'hint' => __r('Member position (eg: developer, president).'),
                'default' => __r('')
            ),
            'twitter' => array(
                'type' => 'edit',
                'text' => __r('Twitter'),
                'hint' => __r('Url of member\'s twitter account. Keep it empty to hide the link.'),
                'default' => ''
            ),
            'linkedin' => array(
                'type' => 'edit',
                'text' => __r('LinkedIn'),
                'hint' => __r('Url of member\'s linkedin account. Keep it empty to hide the link.'),
                'default' => ''
            ),
            'facebook' => array(
                'type' => 'edit',
                'text' => __r('Facebook'),
                'hint' => __r('Url of member\'s facebook account. Keep it empty to hide the link.'),
                'default' => ''
            ),                                    
        );          
    }
}

?>