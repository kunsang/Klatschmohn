<?php

class ThemeMetaboxPricetable extends ThemeMetabox {
    public $id = 'mb_pricetable';
    public $name = 'Price Table';
    
    public function getId() {
        return $this->id;
    }    
    
    function getOptions() {
        return array(
            'title' => array(
                'type' => 'edit',
                'text' => __r('Title'),
                'hint' => __r('Column title (eg: Single License, Trial Verson).'),
                'default' => __r('')
            ),
            'price' => array(
                'type' => 'edit',
                'text' => __r('Price'),
                'hint' => __r('Item price. Enter the price in digits (eg: $199)'),
                'default' => '',
            ),
            'pricetext' => array(
                'type' => 'edit',
                'text' => __r('Price Text'),
                'hint' => __r('Item price text. Additional text to be displayed near with the item price (eg: per month, per one item)'),
                'default' => '',
            ),                        
            'pricehint' => array(
                'type' => 'text',
                'text' => __r('Price Hint'),
                'hint' => __r('Item price hint content, can be html.'),
                'default' => '',
            ),
            'features' => array(
                'type' => 'list',
                'text' => __r('Features'),
                'hint' => __r('Features of the currect column (price item).'),
                'default' => array(),
            ),
            'btntext' => array(
                'type' => 'edit',
                'text' => __r('Button Text'),
                'hint' => __r('Specify the text of the item button.'),
                'default' => __r('Order')
            ),                         
            'btnurl' => array(
                'type' => 'edit',
                'text' => __r('Button Url'),
                'hint' => __r('Url assigned to an item button.'),
                'default' => '#'
            ),
        );          
    }
}

?>