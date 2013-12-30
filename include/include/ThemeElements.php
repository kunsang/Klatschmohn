<?php





class ThemeElements {
    protected $options;
    protected $settings;
    protected $fontsizes = '';
    
    protected $standardfonts = array(
        'Arial,Helvetica,sans-serif' => 'Arial,Helvetica,sans-serif',
        '\'Arial Black\',Gadget,sans-serif' => '\'Arial Black\',Gadget,sans-serif',
        '\'Comic Sans MS\',cursive' => '\'Comic Sans MS\',cursive',
        '\'Courier New\', monospace' => '\'Courier New\', monospace',
        'Georgia, serif' => 'Georgia, serif',
        'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
        '\'Lucida Console\', Monaco, monospace' => '\'Lucida Console\', Monaco, monospace',
        '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif' => '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif',
        '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif' => '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif',
        'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
        '\'Times New Roman\', Times, serif' => '\'Times New Roman\', Times, serif',
        '\'Trebuchet MS\', Helvetica, sans-serif' => '\'Trebuchet MS\', Helvetica, sans-serif',
        'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
        '\'MS Sans Serif\', Geneva, sans-serif' => '\'MS Sans Serif\', Geneva, sans-serif',
        '\'MS Serif\', \'New York\', sans-serif' => '\'MS Serif\', \'New York\', sans-serif',
    );
    
    //global $googlefonts;
    
    public function __construct(&$options, &$settings = null) {
        $this->options = &$options;
        $this->settings = &$settings;
        // Font size items
        //$this->fontsizes = array('' => 'Default');
        $this->fontsizes = array();
        $fontsizes = range(8, 60);
        foreach ($fontsizes as $fontsize) {
            $this->fontsizes[$fontsize] = $fontsize.' px';
        }
    }
    
    protected function getValue($key, $options) {    
        $res = isset($options['default']) ? $options['default'] : null;
        if ($this->settings) {
            if ($this->settings->$key !== null) {
                $res = $this->settings->$key;
            }
        }
        return $res;
    }
    
    protected function templateFont($key, $options)
    {        
        $text = $options['text'];
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        
        // Font size
        $fontsizes = '';
        $default = is_array($value) && isset($value['size']) ? $value['size'] : '';
        foreach ($this->fontsizes as $fontsize => $fontsizetext) {
			$fontsizes .= sprintf('<option %s value="%s">%s</option>', $default == $fontsize ? 'selected="selected"' : '', $fontsize, $fontsizetext);
        }
        
        // Font Family
        $default = is_array($value) && isset($value['family']) ? $value['family'] : '';
        $fontfamilies = '<optgroup label="Standard Fonts">';
        foreach ($this->standardfonts as $font) {
            $fontfamilies .= sprintf('<option %s value="%s">%s</option>', $default == $font ? 'selected="selected"' : '', $font, $font);
        }                
        $fontfamilies .= '</optgroup>';
        $fontfamilies .= '<optgroup label="Google Fonts">';
        global $googlefonts;
        foreach ($googlefonts as $font) {
            $fontfamilies .= sprintf('<option %s value="%s">%s</option>', $default == $font ? 'selected="selected"' : '', $font, $font);
        }                        
        $fontfamilies .= '</optgroup>';
        // Font Color
        $fontcolor = is_array($value) && isset($value['color']) ? $value['color'] : '';
        // Option hint
        $hint = $options['hint'];
        
        
        // Show/Hide font size
        if(isset($options['hidesize']) && $options['hidesize']==true ){
			$fontsize = '';
		} else {
			$fontsize = '
				<div>
					<div class="span3"><strong>Font Size</strong></div>
					<div class="span9"><select id="'.$id.'-size" name="'.$name.'[size]">'.$fontsizes.'</select></div>
				</div>';
		}
		
		
		// Show/Hide font color
        if(isset($options['hidecolor']) && $options['hidecolor']==true ){
			$fontcolor = '';
		} else {
			$fontcolor = '
				<div>
					<div class="span3"><strong>Font Color</strong></div>
					<div class="span9">
						
						<div class="control">
							<div class="input-append color" data-color="'.$fontcolor.'" id="'.$id.'-div">
								<input id="'.$id.'-color" name="'.$name.'[color]" type="text" value="'.$fontcolor.'">
								<span class="add-on"><i></i></span>
							</div>                    
						</div>

						<script>
							jQuery("#'.$id.'-div").ThemeColorPicker();
						</script>
					</div>
				</div>';
		}
		
		
        
        
        $html = <<< EOT
        
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">



				<div>
					<div class="span3"><strong>Font Family</strong></div>
					<div class="span9"><select id="$id-family" name="{$name}[family]">$fontfamilies</select></div>
				</div>
				
				$fontsize
				
				$fontcolor
				
            </div>
        </div>
    </div>
</div>

        
        
        
        
        


EOT;
        return $html;
    }    
    
