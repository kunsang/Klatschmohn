<?php

class ThemeMetaboxPortfolio extends ThemeMetabox {
    public $id = 'mb_portfolio';
    public $name = 'Portfolio'; 
    
    public function getId() {
        return $this->id;
    }    
    
    function getOptions() {
        return array(
            'columns' => array(
                'type' => 'dropdown',
                'text' => __r('Columns Layout'),
                'hint' => __r('Specify columns layout for the portfolio.'),
                'items' => array(
                    '2' => '2 Columns',
                    '3' => '3 Columns',
                    '4' => '4 Columns',
                    'A' => 'Alternative',
                ),
                'default' => '2',
            ),
            'countperpage' => array(
                'type' => 'edit',
                'text' => __r('Projects on the page'),
                'hint' => __r('Enter the maximum number of projects to be shown on page.'),
                'default' => 12,
            ),            
            'sorting' => array(
                'type' => 'dropdown',
                'text' => __r('Select the sorting method for shown projects by date'),
                'hint' => __r('Possible values are DESC (show from newer to older) and ASC (show from older to newer).'),
                'items' => array(0 => 'DESC', 1 => 'ASC'),
                'default' => 0,
            ),            
            'tagsbar' => array(
                'type' => 'checkbox',
                'text' => __r('Show Tags Bar'),
                'hint' => __r('Deternies if you would like to show a bar with the tags at the top of the page.'),
                'default' => true,
            ),            
        );          
    }    
}

?>