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
                'hint' => __r(''),
                'default' => __r('')
            ),
            'twitter' => array(
                'type' => 'edit',
                'text' => __r('Telefon'),
                'hint' => __r(''),
                'default' => ''
            ),
            'linkedin' => array(
                'type' => 'edit',
                'text' => __r('E-Mail'),
                'hint' => __r(''),
                'default' => ''
            ),
            // 'facebook' => array(
            //     'type' => 'edit',
            //     'text' => __r('Facebook'),
            //     'hint' => __r('Url of member\'s facebook account. Keep it empty to hide the link.'),
            //     'default' => ''
            // ),
        );
    }
}

?>