    protected function templateColor($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        // Escape string
        $value = is_string($value) ? esc_attr($value) : $value; 
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <div class="input-append color" data-color="$value" id="$id-div">
                    <input id="$id" name="$name" type="text" value="$value">
                    <span class="add-on"><i></i></span>
                </div>                    
            </div>
        </div>
    </div>
</div>
<script>
    jQuery("#$id-div").ThemeColorPicker();
</script>
EOT;
        return $html;
    }    
    
    protected function templateDropDownCustom($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // Generate items
        $value = esc_attr($this->getValue($key, $options));
        $items = '';
        //var_dump($options['items']);
        foreach ($options['items'] as $k => $v) {
            $items .= sprintf('<li><a href="#" value="%s">%s</a></li>', esc_attr($k), $v);
        }
        $html = <<< EOT
<div id="$id-div" data-id="$id" class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <input type="hidden" name="$name" value="$value">
                <ul class="theme-dropdown unstyled">
                    $items
                </ul>
            </div>
        </div>
    </div>
</div>   
<script>
    jQuery("#$id-div").ThemeDropdowncustom();
</script>
EOT;
        return $html;
    }        
    
    protected function templatePopupCustom($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // Generate items
        $value = esc_attr($this->getValue($key, $options));
        $html = <<< EOT
<div id="$id-div" data-id="$id" class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <input type="hidden" name="$name" value="$value">     
                <div id="$id-holder"></div>
                <div id="$id-container" class="container" style="display: none;">
                    {$options['content']}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery("#$id-div").ThemePopupcustom();
</script>
EOT;
        return $html;
    }            
    
    protected function templateRadiolist($key, $options) {
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        // Escape string
        $value = is_string($value) ? esc_attr($value) : $value; 
        $items = '';
        foreach ($options['items'] as $k => $v) {
            $items .= sprintf('<label><input type="radio" name="%s" value="%s" %s><span>%s</span></label><br/>', $name, $k, ($value == $k) ? 'checked="checked"' : '', $v);
        }
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                $items
            </div>
        </div>
    </div>
</div>
EOT;
        return $html;
    }
    
    protected function templateMediaupload($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        $value = is_string($value) ? esc_attr($value) : $value; 
        $txtUpload = __r('Upload');
        $txtRemove = __r('Remove');
        $html = <<< EOT
<div id="$id-div" data-id="$id" class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <div class="uploaded">
                    <img id="$id-preview" src="$value" alt="" />
                </div>
                <p>
                    <input id="$id" name="$name" type="text" class="row-fluid" value="$value">
                </p>
                <input id="$id-btnupload" type="submit" value="$txtUpload" class="button">
                <input id="$id-btnremove" type="submit" value="$txtRemove" class="button">
            </div>
        </div>
    </div>
</div>        
<script>
    jQuery("#$id-div").ThemeMediaupload();
</script>        
EOT;
        return $html;   
    }
    
