<?php

class ThemeSettings {
    protected $settings;
    
    public function __construct(&$settings) {
        $this->settings = &$settings;
    }
    
    public function __get($key) {                                      
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }

    public function __set($key, $value) {
        $this->settings[$key] = $value;
    }        
}
    
?>