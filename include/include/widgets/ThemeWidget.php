<?php

class ThemeWidget extends WP_Widget {
    
    var $slug;
    var $name;
    var $sets;
     
    public function __construct() {
        parent::__construct(HONEY_THEME_NAME.'_'.$this->slug, HONEY_THEME_NAME.' - '.$this->name, $this->sets);
    }
        
    function update( $new_instance, $old_instance )  {
        return array_merge($old_instance, $new_instance);
    }
    
    function getOptions() {
        return array();
    }
    
    private function templateEdit($name, $id, $data, $value) {        
        $hint = isset($data['hint']) ? $data['hint'] : '';
        return <<< EOT
<p>
    <label for="$id">{$data['text']}</label>
    <input class="widefat" id="$id" name="$name" type="text" value="$value" />
    $hint
</p>
EOT;
    }
    
    private function templateDropdown($name, $id, $data, $value) {     
        $items = '';
        $hint = isset($data['hint']) ? $data['hint'] : '';
        foreach($data['items'] as $key => $itemname) {
            $items .= sprintf('<option value="%s" %s>%s</option>', $key, $key == $value ? 'selected="selected"' : '', $itemname);
        }
        return <<< EOT
<p>
    <label for="$id">{$data['text']}</label>    
    <select class="widefat" id="$id" name="$name">
$items
    </select>   
    $hint 
</p>
EOT;
    }    

    function form($instance)  {        
        $html = '';
        // Output admin widget options form
        $options = $this->getOptions();
        foreach($options as $key => $option) {
            $type = 'template'.ucfirst($option['type']);
            $html .= $this->$type($this->get_field_name($key), $this->get_field_id($key), $option, isset($instance[$key]) ? $instance[$key] : $option['default']);
        }
        echo $html;
    }        
}
?>