    protected function templateCheckbox($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        // Escape string
        $value = is_string($value) ? esc_attr($value) : $value; 
        if ($value) {
            $value = 'checked="checked"';
        }
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <label class="checkbox">
                    <input name="$name" type="hidden" value="0" />
                    <input id="$id" name="$name" type="checkbox" $value value="1" />
                </label>
            </div>
        </div>
    </div>
</div>
EOT;
        return $html;
    }        
    
    protected function templateUploader($key, $options) {        
        global $post_ID;        

        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        $plupload_init = esc_attr(json_encode(
            array(
                  'runtimes'            => 'html5,silverlight,flash,html4',
                  'browse_button'       => $id.'-plupload-browse-button',
                  'container'           => $id.'-container',
                  'drop_element'        => $id.'-drag-drop-area',
                  'file_data_name'      => 'async-upload',            
                  'multiple_queues'     => true,
                  'max_file_size'       => wp_max_upload_size().'b',
                  'url'                 => admin_url('admin-ajax.php'),
                  'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
                  'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
                  'filters'             => array(array('title' => __r('Allowed Files'), 'extensions' => 'jpg,jpeg,gif,png')),
                  'multipart'           => true,
                  'urlstream_upload'    => true,
                  'multi_selection'     => true,
                  'multipart_params'    => 
                  array(
                        '_ajax_nonce' => wp_create_nonce('theme_uploader'),
                        'action'      => 'action_theme_uploader',
                        'post_id'     => $post_ID,
                        ),
                  )
            ));
        $txtDropFilesHere = __r('Drop files here');
        $txtOr = __r('or');
        $txtButton = __r('Select Files');
        //
        $html = <<< EOT
<div id="$id-container" data-id="$id" data-name="$name" post-id="$post_ID" class="section hide-if-no-js" data-config="$plupload_init">
    <h3>{$options['text']}</h3>
    <p class="desc">
        {$options['hint']}
    </p>
    <div id="$id-drag-drop-area">
        <div class="drag-drop-inside">
            <p class="drag-drop-info">$txtDropFilesHere</p>
            <p>$txtOr</p>
            <p class="drag-drop-buttons"><input id="$id-plupload-browse-button" type="button" value="$txtButton" class="button" /></p>
        </div>
    </div>
    <div class="filelist"></div>
</div>        
<div class="section">
    <div id="$id-thumbs">
    </div>
</div>
<script type="text/javascript">
    jQuery('#$id-container').ThemeUploader();
</script>
EOT;
        return $html;
    }        
    
    protected function templateDropDown($key, $options) {
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // Generate items
        $value = $this->getValue($key, $options);
        $items = '';
        foreach ($options['items'] as $k => $v) {
            $items .= sprintf('<option %s value="%s">%s</option>', $value == $k ? 'selected="selected"' : '', $k, $v);
        }
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <select id="$id" name="$name" class="span6">  
                    $items
                </select>
            </div>
        </div>
    </div>
</div>
EOT;
        return $html;
    }
    
    
    
	protected function templateFontDropDown($key, $options) {
		global $googlefonts;
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // Generate items
        $value = $this->getValue($key, $options);
        //$items = '';
        
        // Google Fonts
        $items .= '<optgroup label="Web Standard Fonts">';
        foreach ($this->standardfonts as $k => $v) {
			$items .= sprintf('<option %s value="%s">%s</option>', $value == $k ? 'selected="selected"' : '', $k, $v);
        }
        
        $items .= '<optgroup label="Google Webfonts">';
        var_dump($value);
        foreach ($googlefonts as $k => $v) {
			$items .= sprintf('<option %s value="%s">%s</option>', $value == $k ? 'selected="selected"' : '', $k, $v);
        }
        
        
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <select id="$id" name="$name" class="span6">  
                    $items
                </select>
            </div>
        </div>
    </div>
</div>
EOT;
        return $html;
    }
    
    
    protected function templateText($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        // Escape string
        $value = is_string($value) ? esc_attr($value) : $value; 
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <textarea id="$id" name="$name" class="row-fluid" rows="5">$value</textarea>
            </div>
        </div>
    </div>
</div>
EOT;
        return $html;
    }    
    
    protected function templateEdit($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        // Escape string
        $value = is_string($value) ? esc_attr($value) : $value; 
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <input id="$id" name="$name" type="text" class="row-fluid" value="$value">
            </div>
        </div>
    </div>
</div>
EOT;
        return $html;
    }
    
    protected function templateImport($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // Escape string
        $value = $options['value'];
        $value = is_string($value) ? esc_attr($value) : $value;
        $txtMsg = __r('Are you sure to import the DEMO content? It may overwrite existing data!');
        $html = <<< EOT
<div class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <input id="$id" data-msg="$txtMsg" name="$name" type="button" value="$value" class="button" />
            <div id="$id-status" style="display: none;">Loading...</div>
            <div id="$id-progress"></div>            
        </div>
    </div>
</div>        
<script>
    jQuery("#$id").ThemeImport();
</script>   
EOT;
        return $html;
    }    
    
    protected function templateList($key, $options) {        
        $name = isset($options['name']) ? $options['name'] : $key;
        $id = isset($options['id']) ? $options['id'] : $key;
        // If value is set then use it, otherwise use default value        
        $value = $this->getValue($key, $options);
        $data = ($value && is_array($value) && count($value) > 0) ? esc_attr(json_encode($value)) : null;
        $txtAdd = __r('Add');
        $html = <<< EOT
<div id="$id-div" data-id="$id" data-name="$name" data-value="$data" class="section">
    <div class="divider"></div>
    <div class="row-fluid">
        <div class="span6">
            <h3>{$options['text']}</h3>
            <div class="desc">
                {$options['hint']}
            </div>
        </div>
        <div class="span6">
            <div class="control">
                <p>
                    <input id="$id" name="$name" type="hidden" value="">
                    <input id="$id" type="text" value="">
                    <button class="button" type="button">$txtAdd</button>
                </p>
                <div id="$id-list">
                </div>
            </div>
        </div>
    </div>
</div>        
<script>
    jQuery("#$id-div").ThemeList();
</script>
EOT;
        return $html;
    }    
    
    private function renderElement($key, $element) {
        $fn = 'template'.ucfirst($element['type']);
        return $this->$fn($key, $element);                        
    }
    
    public function render() {              
        $tabs = array();
        // Search for tabs
        foreach ($this->options as $key => $option) {
            if ($option['type'] == 'tab') {
                $tabs[$key] = array(
                    'text' => $option['text'],
                    'hint' => $option['hint'],
                    'content' => '',
                );
            }
        }        
        $html = '';
        foreach ($this->options as $key => $option) {
            if ($option['type'] != 'tab') {
                $element = $this->renderElement($key, $option);
                if (count($tabs)) {
                    if (isset($option['tab'])) {
                        $tabs[$option['tab']]['content'] .= $element;
                    }                    
                } else {
                    $html .= $element;
                }
            }
        }   
        // Build elements in tabs     
        if ($tabs) {
            $html .= <<< EOT
<div class="tabs-left">
    <ul class="nav nav-tabs main-nav">
EOT;
            $i = 0;
            foreach ($tabs as $key => $tab) {
                $html .= sprintf('<li %s><a href="#%s" data-toggle="tab"><div class="wp-menu-arrow"><div></div></div>%s</a></li>', $i == 0 ? 'class="active"' : '', $key, $tab['text']);
                $i++;
            }
            $html .= <<< EOT
    </ul>
    <div class="tab-content main-content">
EOT;
            $i = 0;
            foreach ($tabs as $key => $tab) {
                $active = $i == 0 ? 'active' : '';
                $html .= <<< EOT
<div id="{$key}" class="tab-pane fade in {$active}">
    <div class="row-fluid">
        <h2>{$tab['text']}</h2>
        <p class="lead">
            {$tab['hint']}
        </p>
    </div>
    {$tab['content']}
</div>
EOT;
                $i++;
            }    
            $html .= <<< EOT
    </div>
</div>
EOT;
        }
        return $html;
    }
}

?>
